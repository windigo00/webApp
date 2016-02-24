<?php
namespace App\Modules\Admin\Components;

use \App\Admin\Model\Language;
/**
 * Description of LangSelector
 *
 * @author KuBik
 */
class LangSelector extends AdminControl {
	
	public function setup($param) {
		parent::setup($param);
		$langs = Language::getAll();
		$this->template->items = $langs;
	}
	
	protected function setTpl($tplFile = '') {
		return parent::setTpl('langselector.latte');
	}
	
	public function handleClick($lang) {
		$ctrl = $this->getPresenter();
		$tr = \App\Model\Translator::get();
		if ($tr->setLang($lang)){
			$ctrl->getSession('lang')->lang = $lang;
			$ctrl->flashMessage($tr->translate('Language selected: %s', $lang));
		} else {
			$ctrl->flashMessage($tr->translate('Language "%s" does not exist :D', $lang));
		}
	}
}
