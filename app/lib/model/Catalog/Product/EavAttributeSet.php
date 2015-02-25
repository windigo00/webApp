<?php


namespace App\Model\Eav;
use App\Model\Entity;
/**
 * Description of EavAttributeSet
 *
 * @author KuBik
 * @Entity
 * @Table(name="eav_attribute_set")
 */
class EavAttributeSet extends Entity {
	/** 
	 * @Id @Column(type="smallint")
	 * @GeneratedValue 
	**/
	protected $attribute_set_id;
	/** @Column(type="smallint") **/
	protected $entity_type_id;
	/** @Column(type="string") **/
	protected $attribute_set_name;
	/** @Column(type="smallint") **/
	protected $sort_order;
}
