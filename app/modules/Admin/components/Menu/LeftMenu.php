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
	
	protected function setTpl($tplFile = '') {
		return parent::setTpl('left_menu.latte');
	}

}
