<?php

namespace App\Modules\Front\Presenters;

use Nette\Environment,
	App\Model\Document,
	Nette\Http\Response
		;
/**
 * Description of Document
 *
 * @author KuBik
 */
class DocumentPresenter extends BaseFrontPresenter {
	
	protected function getDocument($path) {
		$document = Document::getByPath($path);

		if (empty($document)) {
			$httpResponse = $this->context->getByType('Nette\Http\Response');
			$httpResponse->setCode(\Nette\Http\Response::S404_NOT_FOUND);
		}
		return $document[0];
	}
	
//	protected function startup() {
//		parent::startup();
//	}
//	
//	protected function beforeRender() {
//		
//		parent::beforeRender();
//		$tpl = isset($this->params['category']) || isset($this->params['name']) ? 'default' : $this->request->parameters['action'];
//		$this->template->setFile($this->getTplPath(Environment::getContext()->parameters['templates']. 'page/'.$tpl.'.latte'));
//		
//	}
	
	public function renderDefault() {
		$params = $this->getRequest()->getParameters();
//		dump($params);
		$category = isset($params['category']) ? $params['category'] : '';
		$name = isset($params['name']) ? $params['name'] : '';
		$page = isset($params['page']) ? $params['page'] : '';
		$lang = isset($params['lang']) ? $params['lang'] : '';
		$path = (!empty($category)?$category.'/':'').$name;
		try {
//			dump($path);
			
			$this->template->design = 'base1';
			$this->template->documents = array($this->getDocument($path));
		} catch (\Exception $ex) {
			$this->flashMessage($ex->getMessage());
			$this->redirect('Error:', array('backlink' => $this->storeRequest()));
		}
//		$this->template->design = 'base1';
//		$this->template->menuTop = \App\Model\Menu\Menu::getByPath($path);
	}
}
