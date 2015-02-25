<?php
namespace App\Model\Catalog;

use App\Model\Entity;

/**
 * Description of Category
 *
 * @author KuBik
 * @Entity
 * @Table(name="catalog_category_entity")
 */
class Category extends Entity {
	/** 
	 * @Id @Column(type="integer")
	 * @GeneratedValue 
	**/
	protected $entity_id;
	/** @Column(type="smallint") **/
	protected $entity_type_id;
	/** @Column(type="smallint") **/
	protected $attribute_set_id;
	/** @Column(type="integer") **/
	protected $parent_id;
	/** @Column(type="datetime") **/
	protected $created_at;
	/** @Column(type="datetime") **/
	protected $updated_at;
	/** @Column(type="string") **/
	protected $path;
	/** @Column(type="integer") **/
	protected $position;
	/** @Column(type="integer") **/
	protected $level;
	/** @Column(type="integer") **/
	protected $children_count;
}
