<?php

namespace App\Model\Document;

use Nette,
	App\Model\Document\View,
	App\Model\SitePath,
	App\Model\User\User,
	Doctrine\ORM\Mapping\Entity,
	Doctrine\ORM\Mapping\Column,
	Doctrine\ORM\Mapping\OneToOne,
	Doctrine\ORM\Mapping\ManyToOne,
	Doctrine\ORM\Mapping\Id,
	Doctrine\Common\Collections\ArrayCollection
		;

/**
 * @Entity
 * @Table(name="document")
 **/
class Document extends \App\Model\Entity {
	/** 
	 * @Id @Column(type="integer")
	 * @GeneratedValue 
	**/
	protected $id;
	/** @Column(type="string") **/
	protected $docname;
	/** @Column(type="text") **/
	protected $template;
	/**
     * @OneToOne(targetEntity="User")
     * @JoinColumn(name="author", referencedColumnName="id")
     **/
	protected $autor;
	/**
     * @ManyToOne(targetEntity="Acl")
     * @JoinColumn(name="rights", referencedColumnName="user_id")
     **/
	protected $rights;
	/** @Column(type="integer") **/
	protected $typ;
	/** @Column(type="integer") **/
	protected $lang;
	/** @Column(type="datetimetz") **/
	protected $created;
	/** @Column(type="datetimetz") **/
	protected $edited;
	/** @Column(type="integer") **/
	protected $views;

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
		$sel = self::getRepository()->repo->findByPath($path);
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
