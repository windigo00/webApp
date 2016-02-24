<?php
namespace App\Modules\Admin\Presenters;

use Nette\Application\UI\Form,
	App\Modules\Admin\Components\AdminTable,
	App\Model\Document,
	App\Model\DocumentVersion,
	App\Model\AbstractModel,
	App\Model\TranslatedForm,
	App\Admin\Model\Language,
	App\Helper\DateTime
		;
/**
 * Description of CmsDocumentPresenter
 *
 * @author KuBik
 */
class CmsDocumentPresenter extends CmsPresenter {

	protected function createComponentDocList($name) {
		$grid = new AdminTable($this, $name);
		$grid->setModel(Document::getQB());
		
//		$grid->addColumnText('id', 'id')->setSortable();
		$grid->addColumnText('title', 'title')->setCustomRender(function(AbstractModel $item){
			if ($item->version->count()) {
				$lng = \App\Model\Translator::get()->getLang();
				foreach ($item->version as $v) {
					if ($v->language == $lng)
						return $v->title;
				}
				return $item->version->first()->title;
			} else {
				return '[not set]';
			}
		})->setSortable(FALSE);
		$grid->addColumnDate('created', 'created')->setSortable()->setFilterDateRange();
		$grid->addColumnDate('published', 'publised')->setSortable()->setFilterDateRange();
//		$grid->addColumnText('lastname', 'Last name')->setSortable()->setFilterText()->setSuggestion();
//		$grid->getColumn('lastname')->getEditableControl()->setRequired('Last name is required.');
		
		$operation = array('print' => 'Print', 'delete' => 'Delete');
		$grid->setOperation($operation, $this->handleOperations)->setConfirm('delete', 'Are you sure you want to delete %i items?');
//		$grid->filterRenderType = $this->filterRenderType;
//		$grid->setExport();
		return $grid;
	}
	
	/**
     * Common handler for grid operations.
     * @param string $operation
     * @param array $id
     */
    public function handleOperations($operation, $id)
    {
		if ($id) {
            $row = implode(', ', $id);
            $this->flashMessage("Process operation '$operation' for row with id: $row...", 'info');
        } else {
            $this->flashMessage('No rows selected.', 'error');
        }
        if ($this->isAjax()) {
            isset($this['docList']) && $this['docList']->reload();
            $this->redrawControl('flashes');
        } else {
            $this->redirect($operation, array('id' => $id));
        }
    }

	protected function createComponentDocEditForm() {
		$frm = new TranslatedForm();
		$cnt = $frm->addContainer('doc');
		$cnt->addHidden('id', '-1');
		$cnt->addText('created', 'Created');
		$cnt->addText('published', 'Published');
		
		$frm->addSubmit('send', 'Save');
		$frm->addSubmit('cancel', 'Cancel')
			->onClick[] = $this->formCancelled;
		$frm->onSuccess[] = array($this, 'editFormSubmitted');
		//temp lng form
		$cnt = $frm->addContainer('ver')
			->addContainer('dummy');
		$cnt->addHidden('id', '-1');
		$cnt->addText('title', 'Title');
		$cnt->addTextArea('content', 'Content');
		
		return $frm;
	}
	
	public function editFormSubmitted(Form $form, $values) {
		$err = 0;
		try {
			$docId = $values['doc']['id'];
			$req = $this->getRequest()->getPost('ver');
			
			$em = \App\Management\EntityManager::get();
			$em->beginTransaction();
			
			if ( $docId >= 0) {
				$item = Document::get($values['doc']['id']);
			} else {
				$item = new Document;
				$item->persist();
			}
			$item->published = empty($values['doc']['published']) ? 
					NULL : DateTime::fromString($values['doc']['published']);
			$item->created   = empty($values['doc']['created']) ? 
					NULL : DateTime::fromString($values['doc']['created']);
			// update existing
			unset($values['ver']['dummy']);
			foreach ($values['ver'] as $name => $data) {
				$ver = DocumentVersion::get($data['id']);
				$ver->title = $data['title'];
				$ver->content = $data['content'];
				$ver->persist();
				unset($req[$name]);
			}
			//create new
			unset($req['dummy']);
			foreach ($req as $name => $data) {
				$ver = new DocumentVersion;
				$ver->title = $data['title'];
				$ver->content = $data['content'];
				$ver->language = $name;
				$ver->document = $item;
				$ver->persist();
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

	/**
	 * 
	 * @param type $id
	 */
	public function actionEdit($id) {
		$item = Document::get($id);
		
		$defaults = array(
			'doc' => array(
				'id' => $item->id,
				'created' => $item->created == NULL ? 
					NULL : $item->created->format(DateTime::FORM_DATETIME_FORMAT),
				'published' => $item->published == NULL ? 
					NULL : $item->published->format(DateTime::FORM_DATETIME_FORMAT)
			)
		);
		$this['docEditForm']->setDefaults($defaults);
		$this->setupDocumentVersionForm($item->version);
	}
	/**
	 * 
	 * @param type $id
	 */
	public function renderEdit($id) {
		$item = Document::get($id);
		
		$this->template->itemId = $id;
		$versions = $item->version;
		$existingLngs = array();
		foreach($versions as $version) {
			$existingLngs[] = $version->language;
		}
		$lngs = Language::getAll();
		$lngs = array_diff($lngs, $existingLngs);
		
		$this->template->languages_notset = $lngs;
//		$this->template->versions = $versions;
	}
	
	public function renderAdd() {
		$this->template->itemId = -1;
		$versions = array();
		$this->template->languages_notset = Language::getAll();
	}
	
	protected function setupDocumentVersionForm($versions) {
		$v = $this['docEditForm']['ver'];
		foreach ($versions as $ver) {
			$cnt = $v->addContainer($ver->language);
			$cnt->addHidden('id', '-1');
			$cnt->addText('title', 'Title');
			$cnt->addTextArea('content', 'Content');
			$cnt->setDefaults(array(
				'id' => $ver->id,
				'language' => $ver->language,
				'content' => $ver->content,
				'title' => $ver->title
			));
		}
	}


//	public function actionDelete($id) {
		
//	}
	
//	public function renderAdd() {
		
//	}
	
}
