<?php
namespace App\Modules\Admin\Presenters;

use Grido\DataSources\Doctrine,
	App\Management\EntityManager,
	App\Model\User,
	App\Modules\Admin\Components\AdminTable
		;

/**
 * Description of UserPresenter
 *
 * @author KuBik
 */
class UsersPresenter extends SecureAdminPresenter {
	
	public function createComponentUserList($name) {
//		$ctrl = new UserList($this, $name);
		$grid = new AdminTable($this, $name);
		$grid->model = new Doctrine(User::getRepository()->createQueryBuilder('u'));
		
		$grid->addColumnText('id', 'id')->setSortable();
		$grid->addColumnText('nick', 'login')->setSortable()->setFilterText()->setSuggestion();
		$grid->addColumnText('firstname', 'Firstname')->setSortable()->setFilterText()->setSuggestion();
		$grid->addColumnText('lastname', 'Last name')->setSortable()->setFilterText()->setSuggestion();
		$grid->getColumn('lastname')->getEditableControl()->setRequired('Last name is required.');
		
//		$operation = array('print' => 'Print', 'delete' => 'Delete');
//		$grid->setOperation($operation, $this->handleOperations)
//			->setConfirm('delete', 'Are you sure you want to delete %i items?');
//		$grid->filterRenderType = $this->filterRenderType;
//		$grid->setExport();
		return $grid;
	}
	
	public function renderProfile() {
		$this->template->user = $this->getUser();
	}
	
	public function actionDelete($id) {
		$user = User::get($id);
		$em = EntityManager::get();
		$em->remove($user);
		$em->flush();
        $done_ids = is_array($id) ? implode(', ', $id) : $id;
        $this->flashMessage("Action '{$this->action}' for row with id: $done_ids done.", 'success');
        $this->redirect('default');
	}
	public function handleEdit($id) {
		throw new NotImplementedException;
	}
}
