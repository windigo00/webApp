<?php
namespace App\Modules\Admin\Components;

/**
 * Description of Menu
 *
 * @author KuBik
 */
abstract class Menu extends AdminControl{
	/**
	 * to redefine as needed
	 * handle in 'parameters' part of config that holds menu strusture.
	 * @return string
	 */
	public function getMenu() { return 'menu'; }
	/**
	 * 
	 * @param \App\Modules\Admin\Components\MenuItem $data
	 * @param \App\Modules\Admin\Components\AdminControl $container
	 * @return \App\Modules\Admin\Components\MenuItem
	 */
	public static function process($data, $container) {
		
		foreach ($data as $name => &$item) {
			$item = new MenuItem($name, $item, $container);
		}
		
		uasort($data, function($a, $b){
			if ($a->priority == NULL && $b->priority == NULL) {
				return 0;
			} elseif ($a->priority == NULL) {
				return 1;
			} elseif ($b->priority == NULL) {
				return -1;
			}
			if ($a->priority === $b->priority) {
				return 0;
			}
			$ret = ($a->priority < $b->priority) ? -1 : 1;
			return $ret;
		});
		return $data;
	}
	
	public function render() {
		$data = \App\Configs\AppConfig::getParameter($this->getMenu());
		$this->template->menu = self::process($data, $this);
		parent::render();
	}
}

class MenuItem {
	protected $items;
	protected $data;
	protected $name;
	
	public function __get($param) {
		$ret = NULL;
		if ($param == 'children'){
			$ret = $this->items;
		}
		elseif ($param == 'name'){
			$ret = $this->name;
		}
		elseif (isset($this->data[$param])) {
			$ret = $this->data[$param];
		}
		return $ret;
	}

	/**
	 * 
	 * @param string $name
	 * @param mixed $data
	 * @param \Nette\Application\UI\Control $container
	 */
	public function __construct($name, $data, $container) {
		$this->name = $name;
		$this->data = $data;
		if (isset($data['items'])) {
			$this->items = Menu::process($data['items'], $container);
		}
		if (isset($data['component'])) {
			$tmp = trim('\App\Modules\Admin\Components\\'.$data['component']);
			$this->component = new $tmp;
			$container->addComponent($this->component, $name);
		}
	}
	public function hasChildren() {
		return is_array($this->items) && !empty($this->items);
	}
	public function getItems() {
		return $this->items;
	}
	public function handle() {
		dump(func_get_args());
	}
}