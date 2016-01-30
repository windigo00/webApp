<?php
namespace App\Modules\Admin\Presenters;

/**
 * Description of AdminModule
 *
 * @author KuBik
 */
abstract class AdminModulePresenter extends SecureAdminPresenter {
	protected function getTemplateFilesPath($presenter, $view) {
		$view = explode(':', $view)[1];
		$view = str_replace($presenter, '', $view);
		return $presenter . '/' . $view;
	}
}
