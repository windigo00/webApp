<?php
namespace App\Model;

/**
 * Description of Entity
 *
 * @author KuBik
 */
class Entity {
	public function __call($method, $params) {
		$getset = substr($method, 0, 3);
		$rest = substr($method, 3);
		switch ($getset) {
			case 'get':
				isset($this, $rest);
				break;
			case 'set':
				break;
			default :
				break;
		}
	}
}
