<?php

namespace App\Modules\Admin\Presenters;

use App\Model\Security\AclResource,
	App\Management\EntityManager,
	App\Modules\Admin\Components\AdminTable,
	App\Model\TranslatedForm
		;

/**
 * Description of AclResourcesPresenter
 *
 * @author KuBik
 */
class AclResourcesPresenter extends SecureAdminPresenter {

	public function createComponentResourceList($name) {
		
		$grid = new AdminTable($this, $name);
		$grid->primaryKey = 'name';
		$grid->addColumnText('name', 'Name')->setSortable()
			->setFilterText()->setSuggestion()
				;
		return $grid;
	}
	
	protected function createComponentAddForm()
    {
        $form = new TranslatedForm;
        $form->addText('name', 'Name:')->setRequired();
        $form->addSubmit('new', 'Save');
        $form->onSuccess[] = array($this, 'addFormSucceeded');
        return $form;
    }

    // called after form is successfully submitted
    public function addFormSucceeded(TranslatedForm $form, $values)
    {
        $res = AclResource::rep()->findOneByName($values['name']);
		if ($res !== NULL) {
			// name exists, error
			$this->flashMessage('Name `'.$values['name'].'` allready exist.', 'error');
			$this->redirect('default');
		} else {
			$res = new AclResource;
			$res->name = $values['name'];
			$res->persist();
			$this->flashMessage('You have successfully created new resource "'.$res->name.'".', 'success');
			$this->redirect('default');
		}
    }
	
	public function renderDefault() {
		$this['resourceList']->setModel(AclResource::getQB('p'));
	}
	public function renderResource($id) {
//		$this->template->user = $this->getUser();
	}
	
	public function renderAdd() {
		$form = new \Nette\Application\UI\Form();
		$this->template->form = $form;
		
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
