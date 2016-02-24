<?php

namespace App\Modules\Admin\Components;

use Nette\ComponentModel\IContainer,
	Nette\Forms\Controls,
	App\Helper\XMLHelper
		;

/**
 * Description of PageComponent
 *
 * @author KuBik
 */
class PageTemplate extends AdminControl implements \Nette\Forms\IControl {
	
	protected $options = array();
	protected $errors = array();
	/**
	 * data for page template
	 * @var mixed
	 */
	protected $value;
	/**
	 *
	 * @var \DOMXPath
	 */
	protected $xp;
	
	protected function setTpl($tplFile = '') {
		return parent::setTpl(empty($tplFile) ? '../Cms/Page/template.latte' : $tplFile);
	}
	
	public function __construct(IContainer $parent = NULL, $name = NULL) {
		parent::__construct($parent, $name);
		$this->addComponent(new Controls\HiddenField(''), 'tpl_data');
		$tpl = new Controls\SelectBox('Template', $this->getTemplateList());
		$tpl->setValue('1-col');
		$tpl->setAttribute('onchange', 'tplEditor.templateChange(this);');
		$this->addComponent($tpl, 'tpl_select');
	}
	
	protected function getTemplateList() {
		return array(
			'1-col' => '1 column',
			'2-col-left' => '2 columns, left small',
			'2-col-right' => '2 columns, right small',
			'3-col' => '3 columns'
		);
	}
	
	public function handleView() {
		parent::handleView();
		$this->redrawControl();
		exit;
	}
	public function handleChange($tpl) {
		$this['tpl_select']->setValue($tpl);
		$this->template->isAjax = TRUE;
		$this->redrawControl('template');
	}

	public function getErrors() {
		return $this->errors;
	}

	public function getValue() {
		
	}

	public function isOmitted() {
		return FALSE;
	}
	public function isDisabled() {
		return FALSE;
	}
	public function setValue($value) {
		$doc = new \DOMDocument();
		if ($doc->loadXML($value) == FALSE) {
			throw new Exception('page xml error: '. $value);
		}
		$xp = $this->xp = new \DOMXPath($doc);
		$this->value = array();
		$page = $doc->getElementsByTagName('page')[0];
		$containers = $xp->query('./*', $page);
		for ($i=0; $i <= $containers->length; $i++) {
			$cnt = $containers->item($i);
			if(!is_null($cnt)) {
				$this->value[$cnt->tagName] = XMLHelper::xml_to_std($cnt, [XML_TEXT_NODE , XML_COMMENT_NODE]);
			}
		}
		$this['tpl_data']
				->setAttribute('id', 'tpl_data')
				->setAttribute('data-tpl', json_encode($this->value));
		$this['tpl_select']->setValue($page->getAttribute('tpl'));
	}

	public function translate($s, $count = NULL) {
		return $this->getTranslator()->translate($s, $count);
	}

	public function validate() {
	}

	/**
	 * Returns form.
	 * @param  bool   throw exception if form doesn't exist?
	 * @return Form
	 */
	public function getForm($need = TRUE)
	{
		return $this->lookup('Nette\Forms\Form', $need);
	}


	/**
	 * Loads HTTP data.
	 * @return void
	 */
	public function loadHttpData()
	{
		$this->setValue($this->getHttpData(\Nette\Forms\Form::DATA_TEXT));
	}


	/**
	 * Loads HTTP data.
	 * @return mixed
	 */
	public function getHttpData($type, $htmlTail = NULL)
	{
		return $this->getForm()->getHttpData($type, $this->getHtmlName() . $htmlTail);
	}
	/**
	 * Returns HTML name of control.
	 * @return string
	 */
	public function getHtmlName()
	{
		return \Nette\Forms\Helpers::generateHtmlName($this->lookupPath('Nette\Forms\Form'));
	}
	
	/********************* user data ****************d*g**/


	/**
	 * Sets user-specific option.
	 * @return self
	 */
	public function setOption($key, $value)
	{
		if ($value === NULL) {
			unset($this->options[$key]);
		} else {
			$this->options[$key] = $value;
		}
		return $this;
	}


	/**
	 * Returns user-specific option.
	 * @return mixed
	 */
	public function getOption($key, $default = NULL)
	{
		return isset($this->options[$key]) ? $this->options[$key] : $default;
	}


	/**
	 * Returns user-specific options.
	 * @return array
	 */
	public function getOptions()
	{
		return $this->options;
	}
}
