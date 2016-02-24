<?php
namespace App\Modules\Admin\Presenters;

use App\Management\EntityManager,
	App\Model\User,
	App\Model\TranslatedForm,
	Nette\Application\UI,
	App\Modules\Admin\Components\AdminTable
		;

/**
 * Description of UserPresenter
 *
 * @author KuBik
 */
class UsersPresenter extends SecureAdminPresenter {
	
	public function createComponentUserForm() {
		$form = new TranslatedForm();
		$form->addHidden('id', -1);
		$form->addText('nick', 'Nick');
        $form->addText('firstname', 'First name');
        $form->addText('lastname', 'Last name');
        $form->addText('mail', 'E-mail');
        $form->addCheckbox('active', 'Active');
        $form->addSubmit('save', 'Save');
        $form->addSubmit('cancel', 'Cancel');
        $form->onSuccess[] = array($this, 'userFormSucceeded');
		return $form;
	}
	
	public function userFormSucceeded(UI\Form $form, $values)
    {
		$em = EntityManager::get();
		$post = $this->request->post;
		try {
			$em->beginTransaction();
			if ($values['id'] < 0) $user = new User;
			else $user = User::get($values['id']);
			$user->nick = $values['nick'];
			$user->firstname = $values['firstname'];
			$user->lastname = $values['lastname'];
			$user->mail = $values['mail'];
			$user->active = $values['active'];
			if (count($post['groups'])) {
				//clean groups
				$user->groups->clear();
				if (isset($post['groups'])) {
					//set group association
					foreach ($post['groups'] as $group => $status) {
						if ($status === 'on') {
							$user->groups->add(\App\Model\Security\UserGroup::get($group));
						}
					}
				}
			}
			$user->persist();
			$em->commit();
			$this->flashMessage('Byl jste úspěšně registrován.', 'success');
		} catch (\Exception $ex) {
			$em->rollback();
			$this->flashMessage("FAILED!", 'error');
		}
		$this->redirect('default');
    }
	
	public function createComponentUserList($name) {
//		$ctrl = new UserList($this, $name);
		$grid = new AdminTable($this, $name);
		
		
		$grid->addColumnText('id', 'id')->setSortable();
		$grid->addColumnText('nick', 'login')->setSortable()->setFilterText()->setSuggestion();
		$grid->addColumnText('firstname', 'Firstname')->setSortable()->setFilterText()->setSuggestion();
		$grid->addColumnText('lastname', 'Last name')->setSortable()->setFilterText()->setSuggestion();
		$grid->addColumnText('groups', 'Groups')->setCustomRender(function($item){
			$g = $item->groups;
			$ret = array();
			foreach ($g as $group) {
				$ret[] = $group->name;
			}
			return implode(', ', $ret);
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
		$grid->getColumn('lastname')->getEditableControl()->setRequired('Last name is required.');
		
//		$operation = array('print' => 'Print', 'delete' => 'Delete');
//		$grid->setOperation($operation, $this->handleOperations)
//			->setConfirm('delete', 'Are you sure you want to delete %i items?');
//		$grid->filterRenderType = $this->filterRenderType;
//		$grid->setExport();
		return $grid;
	}
	
	public function actionEdit($id) {
		$user = User::get($id);
		$this['userForm']->setDefaults($user);
	}
	public function renderEdit($id) {
		$groups = \App\Model\Security\UserGroup::findAll();
		$this->template->groups = $groups;
		$this->template->user = User::get($id);
	}
	public function renderDefault() {
		$this['userList']->setModel(User::getQB('u'));
	}
	public function renderProfile() {
//		$this->template->user = $this->getUser();
	}
	
	public function actionDelete($id) {
		$user = User::get($id);
		$em = EntityManager::get();
		try {
			$em->beginTransaction();
			foreach ($user->hostings as $host) {
				$host->users->removeElement($user);
				$host->persist();
			}
			foreach ($user->groups as $group) {
				$group->users->removeElement($user);
				$group->persist();
			}

			$em->remove($user);
			$em->flush();
			$done_ids = is_array($id) ? implode(', ', $id) : $id;
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
				$rec = User::get($data['id']);
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
