<?php
namespace App\Modules\Admin\Presenters;

use App\Modules\Admin\Components\AdminTable,
	App\Model\Page,
	App\Model\PagePath,
	App\Model\PageTitle,
	App\Model\TranslatedForm,
	App\Admin\Model\Language,
	App\Modules\Admin\Components\PageTemplate,
	App\Model\AbstractModel
		;
/**
 * Description of CmsPagesPresenter
 *
 * @author KuBik
 */
class CmsPagePresenter extends CmsPresenter {

	protected function createComponentPageList($name) {
		$grid = new AdminTable($this, $name);
		$grid->setModel(Page::getQB('p'));
		$grid->addColumnText('id', 'Id')->setSortable();
		
		$grid->addColumnText('title', 'Title')->setCustomRender(function(AbstractModel $item){
			if ($item->titles->count()) {
				$lng = \App\Model\Translator::get()->getLang();
				foreach ($item->titles as $v) {
					if ($v->language == $lng)
						return $v->value;
				}
				return $item->titles->first()->value;
			} else {
				return '[not set]';
			}
		})->setSortable(FALSE);
		
		$grid->addColumnText('path', 'Path')->setCustomRender(function(AbstractModel $item){
			if ($item->paths->count()) {
				$lng = \App\Model\Translator::get()->getLang();
				foreach ($item->paths as $v) {
					if ($v->language == $lng)
						return $v->value;
				}
				return $item->paths->first()->value;
			} else {
				return '[not set]';
			}
		})->setSortable(FALSE);
		return $grid;
	}
	
	protected function createComponentPageEditForm() {
		$frm = new TranslatedForm();
		$cnt = $frm->addContainer('page');
		$cnt->addHidden('id', '-1');
		$cnt->addComponent(new PageTemplate, 'template');
		
		$frm->addSubmit('send', 'Save');
		$frm->addSubmit('cancel', 'Cancel')
			->onClick[] = $this->formCancelled;
		$frm->onSuccess[] = array($this, 'editFormSubmitted');
		//temp lng form
		$cnt = $frm->addContainer('lng')
			->addContainer('dummy');
		$cnt->addHidden('title_id', '-1');
		$cnt->addHidden('path_id', '-1');
		$cnt->addText('title_value', 'Title');
		$cnt->addText('path_value', 'Path');
		
		return $frm;
	}
	
//	public function handleView() {
//		parent::handleView();
//		$this->redrawControl('tpl');
//	}
	
	public function editFormSubmitted(TranslatedForm $form, $values) {
		$err = 0;
		try {
			$docId = $values['page']['id'];
			$langs = $this->getRequest()->getPost('lng');
			
			$em = \App\Management\EntityManager::get();
			$em->beginTransaction();
			
			if (!empty($docId) && $docId >= 0) {
				$item = Page::get($values['page']['id']);
			} else {
				$item = new Page;
			}
			
			$template = $this->getRequest()->getPost('page')['template'];
			$item->template = empty($template['tpl_select']) ? '1-col' : $template['tpl_select'];
			$item->persist();
//			$item->created   = empty($values['page']['created']) ? 
//					NULL : DateTime::fromString($values['page']['created']);
			// update existing
			unset($values['lng']['dummy']);
			unset($langs['dummy']);
			foreach ($values['lng'] as $name => $data) {
				if (!empty($data['title_id']) && $data['title_id'] >= 0) {
					$title = PageTitle::get($data['title_id']);
				} else {
					$title = new PageTitle;
					$title->language = $name;
					$title->page = $item;
				}
				$title->value = $data['title_value'];
				$title->persist();
				if (!empty($data['path_id']) && $data['path_id'] >= 0) {
					$path = PagePath::get($data['path_id']);
				} else {
					$path = new PagePath;
					$path->language = $name;
					$path->page = $item;
				}
				$path->value = $data['path_value'];
				$path->persist();
				unset($langs[$name]);
			}
			//create new
			foreach ($langs as $name => $data) {
				if (isset($data['title_value']) && !empty($data['title_value'])) {
					$ver = new PageTitle;
					$ver->value = $data['title_value'];
					$ver->language = $name;
					$ver->page = $item;
					$ver->persist();
				}
				if (isset($data['path_value']) && !empty($data['path_value'])) {
					$ver = new PagePath();
					$ver->value = $data['path_value'];
					$ver->language = $name;
					$ver->page = $item;
					$ver->persist();
				}
			}
			//TODO: delete
			
			$item->persist();
			$em->commit();
			
			$this->flashMessage("Action '{$this->action}' for row with id: {$item->id} done.", 'success');
		} catch (\Exception $ex) {
			$this->flashMessage("Action '{$this->action}' for row with id: {$item->id} error.\n".$ex->getMessage(), 'error');
			$err = 1;
			$em->rollback();
		}
		if ($err) {
			$this->redirect('edit', $item->id);
		} else {
			$this->redirect('default');
		}
	}
	/* ==============================================
	 *                 EDIT
	 * ============================================== */
	/**
	 * 
	 * @param int $id
	 */
	public function actionEdit($id) {
		$item = Page::get($id);
		if (!is_null($item)) {
			$defaults = array(
				'page' => array(
					'id' => $item->id,
					'template' => $item->template,
	//				'created' => $item->created == NULL ? 
	//					NULL : $item->created->format(DateTime::FORM_DATETIME_FORMAT),
	//				'published' => $item->published == NULL ? 
	//					NULL : $item->published->format(DateTime::FORM_DATETIME_FORMAT)
				)
			);
			$this['pageEditForm']->setDefaults($defaults);
			$this->setupPageForm($item);
		}
	}
	/**
	 * 
	 * @param int $id
	 */
	public function renderEdit($id) {
//		$this->template->itemId = $id;
		$this->template->languages_notset = Language::getAll();
	}
	
	/* ================================================
	 *            HELP
	 * ================================================ */
	protected function setupPageForm(Page $page) {
		$v = $this['pageEditForm']['lng'];
		$lngs = Language::getAll();
		$existingLngs = array();
		foreach ($page->titles as $title) {
			$cnt;
			if (isset($v[$title->language])) {
				$cnt = $v[$title->language];
			} else {
				$cnt = $v->addContainer($title->language);
				$existingLngs[] = $title->language;
			}
			$cnt->addHidden('title_id', $title->id);
			$cnt->addText('title_value', 'Title')->setDefaultValue($title->value);
			$cnt->addHidden('path_id', -1);
			$cnt->addText('path_value', 'Path');
		}
		foreach ($page->paths as $path) {
			$cnt;
			if (isset($v[$path->language])) {
				$cnt = $v[$path->language];
				$cnt['path_id']->setDefaultValue($path->id);
				$cnt['path_value']->setDefaultValue($path->value);
				
			} else {
				$cnt = $v->addContainer($path->language);
				$existingLngs[] = $path->language;
				$cnt->addHidden('title_id', -1);
				$cnt->addText('title_value', 'Title');
				$cnt->addHidden('path_id', $path->id);
				$cnt->addText('path_value', 'Path')->setDefaultValue($path->value);
			}
		}
	}
}
