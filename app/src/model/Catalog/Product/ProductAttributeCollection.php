<?php
namespace App\Model\Catalog;

use Doctrine\Common\Collections\AbstractLazyCollection;
/**
 * Description of ProductAttribute
 *
 * @author KuBik
 */
class ProductAttributeCollection extends AbstractLazyCollection 
{
	/**
	 *
	 * @var Product
	 */
	protected $product;

	protected function doInitialize() {
		$attrSet = $this->product->attributeSet;
	}
}
