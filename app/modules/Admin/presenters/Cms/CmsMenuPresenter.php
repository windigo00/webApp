<?php
namespace App\Modules\Admin\Presenters;

use App\Model\Menu,
	App\Model\MenuItem,
	App\Model\TranslatedForm,
	App\Modules\Admin\Components\CmsMenu
		;
/**
 * Description of CmsMenuPresenter
 *
 * @author KuBik
 */
class CmsMenuPresenter extends CmsPresenter {
	
	protected function createComponentCmsMenu() {
		return new CmsMenu($this);
	}
	
	protected function createComponentMenuItemEditForm() {
		$frm = new TranslatedForm();
		$frm->addHidden('id', '-1');
		$frm->addHidden('menuid', '-1');
		$frm->addText('parent', 'Parent');
		$frm->addText('text', 'Text');
		$frm->addText('path', 'Path');
		$frm->addCheckbox('active', 'Active');
		$frm->addSubmit('send', 'Save');
		$frm->addSubmit('cancel', 'Cancel')
				->onClick[] = $this->formCancelled;
		$frm->onSuccess[] = array($this, 'menuItemEditFormSubmitted');
//		$this->template->tree = $tree;
		return $frm;
	}
	
	protected function createComponentEditForm() {
//		var_dump($this->template);
		$frm = new TranslatedForm();
		$frm->addHidden('id', '-1');
		$frm->addText('name', 'Name');
		$frm->addCheckbox('active', 'Active');
		$frm->addSubmit('send', 'Save');
		$frm->addSubmit('cancel', 'Cancel')
				->onClick[] = $this->formCancelled;
		$frm->onSuccess[] = array($this, 'editFormSubmitted');
//		$this->template->tree = $tree;
		return $frm;
	}
	
	public function menuItemEditFormSubmitted(TranslatedForm $form, $values) {
		try {
			$item = $values['id'] > 0 ? MenuItem::get($values['id']) : new MenuItem;
			$item->menu = Menu::get($values['menuid']);
			$item->active = $values['active'];
			$item->text = $values['text'];
			$item->parent = !empty($values['parent']) ? MenuItem::get($values['parent']) : NULL;
			$item->path = $values['path'];
			
			$item->persist();
			$this->flashMessage("Action '{$this->action}' for row with id: {$item->id} done.", 'success');
		} catch (\Exception $ex) {
			$this->flashMessage("Action '{$this->action}' for row with id: {$item->id} error.\n".$ex->getMessage(), 'error');
		}
		$this->redirect('edit', $item->menu->id);
	}
	public function editFormSubmitted(TranslatedForm $form, $values) {
		try {
			$item = $values['id'] > 0 ? Menu::get($values['id']) : new Menu;
			$item->name = $values['name'];
			$item->active = $values['active'];
			
			$item->persist();
			$this->flashMessage("Action '{$this->action}' for row with id: {$item->id} done.", 'success');
		} catch (\Exception $ex) {
			$this->flashMessage("Action '{$this->action}' for row with id: {$item->id} error.\n".$ex->getMessage(), 'error');
		}
		$this->redirect('edit', $item->id);
		
	}

	public function renderDefault($id = NULL)
	{
		$menu = Menu::findAll();
		
		$this->template->menus = $menu;
		$this->template->selected = $id;
		if ($id != NULL) {
			foreach ($menu as $item) {
				if ($item->id == $id) {
					$this->template->menu = $item;
					$this['editForm']->setDefaults($item);
				}
			}
		}
	}
	
	public function actionEdit($id) {
		$this->renderDefault($id);
	}
	
	public function actionEditItem($id) {
		$item = MenuItem::get($id);
		$this['menuItemEditForm']->setDefaults($item);
		$this['menuItemEditForm']['menuid']->setDefaultValue($item->menu->id);
		$this['menuItemEditForm']['parent']->setDefaultValue($item->parent ? $item->parent->id : '');
		
		$this->template->class = 'ajax';
		$this->template->menu = Menu::get($item->menu->id);
		
	}
	public function actionAddItem($menuId) {
		$this['menuItemEditForm']['menuid']->value = $menuId;
		$this->template->class = 'ajax';
		$this->template->menu = Menu::get($menuId);
		
	}
	
	public function actionDelete($id) {
		
	}
	
	public function actionAdd() {
		$this->template->class = 'ajax';
	}
	
	private function getMenuTree($parent = NULL, $selected = NULL, $level = 0) {
//		if ($level > 2)	return array();
//		echo (!is_null($parent)?$parent."\n":'');
		$tree = Menu::getByParentId($parent);
		$out = array();
		$o = '.';
		foreach ($tree as $item) {
			$out[$item->getId()] = $item->getName();
			$tmp = $this->getMenuTree($item->getId(), $selected, $level+1);
			if (!empty($tmp)) {
				$out[$o] = $tmp;
				$o .= '.';
			}
		}
		return $out;
	}
}
