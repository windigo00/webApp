<?php

namespace App;

use Nette,
	Nette\Application\Routers\RouteList,
	Nette\Application\Routers\Route,
	Nette\Application\Routers\SimpleRouter;


/**
 * Router factory.
 */
class RouterFactory
{

	/**
	 * @return \Nette\Application\IRouter
	 */
	public function createRouter()
	{
		$router = new RouteList();
//		$router[] = new Route('<presenter>/<action>[/<id>]', 'Homepage:default');
                
		$router[] = $adminRouter = new RouteList('Admin');
		$adminRouter[] = new Route('admin/<presenter>/<action>/[<id>]', 'Dashboard:default');

		$router[] = $frontRouter = new RouteList('Front');
		$frontRouter[] = new Route('[<lang [a-z]{2}>[-<sublang>]/][<category>/]<name>[/page-<page=0>]', 'Document:default');
		$frontRouter[] = new Route('<presenter>/<action>[/<id>]', 'Document:home');
                
		return $router;
	}

}
