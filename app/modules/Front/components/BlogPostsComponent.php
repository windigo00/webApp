<?php
namespace App\Modules\Front\Components;

use App\Model\Component
		;

/**
 * Description of BlogPostsComponet
 *
 * @author KuBik
 */
class BlogPostsComponent extends ComponentFront {
	/**
	 *
	 * @var App\Model\Entity
	 */
	protected $data;

	protected function setTpl($tplFile = '') {
		return parent::setTpl('new_blog_posts.latte');
	}

	public function setup($param) {
		$this->data = $param;
	}
	

}
