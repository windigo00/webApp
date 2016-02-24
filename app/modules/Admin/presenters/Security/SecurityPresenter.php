<?php

namespace App\Modules\Admin\Presenters;

/**
 * Ssecurity presenters.
 */
class SecurityPresenter extends SecureAdminPresenter
{

	public function renderNotAllowed($backlink = '') {
		$this->template->backlink = $backlink;
	}
}
