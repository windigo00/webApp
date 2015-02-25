<?php

namespace App\Modules\Shop\Presenters;

/**
 * Ssecurity presenters.
 */
class SecurityPresenter extends BaseShopPresenter
{

	public function renderDefault($backlink) {
		
		dump($backlink);
	}
	public function renderNotAllowed($backlink) {
		dump($backlink);
	}
}
