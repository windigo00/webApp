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
		
		$this->template->user = \App\Model\User::get($this->presenter->user->id);
		return parent::setTpl('top_menu.latte');
	}
	
}
