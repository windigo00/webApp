<?php

namespace App\Model;


/**
 * @Entity
 * @Table(name="documents")
 **/
class Document extends \App\Model\Entity {
	/** 
	 * @Id @Column(type="integer")
	 * @GeneratedValue 
	**/
	protected $id;
	/** @Column(type="string") **/
	protected $uid; //Unique id of document
	/** @Column(type="text") **/
//	protected $template;
	/**
     * @OneToOne(targetEntity="User")
     * @JoinColumn(name="autor", referencedColumnName="id")
     **/
//	protected $autor;
	
	/** @Column(type="integer") **/
//	protected $type;
	/** @Column(type="integer") **/
//	protected $lang;
	/** @Column(type="datetimetz") **/
//	protected $created;
	/** @Column(type="datetimetz") **/
//	protected $edited;
	/** @Column(type="integer") **/
//	protected $views;

	/**
	 * adds one view for document
	 */
	public function addView() {
		$this->set(static::COLUMN_VIEWS, $this->get(static::COLUMN_VIEWS)+1);
	}
	/**
	 * 
	 * @param type $path
	 * @return null
	 */
	public static function getByPath($path, $limit = 1) {
		/**
		 * @var \Doctrine\ORM\EntityManager
		 */
		$sel = self::getRepository()->findByPath($path);
		foreach($sel as $tmp){
			var_dump($tmp);
		}
		return $sel;
	}
	
	/**
	 * 
	 * @return string
	 */
	public function renderTemplate() {
		$tpl = $this->getTemplate();
		if (!empty($tpl)) {
			$doc = new \DOMDocument();
			if (@$doc->loadXML($tpl)) {
				$tpl = $doc->saveHTML($doc->getElementsByTagName('template')->item(0));
				$tpl = preg_replace('#\<(\/)?content\>#', '<$1div>', $tpl);
				$tpl = preg_replace('#\<(\/)?template\>#', '<$1div>', $tpl);
				$tpl = preg_replace('#\<(\/)?heading\>#', '<$1h1>', $tpl);
				
				if (preg_match_all('#\{\{([^\}]+)\}\}#', $tpl, $matches)) {
					foreach ($matches[1] as $match) {
						$tpl = str_replace('{{'.$match.'}}', View\View::renderPlugin($match, $this), $tpl);
					}
					
				}
			}
		}
		return $tpl;
	}
}
