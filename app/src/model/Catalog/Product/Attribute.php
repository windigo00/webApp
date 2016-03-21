<?php

namespace App\Model\Catalog\Product\Attribute;

use App\Model\AbstractModel,
	Doctrine\ORM\Mapping\Entity,
	Doctrine\ORM\Mapping\Id,
	Doctrine\ORM\Mapping\Column,
	Doctrine\ORM\Mapping\GeneratedValue,
	Doctrine\ORM\Mapping\OneToOne,
	Doctrine\ORM\Mapping\JoinColumn,
	Doctrine\ORM\Mapping\InheritanceType,
	Doctrine\ORM\Mapping\DiscriminatorColumn,
	Doctrine\ORM\Mapping\DiscriminatorMap,
	Doctrine\ORM\Mapping\MappedSuperclass
		;

/**
 * Description of Attribute
 *
 * @author KuBik
 * 
 * @MappedSuperclass
 * @ InheritanceType("JOINED")
 * @ DiscriminatorColumn(name="entity_type_id", type="int")
 * @ DiscriminatorMap({
 *      "datetime"				= "\App\Model\Catalog\Product\Attribute\Datetime",
 *		"decimal"				= "\App\Model\Catalog\Product\Attribute\Decimal",
 *		"gallery"				= "\App\Model\Catalog\Product\Attribute\Gallery",
 *		"int"					= "\App\Model\Catalog\Product\Attribute\Integer",
 *		"media_gallery"			= "\App\Model\Catalog\Product\Attribute\MediaGallery",
 *		"media_gallery_value"	= "\App\Model\Catalog\Product\Attribute\MediaGalleryValue",
 *		"text"					= "\App\Model\Catalog\Product\Attribute\Text",
 *		"tier_price"			= "\App\Model\Catalog\Product\Attribute\TierPrice",
 *		"varchar"				= "\App\Model\Catalog\Product\Attribute\Varchar"
 * })
 */
abstract class Attribute extends AbstractModel 
{
	/**
     * @var integer
     *
     * @Column(name="value_id", type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    protected $id;
	
	/**
     * @var Product
     *
     * @OneToOne(targetEntity="App\Model\Catalog\Product")
     * @JoinColumn(name="entity_id", referencedColumnName="id")
     */
    protected $product;
	/**
     * @var \App\Model\Eav\EavEntityType
     *
     * @OneToOne(targetEntity="App\Model\Eav\EavEntityType")
     * @JoinColumn(name="entity_type_id", referencedColumnName="id")
     */
	protected $entityType;
	/**
     * @var \App\Model\Eav\EavAttribute
     *
     * @OneToOne(targetEntity="App\Model\Eav\EavAttribute")
     * @JoinColumn(name="attribute_id", referencedColumnName="attribute_id")
     */
	protected $attribute;
	/**
     * @var \App\Model\Shop
     *
     * @OneToOne(targetEntity="App\Model\Shop")
     * @JoinColumn(name="store_id", referencedColumnName="id")
     */
	protected $store;
	/**
     * @var mixed
     *
     * @Column(name="value", type="integer", nullable=false)
     */
	protected $value;
}
