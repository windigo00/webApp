<?php
namespace App\Modules\Admin\Presenters;

use App\Modules\Admin\Components\AdminTable,
	App\Model\TranslatedForm,
	App\Model\Shop;
/**
 * Description of AdminModule
 *
 * @author KuBik
 */
class ShopPresenter extends ModulePresenter {
	
	public function formatTemplateFiles($view = NULL) {
		return parent::formatTemplateFiles($this->getTemplateFilesPath('Shop', $this->getName()));
	}
	
	protected function createComponentShopList($name) {
		$grid = new AdminTable($this, $name);
		$grid->addColumnText('id', 'Id')->setSortable();
		$grid->addColumnText('label', 'Title')->setSortable();
		$grid->addColumnDate('created', 'created')->setSortable()->setFilterDateRange();
		$grid->addColumnText('active', 'Active')->setSortable()
			->setCustomRender(function($item){
				$translator = \App\Model\Translator::get();
				$tmp = \Nette\Utils\Html::el('input')->type('checkbox');
				if ($item->active) {
					$tmp->checked = TRUE;
				}
				$tmp->data('id', $item->id)
					->data('toggle', 'toggle')
					->data('height', 5)
					->data('width', 40)
					->data('on', $translator->translate('Yes'))
					->data('off', $translator->translate('No'));
				$tmp->onChange = 'setStatus($(this));';
				return $tmp;
			});
		return $grid;
	}
	
	protected function createComponentShopForm() {
		$frm = new TranslatedForm();
		$frm->addHidden('id', '-1');
		$frm->addText('createdAt', 'Created');
		$frm->addCheckbox('active', 'Active');
		$frm->addSubmit('send', 'Save');
		$frm->addSubmit('cancel', 'Cancel')
			->onClick[] = $this->formCancelled;
		$frm->onSuccess[] = array($this, 'editFormSubmitted');
		//temp lng form
		$cnt = $frm->addContainer('lng')
			->addContainer('dummy');
		$cnt->addHidden('title_id', '-1');
		$cnt->addText('title_value', 'Title');
		
		return $frm;
	}
	
	public function editFormSubmitted(TranslatedForm $form, $values) {
		$err = 0;
		try {
			$sId = $values['id'];
			$langs = $this->getRequest()->getPost('lng');
			
			$em = \App\Management\EntityManager::get();
			$em->beginTransaction();
			
			if (!empty($sId) && $sId >= 0) {
				$item = Shop::get($sId);
			} else {
				$item = new Shop;
			}
			
			
			//create new
//			foreach ($langs as $name => $data) {
//				if (isset($data['title_value']) && !empty($data['title_value'])) {
//					$ver = new PageTitle;
//					$ver->value = $data['title_value'];
//					$ver->language = $name;
//					$ver->page = $item;
//					$ver->persist();
//				}
//				if (isset($data['path_value']) && !empty($data['path_value'])) {
//					$ver = new PagePath();
//					$ver->value = $data['path_value'];
//					$ver->language = $name;
//					$ver->page = $item;
//					$ver->persist();
//				}
//			}
			// TODO: delete
			
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
	public function formCancelled() {
		
	}
	
	public function renderDefault() {
		$this['shopList']->setModel(Shop::getQB('s'));
	}
}
