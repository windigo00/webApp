<?php

namespace App\Modules\Admin\Presenters;

use App\Model\Security\AclRecord,
	App\Model\Security\AclPrivilege,
	App\Model\Security\AclResource,
	App\Model\Security\UserGroup,
	App\Management\EntityManager,
	Nette\Application\UI\Form,
	Grido\DataSources\Doctrine,
	App\Modules\Admin\Components\AdminTable
		;

/**
 * Description of UserPriviligesPresenter
 *
 * @author KuBik
 */
class UserPrivilegesPresenter extends SecureAdminPresenter {

	protected function createComponentAddForm()
    {
        $form = new \Nette\Application\UI\Form;
        $form->addSelect('resource', 'Resource:', $this->getResourceSelectValues());
        $form->addSelect('privilege', 'Privilege:', $this->getPrivilegeSelectValues());
        $form->addSelect('userGroup', 'Group:', $this->getGroupSelectValues());
        $form->addCheckbox('allowed', 'Allowed:');
        $form->addSubmit('new', 'Save');
        $form->onSuccess[] = array($this, 'addFormSucceeded');
        return $form;
    }
	// called after form is successfully submitted
    public function addFormSucceeded(Form $form, $values)
    {
		
        $res = AclRecord::getRepository()->findOneBy((array)$values);
		
		if ($res !== NULL) {
			// name exists, error
			$this->flashMessage('`'.implode(' | ',$values).'` allready exist.', 'error');
			$this->redirect('default');
		} else {
			$res = new AclRecord;
			$res->setResource(AclResource::get($values['resource']));
			$res->setPrivilege(AclPrivilege::get($values['privilege']));
			$res->setUserGroup(UserGroup::get($values['group']));
			$res->setAllowed($values['allowed']);
			$res->persist();
			$this->flashMessage('You have successfully created new privilege.', 'success');
			$this->redirect('default');
		}
    }
	protected function getResourceSelectValues() {
		$out = array();
		$res = \App\Model\Security\AclResource::getRepository()->findAll();
		foreach ($res as $item) $out[$item->getName()] = $item->getName();
		return $out;
	}
	protected function getPrivilegeSelectValues() {
		$out = array();
		$res = \App\Model\Security\AclPrivilege::getRepository()->findAll();
		foreach ($res as $item) $out[$item->getName()] = $item->getName();
		return $out;
	}
	protected function getGroupSelectValues() {
		$out = array();
		$res = \App\Model\Security\UserGroup::getRepository()->findAll();
		foreach ($res as $item) $out[$item->getId()] = $item->getName();
		return $out;
	}
	
	public function createComponentPrivList($name) {
//		$ctrl = new UserList($this, $name);
		$grid = new AdminTable($this, $name);
		$grid->model = new Doctrine(AclRecord::getRepository()->createQueryBuilder('p'));
		
		$grid->addColumnText('resource', 'Resource')->setSortable()
			->setCustomRender(function($item){
				return $item->resource->name;
			})
//			->setFilterText()->setSuggestion()
//			->setCondition(array('resource',  '= ?', 'resource'))
				;
		$grid->addColumnText('privilege', 'Privilege')->setSortable()
			->setCustomRender(function($item){
				return $item->privilege->name;
			})
//			->setFilterText()->setSuggestion()
//			->setCondition(array('privilege',  '= ?', 'privilege'))
				;
		$grid->addColumnText('userGroup', 'User group')->setSortable()
			->setCustomRender(function($item){
				return $item->userGroup->name;
			})
//			->setFilterText()->setSuggestion()
//			->setCondition(array('group',  '= ?', 'group'))
				;
		$grid->addColumnText('allowed', 'Allowed')->setSortable()
			->setCustomRender(function($item){
				$tmp = \Nette\Utils\Html::el('input')->type('checkbox');
				if ($item->allowed) {
					$tmp->checked = TRUE;
				}
				$tmp->data = $item->id;
				$tmp->onChange = 'console.log(arguments);';
				return $tmp;
			})
//			->setSortable()->setFilterCheck()
//			->setCondition(array('allowed',  '= ?', 'allowed'))
				;
		
//		$operation = array('delete' => 'Delete','filter' => 'Filter');
//		$grid->setOperation($operation, $this->handleOperations)
//			->setConfirm('delete', 'Are you sure you want to delete %i items?');
//		$grid->onFetchData($this->handleOperations);
//		$grid->filterRenderType = $this->filterRenderType;
//		$grid->setExport();
//		dump($grid);
		return $grid;
	}
	
	public function renderProfile() {
		$this->template->user = $this->getUser();
	}
	
	public function handleDelete($id) {
		$rec = AclRecord::get($id);
		$em = EntityManager::get();
		$em->remove($rec);
		$em->flush();
        $done_ids = is_array($id) ? implode(', ', $id) : $id;
        $this->flashMessage("Action '{$this->action}' for row with id: $done_ids done.", 'success');
        $this->redirect('default');
	}
	public function handleOperations($operaiton) {
		throw new NotImplementedException;
	}
}
