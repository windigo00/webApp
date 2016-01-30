<?php

namespace App\Modules\Front\Presenters;

use App\Modules\Front\Components\MenuComponent,
	App\Modules\Front\Components\Breadcrumbs,
	App\Model\Presenters\BasePresenter,
	App\Modules\Front\Components\BlogPostsComponent,
	App\Model\BlogPost
;

/**
 * Description of BasePresenterFrontFront
 *
 * @author KuBik
 */
abstract class BaseFrontPresenter extends BasePresenter {

	public function createComponentNewBlogPosts() {
		$ctrl = new BlogPostsComponent();
		$ctrl->setup(BlogPost::loadNew(5));
		return $ctrl;
	}
	
	public function createComponentNavigation() {
		$ctrl = new MenuComponent();
		$ctrl->setup($this->loadMenu());
		return $ctrl;
	}

	public function createComponentBreadcrumbs() {
		$ctrl = new Breadcrumbs();
		return $ctrl;
	}

	/**
	 * 
	 * @return \App\Model\Menu
	 */
	protected function loadMenu() {
		return \App\Model\Menu::get(6);
	}
	
	protected $scripts = array();
	public function addScript($link) {
		if (is_array($link)) {
			$this->scripts = array_merge($this->scripts, $link);
		} elseif(!empty ($link)) {
			$this->scripts[] = $link;
		}
	}
	public function getScripts() {
		return $this->scripts;
	}
	
}
