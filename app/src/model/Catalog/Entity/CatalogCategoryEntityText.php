<?php

namespace App\Model\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * CatalogCategoryEntityText
 *
 * @ORM\Table(name="catalog_category_entity_text")
 * @ORM\Entity
 */
class CatalogCategoryEntityText extends \App\Model\Entity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="value_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $valueId;

    /**
     * @var integer
     *
     * @ORM\Column(name="store_id", type="smallint", nullable=false)
     */
    protected $storeId;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="text", nullable=true)
     */
    protected $value;

    /**
     * @var \CatalogCategoryEntity
     *
     * @ORM\ManyToOne(targetEntity="CatalogCategoryEntity")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="entity_id", referencedColumnName="entity_id")
     * })
     */
    protected $entity;

    /**
     * @var \EavEntityType
     *
     * @ORM\ManyToOne(targetEntity="EavEntityType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="entity_type_id", referencedColumnName="entity_type_id")
     * })
     */
    protected $entityType;

    /**
     * @var \EavAttribute
     *
     * @ORM\ManyToOne(targetEntity="EavAttribute")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="attribute_id", referencedColumnName="attribute_id")
     * })
     */
    protected $attribute;


}
