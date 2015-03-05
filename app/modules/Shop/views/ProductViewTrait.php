<?php
namespace App\Modules\Shop\Views;
/**
 * Description of ProductView
 *
 * @author KuBik
 */
trait ProductViewTrait
{
//	public function createComponent() {}
	public function createComponentProductDetailForm() {
		$form = new \Nette\Application\UI\Form();
		
		$form->addHidden('productId');
		$form->addHidden('relatedProduct');
		$form->addSubmit('addtocart','Add To Cart');
		return $form;
	}
	
	protected function setTemplateData($product)
	{
		$this->template->messagesBlock = 'aaaaaaaaa';
		$this->template->product = $product;
	}
}
