<?php

namespace App\Modules\Front\Presenters;

use Nette\Environment,
	Nette\Database\Context,
	App\Modules\Front\Model\Component\MenuComponent,
	App\Modules\Front\Model\Component\Breadcrumbs,
	App\Model\Presenters\BasePresenter

;

/**
 * Description of BasePresenterFrontFront
 *
 * @author KuBik
 */
abstract class BasePresenterFront extends BasePresenter {

	public function createComponentNavigation() {
		$ctrl = new MenuComponent();
		return $ctrl;
	}

	public function createComponentBreadcrumbs() {
		$ctrl = new Breadcrumbs();
		return $ctrl;
	}

	private $tplDir = NULL;
	protected function getTplPath($path = '') {
		if (is_null($this->tplDir)){
			$eds = addslashes(DIRECTORY_SEPARATOR);
			$this->tplDir = preg_replace('#('.$eds.'app'.$eds.'.+)$#', '', dirname($this->getReflection()->getFileName()));
		}
		$dir = $this->tplDir . ($path[0]=='/' ? '' : DIRECTORY_SEPARATOR) . $path;
		return $dir;
	}
	
	public function formatTemplateFiles() {
		$name = $this->getName();
		$cfgPath = Environment::getContext()->parameters['templates'];
		$dir = $this->getTplPath($cfgPath . 'default');
//		var_dump($dir);exit;
//		$dir = dirname($this->getReflection()->getFileName()) . '/../../../design/default';
		$dir = is_dir($dir) ? $dir : dirname($dir);
		return array(
			"$dir/{$this->view}.latte",
//			"$dir/2columns_left.latte",
		);
	}

}
