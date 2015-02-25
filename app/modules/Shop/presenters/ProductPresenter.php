<?php
namespace App\Modules\Shop\Presenters;

use App\Model\Catalog\Product,
	App\Model\Catalog\Category;
/**
 * Description of ProductPresenter
 *
 * @author KuBik
 */
class ProductPresenter extends BaseShopPresenter {
	public function renderDetail() {
		$product = \App\Model\LangPath::getUid(Product::getClass(), $this->params['name']);
		$product = Product::get($product);
		dump($product);
		exit;
	}
}
