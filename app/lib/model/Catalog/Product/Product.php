<?php

namespace App\Model\Catalog;
use App\Model\Entity,
	App\Model\LangPath;
/**
 * @author KuBik
 * @Entity
 * @Table(name="catalog_product_entity")
 **/
class Product extends Entity {
	/** 
	 * @Id @Column(type="integer")
	 * @GeneratedValue 
	**/
	protected $entity_id;
	/**
     * @OneToOne(targetEntity="App\Model\Eav\EavEntityType")
     * @JoinColumn(referencedColumnName="entity_type_id")
	 *
	 */
	protected $entity_type;
	/** @Column(type="smallint") **/
	/**
     * @OneToOne(targetEntity="App\Model\Eav\EavAttributeSet")
     * @JoinColumn(referencedColumnName="attribute_set_id")
     **/
	protected $attribute_set;
	/** @Column(type="string") **/
	protected $type_id;
	/** @Column(type="string") **/
	protected $sku;
	/** @Column(type="smallint") **/
	protected $has_options;
	/** @Column(type="smallint") **/
	protected $required_options;
	/** @Column(type="datetime") **/
	protected $created_at;
	/** @Column(type="datetime") **/
	protected $updated_at;
	
	protected $urlPath;
	public function getUrlPath($presenter) {
		if (!$this->urlPath) {
			$this->urlPath = LangPath::getPath(__CLASS__, $this->entity_id);
			if ($this->urlPath) {
				$this->urlPath = $this->urlPath->value;
			} else {
				$this->urlPath = '';
			}
		}
		return $this->urlPath.'.html';
		
	}
}
