<?php

namespace App\Model\Catalog;

use App\Model\LangPath,
	App\Model\AbstractModel,
	Doctrine\ORM\Mapping\Table,
	Doctrine\ORM\Mapping\Entity,
	Doctrine\ORM\Mapping\Column,
	Doctrine\ORM\Mapping\Id,
	Doctrine\ORM\Mapping\GeneratedValue,
	Doctrine\ORM\Mapping\OneToOne,
	Doctrine\ORM\Mapping\OneToMany,
	Doctrine\ORM\Mapping\JoinColumn,
	Doctrine\Common\Collections\ArrayCollection
		;
/**
 * CatalogProduct
 *
 * @Table(name="catalog_product_entity")
 * @Entity
 */
class Product extends AbstractModel {
	
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
     * @Column(name="type_id", type="string", length=32, nullable=false)
     */
    protected $typeId;

    /**
     * @var string
     *
     * @Column(name="sku", type="string", length=64, nullable=true)
     */
    protected $sku;

    /**
     * @var integer
     *
     * @Column(name="has_options", type="smallint", nullable=false)
     */
    protected $hasOptions;
	/**
     * @var boolean
     *
     * @Column(name="active", type="boolean", nullable=false)
     */
    protected $active;

    /**
     * @var integer
     *
     * @Column(name="required_options", type="smallint", nullable=false)
     */
    protected $requiredOptions;

    /**
     * @var \DateTime
     *
     * @Column(name="created_at", type="datetime", nullable=true)
     */
    protected $createdAt;

    /**
     * @var \DateTime
     *
     * @Column(name="updated_at", type="datetime", nullable=true)
     */
    protected $updatedAt;

    /**
     * @var \Doctrine\Common\Collections\Collection
     * 
     * @OneToMany(targetEntity="\App\Model\Catalog\Category", mappedBy="product")
     */
    protected $category;

    /**
     * @var \App\Model\Eav\EavAttributeSet
     *
     * @OneToOne(targetEntity="\App\Model\Eav\EavAttributeSet")
     * @JoinColumn(name="attribute_set_id", referencedColumnName="attribute_set_id")
     */
    protected $attributeSet;

    /**
     * @var ProductAttributeCollection
     */
    protected $attributes;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->category = new ArrayCollection;
        $this->attributes = new ProductAttributeCollection($this);
    }
	
	/**
	 * Returns product attributes
	 * @return ProductAttributeCollection
	 */
	public function getAttributes() {
		return $this->attributes;
	}
	
	
}
