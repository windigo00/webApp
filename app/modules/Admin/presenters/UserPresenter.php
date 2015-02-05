<?php
namespace App\Modules\Admin\Presenters;

use Nette,
	App\Model,
	App\Modules\Admin\Components\UserList,
	Grido\DataSources\Doctrine,
	App\Model\User,
	Grido\Grid
		;

/**
 * Description of UserPresenter
 *
 * @author KuBik
 */
class UserPresenter extends BaseAdminPresenter {
	
	public function createComponentUser_list($name) {
//		$ctrl = new UserList($this, $name);
		$grid = new Grid($this, $name);
		$grid->model = new Doctrine(User::getRepository()->repo->createQueryBuilder('u'));
		$grid->setEditableColumns(function($id, $newValue, $oldValue, $column) {
			//do update ... and return result
			return TRUE;
		});
		$grid->addColumnText('id', 'id');
		$grid->addColumnText('nick', 'login')
			->setFilterText()
			->setSuggestion()
				;
		$grid->addColumnText('firstname', 'Firstname')
			->setFilterText()
			->setSuggestion()
				;
		$grid->addColumnText('surname', 'Surname')
			->setSortable()
			->setFilterText()
			->setSuggestion()
				;
		$grid->getColumn('surname')->getEditableControl()->setRequired('Surname is required.');
		$grid->addActionHref('edit', 'Edit')
			->setIcon('pencil');
		$grid->addActionHref('delete', 'Delete')
			->setIcon('trash')
			->setConfirm(function($item) {
				return "Are you sure you want to delete {$item->getFirstname()} {$item->getSurname()}?";
		});
//		$operation = array('print' => 'Print', 'delete' => 'Delete');
//		$grid->setOperation($operation, $this->handleOperations)
//			->setConfirm('delete', 'Are you sure you want to delete %i items?');
//		$grid->filterRenderType = $this->filterRenderType;
//		$grid->setExport();
//		$this->template->grid = $grid->render();
		return $grid;
	}
	
	public function renderProfile() {
		$this->template->user = $this->getUser();
	}
	
	public function actionDelete($id) {
		$user = User::get($id);
		$em = \App\Management\EntityManager::getEm();
//		dump($em);exit;
		$em->remove($user);
		$em->flush();
        $id = is_array($id) ? implode(', ', $id) : $id;
        $this->flashMessage("Action '$this->action' for row with id: $id done.", 'success');
        $this->redirect('default');
	}
	public function handleEdit($id) {
		
	}
}
