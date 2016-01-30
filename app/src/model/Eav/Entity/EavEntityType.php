<?php
namespace App\Model\Entities;
use Doctrine\ORM\Mapping as ORM;

/**
 * EavEntityType
 *
 * @ORM\Table(name="eav_entity_type")
 * @ORM\Entity
 */
class EavEntityType extends \App\Model\Entity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="entity_type_id", type="smallint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $entityTypeId;

    /**
     * @var string
     *
     * @ORM\Column(name="entity_type_code", type="string", length=50, nullable=false)
     */
    protected $entityTypeCode;

    /**
     * @var string
     *
     * @ORM\Column(name="entity_model", type="string", length=255, nullable=false)
     */
    protected $entityModel;

    /**
     * @var string
     *
     * @ORM\Column(name="attribute_model", type="string", length=255, nullable=true)
     */
    protected $attributeModel;

    /**
     * @var string
     *
     * @ORM\Column(name="entity_table", type="string", length=255, nullable=true)
     */
    protected $entityTable;

    /**
     * @var string
     *
     * @ORM\Column(name="value_table_prefix", type="string", length=255, nullable=true)
     */
    protected $valueTablePrefix;

    /**
     * @var string
     *
     * @ORM\Column(name="entity_id_field", type="string", length=255, nullable=true)
     */
    protected $entityIdField;

    /**
     * @var integer
     *
     * @ORM\Column(name="is_data_sharing", type="smallint", nullable=false)
     */
    protected $isDataSharing;

    /**
     * @var string
     *
     * @ORM\Column(name="data_sharing_key", type="string", length=100, nullable=true)
     */
    protected $dataSharingKey;

    /**
     * @var integer
     *
     * @ORM\Column(name="default_attribute_set_id", type="smallint", nullable=false)
     */
    protected $defaultAttributeSetId;

    /**
     * @var string
     *
     * @ORM\Column(name="increment_model", type="string", length=255, nullable=true)
     */
    protected $incrementModel;

    /**
     * @var integer
     *
     * @ORM\Column(name="increment_per_store", type="smallint", nullable=false)
     */
    protected $incrementPerStore;

    /**
     * @var integer
     *
     * @ORM\Column(name="increment_pad_length", type="smallint", nullable=false)
     */
    protected $incrementPadLength;

    /**
     * @var string
     *
     * @ORM\Column(name="increment_pad_char", type="string", length=1, nullable=false)
     */
    protected $incrementPadChar;

    /**
     * @var string
     *
     * @ORM\Column(name="additional_attribute_table", type="string", length=255, nullable=true)
     */
    protected $additionalAttributeTable;

    /**
     * @var string
     *
     * @ORM\Column(name="entity_attribute_collection", type="string", length=255, nullable=true)
     */
    protected $entityAttributeCollection;


}
