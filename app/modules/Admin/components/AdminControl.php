<?php
namespace App\Modules\Admin\Components;

use App\Model\EditableControl;

/**
 * Description of AdminControl
 *
 * @author KuBik
 */
abstract class AdminControl extends EditableControl {
	public function setup($param) {
		$this->template->data = $param;
	}
}
