<?php
namespace App\Modules\Admin\Presenters;

use App\Model\Security\UserGroup,
	App\Management\EntityManager,
	Grido\DataSources\Doctrine,
	App\Modules\Admin\Components\AdminTable
		;
/**
 * Description of UserGroupsPresenter
 *
 * @author KuBik
 */
class UserGroupsPresenter extends BaseAdminPresenter{
	public function createComponentGroupList($name) {
		$grid = new AdminTable($this, $name);
		$grid->model = new Doctrine(UserGroup::getRepository()->createQueryBuilder('g'));
		
		$grid->addColumnText('id', 'Id');
		$grid->addColumnText('name', 'Name')
			->setFilterText()->setSuggestion();
		
		return $grid;
	}
	
	public function actionDelete($id) {
		$group = UserGroup::get($id);
		$em = EntityManager::get();
		$em->remove($group);
		$em->flush();
        $done_ids = is_array($id) ? implode(', ', $id) : $id;
        $this->flashMessage("Action '{$this->action}' for row with id: $done_ids done.", 'success');
        $this->redirect('default');
	}
}
