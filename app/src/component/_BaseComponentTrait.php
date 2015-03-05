<?php
namespace App\Model\Component;

use Nette\ComponentModel\IComponent;
/**
 * Description of _BaseComponentTrait
 * Functions for setting default things for components.
 * Should be extended by concrete component used within presenters 
 * for reuse of compponent code.
 *
 * @author KuBik
 */
class _BaseComponentTrait
{
	/**
	 * Setts default translator
	 * @param IComponent $cmp
	 */
	protected function setTranslator(IComponent $cmp)
	{
		
	}
}
