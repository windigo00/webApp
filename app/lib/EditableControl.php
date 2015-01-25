<?php
namespace App\Model;

use Nette,
	App\Model\TranslatedControl;
/**
 * Description of EditableControl
 *
 * @author KuBik
 */
abstract class EditableControl extends TranslatedControl {
	public function addAddHandler($handler) {
		array_push($this->addHandlers, $handler);
	}
	protected $addHandlers = array();
	public function handleAdd() {
		$ret = '';
		foreach ($this->addHandlers as $handler) {
			$ret .= call_user_func($handler);
		}
		return $ret;
	}
	public function addEditHandler($handler) {
		array_push($this->editHandlers, $handler);
	}
	protected $editHandlers = array();
	public function handleEdit($id) {
		$ret = '';
		foreach ($this->editHandlers as $handler) {
			$ret .= call_user_func($handler, $id);
		}
		return $ret;
	}
	public function addDeleteHandler($handler) {
		array_push($this->deleteHandlers, $handler);
	}
	protected $deleteHandlers = array();
	public function handleDelete($id) {
		$ret = '';
		foreach ($this->deleteHandlers as $handler) {
			$ret .= call_user_func($handler, $id);
		}
		return $ret;
	}
}
