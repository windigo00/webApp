<?php
namespace App\Model;

use App\Model\TranslatedControl;
/**
 * Description of EditableControl
 *
 * @author KuBik
 */
abstract class EditableControl extends TranslatedControl {
	use \App\Presenters\CrudHandleTrait;
}
