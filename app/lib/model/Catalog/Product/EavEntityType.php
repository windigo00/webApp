<?php

namespace App\Model\Eav;
use App\Model\Entity;
/**
 * Description of EavEntityType
 *
 * @author KuBik
 * @Entity
 * @Table(name="eav_entity_type")
 */
class EavEntityType extends Entity {
	/** 
	 * @Id @Column(type="integer")
	 * @GeneratedValue 
	**/
	protected $entity_type_id;
	/** @Column(type="string") **/
	protected $entity_type_code;
	/** @Column(type="string") **/
	protected $entity_model;
	/** @Column(type="string") **/
	protected $attribute_model;
	/** @Column(type="string") **/
	protected $entity_table;
	/** @Column(type="string") **/
	protected $value_table_prefix;
	/** @Column(type="string") **/
	protected $entity_id_field;
	/** @Column(type="smallint") **/
	protected $is_data_sharing;
	/** @Column(type="string") **/
	protected $data_sharing_key;
	/** @Column(type="smallint") **/
	protected $default_attribute_set_id;
	/** @Column(type="string") **/
	protected $increment_model;
	/** @Column(type="smallint") **/
	protected $increment_per_store;
	/** @Column(type="smallint") **/
	protected $increment_pad_length;
	/** @Column(type="string") **/
	protected $increment_pad_char;
	/** @Column(type="string") **/
	protected $additional_attribute_table;
	/** @Column(type="string") **/
	protected $entity_attribute_collection;

}