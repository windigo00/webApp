<?php
namespace App\Model;

use Doctrine\ORM\Mapping\Table,
	Doctrine\ORM\Mapping\Entity,
	Doctrine\ORM\Mapping\Column,
	Doctrine\ORM\Mapping\Id,
	Doctrine\ORM\Mapping\GeneratedValue
		;
/**
 * Documents
 *
 * @Table(name="cms_documents")
 * @Entity
 */
class OldDocument extends AbstractModel {
	
	/**
     * @var integer
     *
     * @Column(type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @Column(type="string", length=255, nullable=false)
     */
    protected $uid;

	
	/**
     * @var string
     *
     * @Column(type="string", length=1024, nullable=false)
     */
    protected $path;
	/**
     * @var string
     *
     * @Column(type="string", length=1024, nullable=false)
     */
    protected $title;
	/**
     * @var string
     *
     * @Column(type="string", length=1024, nullable=false)
     */
    protected $author;
	/**
     * @var string
     *
     * @Column(type="string", length=10, nullable=false)
     */
    protected $language;
	/**
     * @var string
     *
     * @Column(type="string", length=1024, nullable=false)
     */
	protected $module;
	
	/**
     * @var string
     *
     * @Column(type="string", length=1024, nullable=false)
     */
	protected $content;
	/**
     * @var integer
     *
     * @Column(type="datetime", nullable=false)
     */
	protected $created;
	/**
     * @var integer
     *
     * @Column(type="datetime", nullable=false)
     */
	protected $published;
	
	/**
	 * adds one view for document
	 */
	public function addView() {
//		$this->set(static::COLUMN_VIEWS, $this->get(static::COLUMN_VIEWS)+1);
	}
	/**
	 * 
	 * @param type $path
	 * @return null
	 */
//	public static function getByPath($path, $limit = 1) {
//		$sel = self::getRepository()->findByPath($path);
//		foreach($sel as &$tmp){
//			$tmp = new self($tmp);
//		}
//		return $sel;
//	}
	
//	public static function getAll() {
//		$sel = self::getRepository()->getAll();
//		dump($sel);
//		foreach($sel as &$tmp){
//			$tmp = new self($tmp);
//		}
//		return $sel;
//	}
	
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
