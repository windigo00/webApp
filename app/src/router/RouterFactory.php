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
		if ($routes) {
			foreach ($routes as $module => $matches) {
				if (count($matches)) {
					$router[] = $tmpRouter = new RouteList(ucfirst($module));
					foreach ($matches as $route) {
						$tmpRouter[] = new Route($route[0], $route[1]);
					}
				}
			}
		}
		return $router;
	}

}
