<?php

namespace App;

use Nette\Application\Routers\RouteList,
	Nette\Application\Routers\Route,
	Nette\Application\IRouter;


/**
 * Router factory.
 */
class RouterFactory
{

	
	/**
	 * @return \Nette\Application\IRouter
	 */
	public static  function createRouter($routes = NULL)
	{
		$router = new RouteList();
		$refl = new \ReflectionClass('\Nette\Application\Routers\Route');
		if ($routes) {
			foreach ($routes as $module => $matches) {
				if (count($matches)) {
					$router[] = $tmpRouter = new RouteList(ucfirst($module));
					foreach ($matches as $route) {
						$tmpRouter[] = $refl->newInstanceArgs($route);
					}
				}
			}
		}
		return $router;
	}

}
