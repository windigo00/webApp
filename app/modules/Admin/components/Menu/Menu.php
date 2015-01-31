<?php
namespace App\Modules\Admin\Components;

use App\Model\EditableControl
	;
/**
 * Description of Menu
 *
 * @author KuBik
 */
abstract class Menu extends AdminControl{
	/**
	 * to redefine as needed
	 * @return string
	 */
	public function getMenu() { return 'menu'; }
	public static function process($data) {
//		ksort($data);
		foreach ($data as $name => $item) {
			$data[$name] = new MenuItem($name, $item);
		}
		return $data;
	}


	public function render() {
		$data = \App\Configs\AppConfig::getParameter($this->getMenu());
		$this->template->menu = self::process($data);
		parent::render();
	}
}

class MenuItem {
	protected $items;
	protected $data;
	protected $name;
	
	public function __get($param) {
		if ($param == 'children'){
			return $this->items;
		}
		elseif ($param == 'name'){
			return $this->name;
		}
		elseif (isset ($this->data[$param])){
//			if ($param == 'presenter' && !empty($this->data[$param]))
//			{
//				var_dump(strpos($param, ':'));
//				if (strpos($param, ':') === FALSE) {
//					$this->data[$param] = ucfirst($this->data[$param]).':default';
//				}
//			}
			return $this->data[$param];
		}else return NULL;
	}


	public function __construct($name, $data) {
		$this->name = $name;
		$this->data = $data;
		if (isset($data['items'])) {
			$this->items = Menu::process($data['items']);
		}
	}
	public function hasChildren() {
		return is_array($this->items) && !empty($this->items);
	}
	public function getItems() {
		return $this->items;
	}
}