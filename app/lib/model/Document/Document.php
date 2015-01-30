<?php

namespace App\Model\Document;

use Nette,
	App\Model\Document\View,
	App\Model\SitePath,
	App\Model\User\User,
	Doctrine\ORM\Mapping AS ORM,
	Doctrine\Common\Collections\ArrayCollection;

/**
 * Description of Document
 * @ORM\Entity
 * @Table(name="document")
 * @author KuBik
 */
class Document {

//	const
//			TABLE_NAME = 'document',
//			
//			COLUMN_NAME = 'docname',
//			COLUMN_TEMPLATE = 'template',
//			COLUMN_AUTHOR = 'autor',
//			COLUMN_RIGHTS = 'rights',
//			COLUMN_TYPE = 'typ',
//			COLUMN_LANG = 'lang',
//			COLUMN_CREATED = 'created',
//			COLUMN_EDITED = 'edited',
//			COLUMN_VIEWS = 'views';

	protected $author;
	// getters
	public function getTemplate() {
		return $this->get(static::COLUMN_TEMPLATE);
	}
	public function getName() {
		return $this->get(static::COLUMN_NAME);
	}
	public function getAuthorId() {
		return $this->get(static::COLUMN_AUTHOR);
	}
	public function getAuthor() {
		$usrId = $this->get(static::COLUMN_AUTHOR);
		if (is_null($this->author))
			$this->author = User::getById($usrId);
		return $this->author;
	}
	public function getRights() {
		return $this->get(static::COLUMN_RIGHTS);
	}
	public function getType() {
		return $this->get(static::COLUMN_TYPE);
	}
	public function getLanguage() {
		return $this->get(static::COLUMN_LANG);
	}
	public function getCreated() {
		return $this->get(static::COLUMN_CREATED);
	}
	public function getEdited() {
		return $this->get(static::COLUMN_EDITED);
	}
	public function getViews() {
		return $this->get(static::COLUMN_VIEWS);
	}
	// setters
	public function setTemplate($tpl) {
		$this->set(static::COLUMN_TEMPLATE, $tpl);
	}
	public function setName($name) {
		$this->set(static::COLUMN_NAME, $name);
	}
	public function setAuthorId($author) {
		$this->set(static::COLUMN_AUTHOR, $author);
	}
	public function setRights($rights) {
		$this->set(static::COLUMN_RIGHTS, $rights);
	}
	public function setType($type) {
		$this->set(static::COLUMN_TYPE, $type);
	}
	public function setLanguage($lang) {
		$this->set(static::COLUMN_LANG, $lang);
	}
	public function setCreated($time) {
		$this->set(static::COLUMN_CREATED, $time);
	}
	public function setEdited($time) {
		$this->set(static::COLUMN_EDITED, $time);
	}
	public function setViews($views) {
		$this->set(static::COLUMN_VIEWS, $views);
	}
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
		global $entityManager;
		$r = $entityManager->getRepository('Menu');
		$res = $r->findAll();
//		$selection = static::getTable()
//				->where(static::TABLE_NAME.'.'.static::COLUMN_ID.'=document_site_path.document_id')
//				->where(SitePath::TABLE_NAME.'.id=document_site_path.site_path_id')
//				->where(SitePath::TABLE_NAME.'.path=\''.$path)
//				->limit($limit);
//		$sql =	'SELECT '.static::TABLE_NAME.'.* FROM '.static::TABLE_NAME.
//				' LEFT JOIN document_site_path ON '.static::TABLE_NAME.'.'.static::COLUMN_ID.'=document_site_path.document_id'.
//				' LEFT JOIN site_path ON '.SitePath::TABLE_NAME.'.id=document_site_path.site_path_id'.
//				' WHERE '.SitePath::TABLE_NAME.'.path=\''.$path.'\' LIMIT '.intval($limit);
//				;
//		$docs = $limit > 1 ? array() : NULL;
//		$res = static::getDB()->query($sql);
		while($tmp = $selection->fetch()){
			var_dump($tmp);
			if ($limit > 1) {
				$docs = new static($tmp);
			} else {
				$docs[] = new static($tmp);
			}
		}
		return $docs;
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
