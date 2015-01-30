<?php
namespace App\Modules\Admin\Presenters;

use App\Model\Menu\Menu,
	App\Model\Menu\MenuItem,
	Nette\Application\UI\Form,
	App\Modules\Admin\Components\CmsMenu
		;
/**
 * Description of CmsMenuPresenter
 *
 * @author KuBik
 */
class CmsMenuPresenter extends BasePresenterAdmin {
	
	protected function createComponentCmsMenu() {
		return new CmsMenu($this);
	}
	protected function createComponentEditForm() {
//		var_dump($this->template);
		$frm = new Form();
		$frm->addHidden('id', '-1');
		$frm->addText('name', 'Name')
			->setAttribute('class', 'form-control');
		$tree = $this->getMenuTree();
//		
		$frm->addSelect('parent', 'Parent', $tree)
			->setAttribute('class', 'form-control');
		$frm->addSubmit('send', 'Save')
			->setAttribute('class', 'form-control btn btn-primary');
		$frm->onSuccess[] = array($this, 'editFormSubmitted');
		$this->template->tree = $tree;
		return $frm;
	}
	
	public function editFormSubmitted(Form $form, $values) {
		try {
			$item = MenuItem::getById($values['id']);
			$item->setName($values['name']);
			$item->setParentId($values['parent']);
			$item->save();
			echo 'ok';
		} catch (\Exception $ex) {
			echo 'fail';
		}
		exit;
	}

	public function renderDefault()
	{
		$menu = Menu::getByParent(NULL);
		$this->template->menus = $menu;
	}
	
	public function actionEdit($id) {
		$item = MenuItem::getById($id);
		$this->template->itemId = $id;
		$defaults = array(
			'id' => $item->getId(),
			'name' => $item->getName(),
			'parent' => $item->getParentId()
		);
		$this['editForm']->setDefaults($defaults);
		
	}
	
	public function actionDelete($id) {
		
	}
	
	public function renderAdd() {
		
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
