<?php
namespace App\Modules\Shop\Presenters;

use App\Model\Catalog\Product,
	App\Model\Catalog\Category,
	App\Model\LangPath,
	App\Modules\Shop\Views\ProductViewTrait
		;
/**
 * Description of ProductPresenter
 *
 * @author KuBik
 */
class ProductPresenter extends BaseShopPresenter {
	
	use ProductViewTrait;
	
	public function renderDetail() {
		$productId = LangPath::getUid(Product::getClass(), $this->params['name']);
		$product = Product::get($productId);
		$this->setTemplateData($product);
		
		dump($product);
//		exit;
	}
}
