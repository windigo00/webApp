<?php
namespace App\Model\Catalog;

use Doctrine\Common\Collections\AbstractLazyCollection
		;
/**
 * Description of ProductAttribute
 *
 * @author KuBik
 * 
 
 */

class ProductAttributeCollection extends AbstractLazyCollection
{
	/**
	 *
	 * @var Product
	 */
	protected $product;

	public function __construct($parent = NULL) {
		$this->product = $parent;
	}
	
	/**
	 * 
	 * @return Product
	 */
	public function getProduct() {
		return $this->product;
	}
	/**
	 * 
	 * @param Product $product
	 */
	public function setProduct(Product $product) {
		$this->product = $product;
	}

	protected function doInitialize() {
		$types = [
			"datetime"				=> "Datetime",
			"decimal"				=> "Decimal",
			"gallery"				=> "Gallery",
			"int"					=> "Integer",
			"media_gallery"			=> "MediaGallery",
			"media_gallery_value"	=> "MediaGalleryValue",
			"text"					=> "Text",
			"tier_price"			=> "TierPrice",
			"varchar"				=> "Varchar"
		];
		foreach ($types as $name => $class) {
			// get items for type
			$cmd = '$items = \\App\\Model\\Catalog\\Product\\Attribute\\'.$class.'::rep()->findByProduct($this->product);';
			eval($cmd);
			foreach ($items as $element) {
				$this->collection->add($element);
			}
		}
	}

}
