<?php
namespace App\Model\Entities;
use Doctrine\ORM\Mapping as ORM;

/**
 * EavAttribute
 *
 * @ORM\Table(name="eav_attribute")
 * @ORM\Entity
 */
class EavAttribute extends \App\Model\Entity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="attribute_id", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $attributeId;

    /**
     * @var string
     *
     * @ORM\Column(name="attribute_code", type="string", length=255, nullable=true)
     */
    protected $attributeCode;

    /**
     * @var string
     *
     * @ORM\Column(name="attribute_model", type="string", length=255, nullable=true)
     */
    protected $attributeModel;

    /**
     * @var string
     *
     * @ORM\Column(name="backend_model", type="string", length=255, nullable=true)
     */
    protected $backendModel;

    /**
     * @var string
     *
     * @ORM\Column(name="backend_type", type="string", length=8, nullable=false)
     */
    protected $backendType;

    /**
     * @var string
     *
     * @ORM\Column(name="backend_table", type="string", length=255, nullable=true)
     */
    protected $backendTable;

    /**
     * @var string
     *
     * @ORM\Column(name="frontend_model", type="string", length=255, nullable=true)
     */
    protected $frontendModel;

    /**
     * @var string
     *
     * @ORM\Column(name="frontend_input", type="string", length=50, nullable=true)
     */
    protected $frontendInput;

    /**
     * @var string
     *
     * @ORM\Column(name="frontend_label", type="string", length=255, nullable=true)
     */
    protected $frontendLabel;

    /**
     * @var string
     *
     * @ORM\Column(name="frontend_class", type="string", length=255, nullable=true)
     */
    protected $frontendClass;

    /**
     * @var string
     *
     * @ORM\Column(name="source_model", type="string", length=255, nullable=true)
     */
    protected $sourceModel;

    /**
     * @var integer
     *
     * @ORM\Column(name="is_required", type="smallint", nullable=false)
     */
    protected $isRequired;

    /**
     * @var integer
     *
     * @ORM\Column(name="is_user_defined", type="smallint", nullable=false)
     */
    protected $isUserDefined;

    /**
     * @var string
     *
     * @ORM\Column(name="default_value", type="text", nullable=true)
     */
    protected $defaultValue;

    /**
     * @var integer
     *
     * @ORM\Column(name="is_unique", type="smallint", nullable=false)
     */
    protected $isUnique;

    /**
     * @var string
     *
     * @ORM\Column(name="note", type="string", length=255, nullable=true)
     */
    protected $note;

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
