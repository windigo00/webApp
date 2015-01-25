<?php
namespace App\Modules\Admin\Components;

use Nette\Application\UI\Control
	;
/**
 * Description of TopMenu
 *
 * @author KuBik
 */
class LeftMenu extends Menu{
	
	public function setTpl() {
		$this->template
			->setFile(dirname(__DIR__).'/../templates/components/left_menu.latte');
	}
}
