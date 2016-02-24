<?php
namespace App\Modules\Admin\Presenters;

use App\Management\EntityManager,
	App\Model\TranslatedForm,
	Nette\Application\UI,
	App\Modules\Admin\Components\AdminTable,
	App\Model\Catalog\Product
		;
/**
 * Description of AdminShopProductPresenter
 *
 * @author KuBik
 */
class ShopProductPresenter extends ShopPresenter {

	public function createComponentProductList($name) {
		$grid = new AdminTable($this, $name);
		
		$sku = $grid->addColumnLink('sku', 'SKU');
		$sku->setCustomRender(function($item){
			return \Nette\Utils\Html::el('a')
				->setHref($this->link('edit', $item->id))
				->setText($item->sku);
		})->setSortable();
		
		$grid->addColumnText('typeId', 'Type')->setSortable();
		
		$grid->addColumnText('createdAt', 'Created')->setSortable()
			->setCustomRender(function($item){
				return $item->createdAt->format(\App\Helper\DateTime::FORM_DATETIME_FORMAT);
			});
			
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
	
	protected function createComponentProductForm() {
		$frm = new TranslatedForm();
		$frm->addHidden('id', '-1');
		$frm->addText('sku', 'SKU');
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
			$pId = $values['id'];
			$langs = $this->getRequest()->getPost('lng');
			
			$em = \App\Management\EntityManager::get();
			$em->beginTransaction();
			
			if (!empty($pId) && $pId >= 0) {
				$item = Product::get($pId);
			} else {
				$item = new Page;
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
	public function formCancelled() {
		
	}
	
	public function actionEdit($id) {
		$p = Product::get($id);
//		$attrs = \App\Model\Eav\EavAttribute::findBy($attributes)
		$this['productForm']->setDefaults($p);
	}
	
	public function renderDefault() {
		$this['productList']->setModel(Product::getQB('p'));
	}
	public function renderProfile() {
//		$this->template->user = $this->getUser();
	}
	
	public function actionDelete($id) {
		$user = Product::get($id);
		$em = EntityManager::get();
		try {
			$em->beginTransaction();
//			foreach ($user->hostings as $host) {
//				$host->users->removeElement($user);
//				$host->persist();
//			}
//			foreach ($user->groups as $group) {
//				$group->users->removeElement($user);
//				$group->persist();
//			}
//
//			$em->remove($user);
//			$em->flush();
//			$done_ids = is_array($id) ? implode(', ', $id) : $id;
			$em->commit();
			$this->flashMessage("Action '{$this->action}' for row with id: $done_ids done.", 'success');
		} catch (\Exception $ex) {
			$em->rollback();
			$this->flashMessage("Action '{$this->action}' for row with id: $done_ids FAILED!<br>".$ex->getTraceAsString(), 'error');
		}
		$this->redirect('default');
	}
	
	public function handleEdit($id) {
		if ($this->isAjax()) {
			$data = $this->request->post;
			try {
				$rec = Product::get($data['id']);
				if (isset($data['active'])) {
					$rec->active = $data['active'] ? 1 : 0;
				}
				$rec->persist();
				$this->payload->status = 'OK';
			} catch (\Exception $ex) {
				$this->getHttpResponse()->setCode(\Nette\Http\IResponse::S400_BAD_REQUEST);
				$this->payload->message = $ex->getTraceAsString();
				$this->payload->status = 'Error';
			}
			$this->sendPayload();
		}
	}
	
	
}
