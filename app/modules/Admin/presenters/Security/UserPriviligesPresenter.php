<?php

namespace App\Modules\Admin\Presenters;

use App\Model\Security\AclRecord,
	App\Model\Security\AclPrivilege,
	App\Model\Security\AclResource,
	App\Model\Security\UserGroup,
	App\Management\EntityManager,
	App\Model\TranslatedForm,
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
        $form = new TranslatedForm;
        $form->addSelect('resource', 'Resource:', $this->getResourceSelectValues());
        $form->addSelect('privilege', 'Privilege:', $this->getPrivilegeSelectValues());
        $form->addSelect('userGroup', 'Group:', $this->getGroupSelectValues());
        $form->addCheckbox('allowed', 'Allowed:');
        $form->addSubmit('new', 'Save');
        $form->onSuccess[] = array($this, 'addFormSucceeded');
        return $form;
    }
	// called after form is successfully submitted
    public function addFormSucceeded(TranslatedForm $form, $values)
    {
		
        $res = AclRecord::findOneBy((array)$values);
		
		if ($res !== NULL) {
			// name exists, error
			$this->flashMessage('`'.implode(' | ',$values).'` allready exist.', 'error');
			$this->redirect('default');
		} else {
			$res = new AclRecord;
			$res->resource = AclResource::get($values['resource']);
			$res->privilege = AclPrivilege::get($values['privilege']);
			$res->userGroup = UserGroup::get($values['userGroup']);
			$res->allowed = $values['allowed'];
			$res->persist();
			$this->flashMessage('You have successfully created new privilege.', 'success');
			$this->redirect('default');
		}
    }
	protected function getResourceSelectValues() {
		$out = array();
		$res = AclResource::findAll();
		foreach ($res as $item) $out[$item->name] = $item->name;
		return $out;
	}
	protected function getPrivilegeSelectValues() {
		$out = array();
		$res = AclPrivilege::findAll();
		foreach ($res as $item) $out[$item->name] = $item->name;
		return $out;
	}
	protected function getGroupSelectValues() {
		$out = array();
		$res = UserGroup::findAll();
		foreach ($res as $item) $out[$item->id] = $item->name;
		return $out;
	}
	
	public function createComponentPrivList($name) {
		$grid = new AdminTable($this, $name);
		$grid->setModel(AclRecord::getQB('p'));
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
				$translator = \App\Model\Translator::get();
				$tmp = \Nette\Utils\Html::el('input')->type('checkbox');
				if ($item->allowed) {
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
			})
//			->setSortable()->setFilterCheck()
//			->setCondition(array('allowed',  '= ?', 'allowed'))
				;
		
		$operation = array('delete' => 'Delete','filter' => 'Filter');
		$grid->setOperation($operation, $this->handleOperations)
			->setConfirm('delete', 'Are you sure you want to delete %i items?');
//		$grid->onFetchData($this->handleOperations);
//		$grid->filterRenderType = $this->filterRenderType;
//		$grid->setExport();
//		dump($grid);
		return $grid;
	}
	
	public function handleEdit($id) {
		if ($this->isAjax()) {
			$data = $this->request->post;
			try {
				$rec = AclRecord::get($data['id']);
				if (isset($data['active'])) {
					$rec->allowed = $data['active'] ? 1 : 0;
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
	public function handleDelete($id) {
		$rec = AclRecord::get($id);
		$em = EntityManager::get();
		$em->remove($rec);
		$em->flush();
        $done_ids = is_array($id) ? implode(', ', $id) : $id;
        $this->flashMessage("Action '{$this->action}' for row with id: $done_ids done.", 'success');
        $this->redirect('default');
	}
	public function handleOperations($operation, $id) {
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
}
