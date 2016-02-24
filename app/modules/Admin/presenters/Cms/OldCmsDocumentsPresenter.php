<?php
namespace App\Modules\Admin\Presenters;

use Nette\Application\UI\Form,
	App\Modules\Admin\Components\AdminTable,
	Grido\DataSources\Doctrine,
	App\Model\Document
	;
/**
 * Description of CmsMenuPresenter
 *
 * @author KuBik
 */
class OldCmsDocumentsPresenter extends CmsPresenter {
	
	protected function createComponentDocumentList($name) {
		$table = new AdminTable($this, $name);
		$table->model = new Doctrine(Document::getQB('d'));
		$table->addColumnText('id', 'ID')->setSortable();
		$table->addColumnText('title', 'Title')->setSortable();
		$table->addColumnText('language', 'Language')->setSortable();
		$table->addColumnDate('created', 'Created')->setSortable();
		$table->addColumnDate('published', 'Publised')->setSortable();
//		dump($table);
		return $table;
	}
	
	protected function createComponentEditForm() {
//		var_dump($this->template);
		$frm = new Form();
//		$frm->addHidden('id', '-1');
//		$frm->addText('name', 'Name')
//			->setAttribute('class', 'form-control');
//		$tree = $this->getMenuTree();
////		
//		$frm->addSelect('parent', 'Parent', $tree)
//			->setAttribute('class', 'form-control');
//		$frm->addSubmit('send', 'Save')
//			->setAttribute('class', 'form-control btn btn-primary');
//		$frm->onSuccess[] = array($this, 'editFormSubmitted');
//		$this->template->tree = $tree;
		return $frm;
	}
	
	public function editFormSubmitted(Form $form, $values) {
		try {
//			$item = MenuItem::getById($values['id']);
//			$item->setName($values['name']);
//			$item->setParentId($values['parent']);
//			$item->save();
			echo 'ok';
		} catch (\Exception $ex) {
			echo 'fail';
		}
		exit;
	}

//	public function renderDefault()
//	{
//		$menu = Menu::getByParent(NULL);
//		$this->template->menus = $menu;
//	}
	
	public function actionEdit($id) {
//		$item = MenuItem::getById($id);
//		$this->template->itemId = $id;
//		$defaults = array(
//			'id' => $item->getId(),
//			'name' => $item->getName(),
//			'parent' => $item->getParentId()
//		);
//		$this['editForm']->setDefaults($defaults);
		
	}
	
	public function actionDelete($id) {
		
	}
	
	public function renderAdd() {
		
	}
	
}
