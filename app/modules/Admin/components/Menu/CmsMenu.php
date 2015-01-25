<?php
namespace App\Modules\Admin\Components;

use Nette\Application\UI\Control,
	App\Modules\Admin\Components\CmsMenu
		;
/**
 * Description of CmsMenu
 *
 * @author KuBik
 */
class CmsMenu  extends Menu{
	public function setTpl() {
		$this->template
			->setFile(dirname(__DIR__).'/../templates/components/cms_menu.latte');
	}
}
