<?php
namespace App\Modules\Shop\Presenters;

use App\Model\Catalog\Product,
	App\Model\Catalog\Category;

/**
 * Description of CatalogPresenter
 *
 * @author KuBik
 */
class CatalogPresenter extends BaseShopPresenter {
	
	public function createComponentCategoryFilter() {
		return new \Nette\Forms\Form;
	}
	
	public function renderCategory() {
//		dump($this->params);
		$categories = Category::getRepository()->findAll();
		$products = Product::getRepository()->findAll();
		
		$this->template->categories = $categories;
		$this->template->products = $products;
	}
}
