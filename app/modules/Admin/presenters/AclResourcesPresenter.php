<?php

namespace App\Modules\Admin\Presenters;

use App\Model\Security\AclResource,
	App\Management\EntityManager,
	Grido\DataSources\Doctrine,
	App\Modules\Admin\Components\AdminTable,
	Nette\Application\UI\Form;

/**
 * Description of AclResourcesPresenter
 *
 * @author KuBik
 */
class AclResourcesPresenter extends SecureAdminPresenter {

	public function createComponentResourceList($name) {
		
		$grid = new AdminTable($this, $name);
		$grid->model = new Doctrine(AclResource::getRepository()->createQueryBuilder('p'));
		$grid->primaryKey = 'name';
		$grid->addColumnText('name', 'Name')->setSortable()
			->setFilterText()->setSuggestion()
				;
//		dump($grid);
		return $grid;
	}
	
	protected function createComponentAddForm()
    {
        $form = new Form;
        $form->addText('name', 'Name:')->setRequired();
        $form->addSubmit('new', 'Save');
        $form->onSuccess[] = array($this, 'addFormSucceeded');
        return $form;
    }

    // called after form is successfully submitted
    public function addFormSucceeded(Form $form, $values)
    {
        $res = AclResource::getRepository()->findOneByName($values['name']);
		
		if ($res !== NULL) {
			// name exists, error
			$this->flashMessage('Name `'.$values['name'].'` allready exist.', 'error');
			$this->redirect('default');
		} else {
			$res = new AclResource;
			$res->setName($values['name']);
			$res->persist();
			$this->flashMessage('You have successfully created new resource.', 'success');
			$this->redirect('default');
		}
    }
	
	public function renderResource($id) {
		$this->template->user = $this->getUser();
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
