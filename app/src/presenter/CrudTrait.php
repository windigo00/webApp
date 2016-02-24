<?php
namespace App\Presenters;

/**
 * CrudHandleTrait (CRUD Operations)
 *
 * @author KuBik
 */
trait CrudHandleTrait {
	protected $createHandlers = array();
	protected $viewHandlers = array();
	protected $editHandlers = array();
	protected $deleteHandlers = array();
	
	public function addCreateHandler($handler) {
		array_push($this->createHandlers, $handler);
	}
	public function addViewHandler($handler) {
		array_push($this->viewHandlers, $handler);
	}
	public function addEditHandler($handler) {
		array_push($this->editHandlers, $handler);
	}
	public function addDeleteHandler($handler) {
		array_push($this->deleteHandlers, $handler);
	}
	//--- handle calls
	public function handleCreate() {
		$ret = '';
		foreach ($this->createHandlers as $handler) {
			$ret .= call_user_func($handler);
		}
		return $ret;
	}
	public function handleView() {
		$ret = '';
		foreach ($this->viewHandlers as $handler) {
			$ret .= call_user_func($handler);
		}
		return $ret;
	}
	public function handleEdit($id) {
		$ret = '';
		foreach ($this->editHandlers as $handler) {
			$ret .= call_user_func($handler, $id);
		}
		return $ret;
	}
	public function handleDelete($id) {
		$ret = 'aaa';
		foreach ($this->deleteHandlers as $handler) {
			$ret .= call_user_func($handler, $id);
		}
		return $ret;
	}
}
