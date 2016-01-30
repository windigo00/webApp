<?php
namespace App\Model\Entities;
use Doctrine\ORM\Mapping as ORM;

/**
 * CatalogProductEntity
 *
 * @ORM\Table(name="catalog_product_entity")
 * @ORM\Entity
 */
class CatalogProductEntity extends \App\Model\Entity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="entity_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $entityId;

    /**
     * @var string
     *
     * @ORM\Column(name="type_id", type="string", length=32, nullable=false)
     */
    protected $typeId;

    /**
     * @var string
     *
     * @ORM\Column(name="sku", type="string", length=64, nullable=true)
     */
    protected $sku;

    /**
     * @var integer
     *
     * @ORM\Column(name="has_options", type="smallint", nullable=false)
     */
    protected $hasOptions;

    /**
     * @var integer
     *
     * @ORM\Column(name="required_options", type="smallint", nullable=false)
     */
    protected $requiredOptions;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    protected $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    protected $updatedAt;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="CatalogCategoryEntity", mappedBy="product")
     */
    protected $category;

    /**
     * @var \EavAttributeSet
     *
     * @ORM\ManyToOne(targetEntity="EavAttributeSet")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="attribute_set_id", referencedColumnName="attribute_set_id")
     * })
     */
    protected $attributeSet;

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
     * Constructor
     */
    public function __construct()
    {
        $this->category = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
}
