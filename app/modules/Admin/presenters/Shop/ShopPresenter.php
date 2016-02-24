<?php
namespace App\Modules\Admin\Presenters;

use App\Modules\Admin\Components\AdminTable,
	App\Model\Shop;
/**
 * Description of AdminModule
 *
 * @author KuBik
 */
class ShopPresenter extends ModulePresenter {
	
	public function formatTemplateFiles($view = NULL) {
		return parent::formatTemplateFiles($this->getTemplateFilesPath('Shop', $this->getName()));
	}
	
	protected function createComponentShopList($name) {
		$grid = new AdminTable($this, $name);
		$grid->addColumnText('id', 'Id')->setSortable();
		$grid->addColumnText('title', 'Title')->setSortable();
		$grid->addColumnDate('created', 'created')->setSortable()->setFilterDateRange();
		return $grid;
	}
	
	public function renderDefault() {
		$this['shopList']->setModel(Shop::getQB('s'));
	}
}
