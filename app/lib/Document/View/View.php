<?php
namespace App\Model\Document\View;

//use App\Model\Document\View;
/**
 * Description of View
 *
 * @author KuBik
 */
class View {
	
	public static function __callStatic($name, $arguments) {
		return print_r(func_get_args(),1);
	}
	
//	public static function preview_last($action, $params = NULL, $data = NULL) {
//		
//		
//	}
	
	public static function renderPlugin($pluginString, $data = NULL) {
		$params = explode(' ', $pluginString);
		$tmp = array_shift($params);
		if ($tmp == 'document') {
			$tmp = 'view';
		}
		$ctrl = ucfirst($tmp);
		$action = array_shift($params);
		$action = str_replace(':', '_', $action);
		$obj = NULL;
		try {
			$cmd = "\$obj = ".__NAMESPACE__."\\{$ctrl}::{$action}(\$params, \$data);";
			
			eval($cmd);
		} catch (Exception $ex) {
			throw $ex;
		}
		return $obj;
	}
}
