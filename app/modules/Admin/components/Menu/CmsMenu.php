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
	protected function setTpl($tplFile = '') {
		return parent::setTpl('cms_menu.latte');
	}
}
