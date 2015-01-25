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
	protected function setTpl()
	{
		$this->template
			->setFile(dirname(__DIR__).'/../templates/components/top_menu.latte');
	}

}
