<?php
namespace App\Modules\Admin\Presenters;


/**
 * Description of DocumentPresenter
 *
 * @author KuBik
 */
class DocuumentPresenter extends SecureAdminPresenter {
	
	
	
	public function renderDefault() {
		try {
//			$documents = Document::getAll();
//			$documents= array();
			$this->template->title = 'Documents';
//			$this->template->table = $documents;
		} catch (\Exception $ex) {
			$this->flashMessage($ex->getMessage());
			$this->redirect('Error:500', array('backlink' => $this->storeRequest()));
		}
	}
	/*
	public function actionEdit($id) {
		//handle edit
		$doc = Document::getById($id);
		if ($doc != NULL) {
			$doc->setName($_POST[Document::COLUMN_NAME]);
			$doc->setTemplate($_POST[Document::COLUMN_TEMPLATE]);
			if (isset($_POST[Document::COLUMN_AUTHOR])) {
				$doc->setAuthorId($_POST[Document::COLUMN_AUTHOR]);
			}
			if (isset($_POST[Document::COLUMN_RIGHTS])) {
				$doc->setRights($_POST[Document::COLUMN_RIGHTS]);
			}
			if (isset($_POST[Document::COLUMN_TYPE])) {
				$doc->setType($_POST[Document::COLUMN_TYPE]);
			}
			if (isset($_POST[Document::COLUMN_LANG])) {
				$doc->setLanguage($_POST[Document::COLUMN_LANG]);
			}
			$doc->setEdited(date(DATE_ATOM, time()));
			$doc->save();
			echo 'ok';
		} else {
			echo 'fail';
		}
		exit();
	}
	
	public function actionAdd() {
		$doc = new Document();
		$doc->setName($_POST[Document::COLUMN_NAME]);
		$doc->setTemplate($_POST[Document::COLUMN_TEMPLATE]);
		if (isset($_POST[Document::COLUMN_AUTHOR])) {
			$doc->setAuthorId($_POST[Document::COLUMN_AUTHOR]);
		}
		if (isset($_POST[Document::COLUMN_RIGHTS])) {
			$doc->setRights($_POST[Document::COLUMN_RIGHTS]);
		}
		if (isset($_POST[Document::COLUMN_TYPE])) {
			$doc->setType($_POST[Document::COLUMN_TYPE]);
		}
		if (isset($_POST[Document::COLUMN_LANG])) {
			$doc->setLanguage($_POST[Document::COLUMN_LANG]);
		}
		$doc->setCreated(date(DATE_ATOM, time()));
		$doc->setEdited(date(DATE_ATOM, time()));
		if ($doc->save()) {
			echo 'ok';
		} else {
			echo 'fail';
		}
		exit();
	}
	
	public function handleAdd() {
//		$this->template->document = NULL;
		$this->template->setFile(__DIR__.'/../templates/Document/edit.latte');
	}
	public function handleEdit($id) {
		$doc = Document::getById($id);
		$this->template->document = $doc;
		$this->template->setFile(__DIR__.'/../templates/Document/edit.latte');
	}
	public function handleDelete($id) {
		try {
			$doc = Document::getById($id);
			if (!is_null($doc)) {
				$doc->delete();
				$this->flashMessage('smazano','info');
			} else {
				$this->flashMessage('chyba','error');
			}
			$this->redirect('Document:');
		} catch (\Exception $ex) {
			$this->flashMessage($ex->getMessage());
			$this->redirect('Error:', array('backlink' => $this->storeRequest()));
		}
		exit();
//		$this->template->setFile(__DIR__.'/../templates/Document/delete.latte');
	}
	 * 
	 */
}
