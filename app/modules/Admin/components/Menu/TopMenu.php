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
//		dump($this->presenter->user->identity->getData());
		$uid = $this->presenter->user->identity->getId();
		$this->template->user = \App\Model\User::get($uid);
		return parent::setTpl('top_menu.latte');
	}
}
