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
 * EavEntityType
 *
 * @Table(name="eav_entity_type")
 * @Entity
 */
class EavEntityType extends AbstractModel {
	/**
     * @var integer
     *
     * @Column(name="entity_type_id", type="smallint", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @Column(name="entity_type_code", type="string", length=50, nullable=false)
     */
    protected $code;

    /**
     * @var string
     *
     * @Column(name="entity_model", type="string", length=255, nullable=false)
     */
    protected $entityModel;

    /**
     * @var string
     *
     * @Column(name="attribute_model", type="string", length=255, nullable=true)
     */
    protected $attributeModel;

    /**
     * @var string
     *
     * @Column(name="entity_table", type="string", length=255, nullable=true)
     */
    protected $entityTable;

    /**
     * @var string
     *
     * @Column(name="value_table_prefix", type="string", length=255, nullable=true)
     */
    protected $valueTablePrefix;

    /**
     * @var string
     *
     * @Column(name="entity_id_field", type="string", length=255, nullable=true)
     */
    protected $entityIdField;

    /**
     * @var integer
     *
     * @Column(name="is_data_sharing", type="smallint", nullable=false)
     */
    protected $isDataSharing;

    /**
     * @var string
     *
     * @Column(name="data_sharing_key", type="string", length=100, nullable=true)
     */
    protected $dataSharingKey;

    /**
     * @var integer
     *
     * @Column(name="default_attribute_set_id", type="smallint", nullable=false)
     */
    protected $defaultAttributeSetId;

    /**
     * @var string
     *
     * @Column(name="increment_model", type="string", length=255, nullable=true)
     */
    protected $incrementModel;

    /**
     * @var integer
     *
     * @Column(name="increment_per_store", type="smallint", nullable=false)
     */
    protected $incrementPerStore;

    /**
     * @var integer
     *
     * @Column(name="increment_pad_length", type="smallint", nullable=false)
     */
    protected $incrementPadLength;

    /**
     * @var string
     *
     * @Column(name="increment_pad_char", type="string", length=1, nullable=false)
     */
    protected $incrementPadChar;

    /**
     * @var string
     *
     * @Column(name="additional_attribute_table", type="string", length=255, nullable=true)
     */
    protected $additionalAttributeTable;

    /**
     * @var string
     *
     * @Column(name="entity_attribute_collection", type="string", length=255, nullable=true)
     */
    protected $entityAttributeCollection;
}