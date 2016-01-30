<?php
namespace App\Model\Entities;
use Doctrine\ORM\Mapping as ORM;

/**
 * EavAttributeSet
 *
 * @ORM\Table(name="eav_attribute_set")
 * @ORM\Entity
 */
class EavAttributeSet extends \App\Model\Entity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="attribute_set_id", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $attributeSetId;

    /**
     * @var string
     *
     * @ORM\Column(name="attribute_set_name", type="string", length=255, nullable=true)
     */
    protected $attributeSetName;

    /**
     * @var integer
     *
     * @ORM\Column(name="sort_order", type="smallint", nullable=false)
     */
    protected $sortOrder;

    /**
     * @var \EavEntityType
     *
     * @ORM\ManyToOne(targetEntity="EavEntityType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="entity_type_id", referencedColumnName="entity_type_id")
     * })
     */
    protected $entityType;


}
