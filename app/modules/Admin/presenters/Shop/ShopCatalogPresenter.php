<?php
namespace App\Modules\Admin\Presenters;

use App\Model\Catalog\Category
	;
/**
 * Description of AdminShopCatalogPresenter
 *
 * @author KuBik
 */
class ShopCatalogPresenter extends ShopPresenter {
	
	
	
	public function renderEdit($id)
	{
		$categories = Category::findBy(array('parent'=>0));
		$this->template->categories = $categories;
		$this->template->category = Category::get($id);
	}
	public function renderDefault()
	{
		$categories = Category::findBy(array('parent'=>0));
		$this->template->categories = $categories;
	}
	
	
}
