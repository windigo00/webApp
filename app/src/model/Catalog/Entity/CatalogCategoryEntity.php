<?php
namespace App\Model\Entities;
use Doctrine\ORM\Mapping as ORM;

/**
 * CatalogCategoryEntity
 *
 * @ORM\Table(name="catalog_category_entity")
 * @ORM\Entity
 */
class CatalogCategoryEntity extends \App\Model\Entity
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
     * @var integer
     *
     * @ORM\Column(name="entity_type_id", type="smallint", nullable=false)
     */
    protected $entityTypeId;

    /**
     * @var integer
     *
     * @ORM\Column(name="attribute_set_id", type="smallint", nullable=false)
     */
    protected $attributeSetId;

    /**
     * @var integer
     *
     * @ORM\Column(name="parent_id", type="integer", nullable=false)
     */
    protected $parentId;

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
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=255, nullable=false)
     */
    protected $path;

    /**
     * @var integer
     *
     * @ORM\Column(name="position", type="integer", nullable=false)
     */
    protected $position;

    /**
     * @var integer
     *
     * @ORM\Column(name="level", type="integer", nullable=false)
     */
    protected $level;

    /**
     * @var integer
     *
     * @ORM\Column(name="children_count", type="integer", nullable=false)
     */
    protected $childrenCount;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="CatalogProductEntity", inversedBy="category")
     * @ORM\JoinTable(name="catalog_category_product",
     *   joinColumns={
     *     @ORM\JoinColumn(name="category_id", referencedColumnName="entity_id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="product_id", referencedColumnName="entity_id")
     *   }
     * )
     */
    protected $product;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->product = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
}
