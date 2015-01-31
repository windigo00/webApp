<?php
namespace App\Modules\Admin\Presenters;

use Nette,
    App\Model
        ;

/**
 * Description of UserPresenter
 *
 * @author KuBik
 */
class UserPresenter extends BaseAdminPresenter {
	public function renderProfile() {
		$this->template->user = $this->getUser();
	}
}
