<?php

namespace App\Model\Eav;

use App\Model\AbstractModel,
    Doctrine\ORM\Mapping\Table,
	Doctrine\ORM\Mapping\Entity,
	Doctrine\ORM\Mapping\Column,
	Doctrine\ORM\Mapping\Id,
	Doctrine\ORM\Mapping\GeneratedValue,
	Doctrine\ORM\Mapping\ManyToOne,
	Doctrine\ORM\Mapping\JoinColumn,
	Doctrine\ORM\Mapping\JoinColumns
		;
/**
 * EavAttribute
 *
 * @Table(name="eav_attribute")
 * @Entity
 */
class EavAttribute extends AbstractModel {
	/**
     * @var integer
     *
     * @Column(name="attribute_id", type="smallint", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    protected $attributeId;

    /**
     * @var string
     *
     * @Column(name="attribute_code", type="string", length=255, nullable=true)
     */
    protected $attributeCode;

    /**
     * @var string
     *
     * @Column(name="attribute_model", type="string", length=255, nullable=true)
     */
    protected $attributeModel;

    /**
     * @var string
     *
     * @Column(name="backend_model", type="string", length=255, nullable=true)
     */
    protected $backendModel;

    /**
     * @var string
     *
     * @Column(name="backend_type", type="string", length=8, nullable=false)
     */
    protected $backendType;

    /**
     * @var string
     *
     * @Column(name="backend_table", type="string", length=255, nullable=true)
     */
    protected $backendTable;

    /**
     * @var string
     *
     * @Column(name="frontend_model", type="string", length=255, nullable=true)
     */
    protected $frontendModel;

    /**
     * @var string
     *
     * @Column(name="frontend_input", type="string", length=50, nullable=true)
     */
    protected $frontendInput;

    /**
     * @var string
     *
     * @Column(name="frontend_label", type="string", length=255, nullable=true)
     */
    protected $frontendLabel;

    /**
     * @var string
     *
     * @Column(name="frontend_class", type="string", length=255, nullable=true)
     */
    protected $frontendClass;

    /**
     * @var string
     *
     * @Column(name="source_model", type="string", length=255, nullable=true)
     */
    protected $sourceModel;

    /**
     * @var integer
     *
     * @Column(name="is_required", type="smallint", nullable=false)
     */
    protected $isRequired;

    /**
     * @var integer
     *
     * @Column(name="is_user_defined", type="smallint", nullable=false)
     */
    protected $isUserDefined;

    /**
     * @var string
     *
     * @Column(name="default_value", type="text", nullable=true)
     */
    protected $defaultValue;

    /**
     * @var integer
     *
     * @Column(name="is_unique", type="smallint", nullable=false)
     */
    protected $isUnique;

    /**
     * @var string
     *
     * @Column(name="note", type="string", length=255, nullable=true)
     */
    protected $note;

    /**
     * @var \EavEntityType
     *
     * @ManyToOne(targetEntity="EavEntityType")
     * @JoinColumns({
     *   @JoinColumn(name="entity_type_id", referencedColumnName="entity_type_id")
     * })
     */
    protected $entityType;
}
