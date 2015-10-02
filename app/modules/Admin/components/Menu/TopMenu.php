<?php
namespace App\Modules\Admin\Components;

use Nette\Application\UI\Control
	;
/**
 * Description of TopMenu
 *
 * @author KuBik
 */
class TopMenu extends Menu{
	public function getMenu() { return 'menu-top'; }

	protected function setTpl($tplFile = ''){
//		dump($this->presenter->user);
		$this->template->user = $this->presenter->user !== null ? \App\Model\User::get($this->presenter->user->id) : null;
		return parent::setTpl('top_menu.latte');
	}

	public function setup($param) {}

}
