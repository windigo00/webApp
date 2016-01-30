<?php
namespace App\Modules\Admin\Presenters;

use Nette\Application\UI\Form,
	App\Modules\Admin\Components\AdminTable,
	App\Model\Page
	;
/**
 * Description of CmsMenuPresenter
 *
 * @author KuBik
 */
class AdminCmsPagesPresenter extends AdminCmsPresenter {
	
	const FORM_DATETIME_FORMAT = "m/d/Y";


	protected function createComponentPageList($name) {
		$grid = new AdminTable($this, $name);
		$grid->addColumnText('id', 'id')->setSortable();
		$grid->addColumnText('title', 'title')->setCustomRender(function(\App\Model\Entity $item){
			return $item->getTitles()->first()->content;
		})->setSortable();
		$grid->addColumnDate('created', 'created')->setSortable();
		$grid->addColumnDate('published', 'publised')->setSortable();
//		$grid->addColumnText('lastname', 'Last name')->setSortable()->setFilterText()->setSuggestion();
//		$grid->getColumn('lastname')->getEditableControl()->setRequired('Last name is required.');
		
//		$operation = array('print' => 'Print', 'delete' => 'Delete');
//		$grid->setOperation($operation, $this->handleOperations)
//			->setConfirm('delete', 'Are you sure you want to delete %i items?');
//		$grid->filterRenderType = $this->filterRenderType;
//		$grid->setExport();
		return $grid;
	}
	
	protected function createComponentEditForm() {
		$frm = new Form();
		$frm->addHidden('id', '-1');
		$frm->addText('created', 'Created');
		$frm->addText('published', 'Published');
		
//		$frm->addSelect('path', 'Path', $path)
//			->setAttribute('class', 'form-control');
		$frm->addSubmit('send', 'Save');
		$frm->addSubmit('cancel', 'Cancel')
			->onClick[] = $this->formCancelled;
		$frm->onSuccess[] = array($this, 'editFormSubmitted');
//		$this->template->tree = $tree;
		return $frm;
	}
	
	public function editFormSubmitted(Form $form, $values) {
		$err = 0;
		try {
			$item = Page::get($values['id']);
			$date = explode('/', $values['published']);
			$d = new \DateTime();
			$d->setDate($date[2], $date[0], $date[1]);
			$item->published = $d;
			$date = explode('/', $values['created']);
			$d = new \DateTime();
			$d->setDate($date[2], $date[0], $date[1]);
			$item->created = $d;
			$item->persist();
			$this->flashMessage("Action '{$this->action}' for row with id: {$item->id} done.", 'success');
		} catch (\Exception $ex) {
			$this->flashMessage("Action '{$this->action}' for row with id: {$item->id} error.\n".$ex->getMessage(), 'error');
			$err = 1;
		}
		if ($err) {
			$this->redirect('edit', $item->id);
		} else {
			$this->redirect('default');
		}
	}

	public function renderDefault()
	{
		$qb = Page::getRepository()->createQueryBuilder('p');
		$qb->addSelect('(SELECT t.content FROM App\Model\Entities\PageTitleEntity t WHERE p.id = t.page_id) AS title');
//		$qb->leftJoin('App\Model\Entities\PageTitle', 't', \Doctrine\ORM\Query\Expr\Join::WITH, 'p.id = t.page.id');
		$this['pageList']->setModel($qb);
	}
	
	public function actionEdit($id) {
		$item = Page::get($id);
		$this->template->itemId = $id;
		$defaults = array(
			'id' => $item->id,
			'created' => date(self::FORM_DATETIME_FORMAT, $item->created->getTimestamp()),
			'published' => date(self::FORM_DATETIME_FORMAT, $item->published->getTimestamp())
		);
		$this['editForm']->setDefaults($defaults);
		
	}
	
//	public function actionDelete($id) {
		
//	}
	
//	public function renderAdd() {
		
//	}
	
}
