<?php
namespace App\Model\Eav;

use App\Management\EntityManager,
	App\Model\AbstractModel,
	App\Model\Eav,
	App\Model\Entities,
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
 * EavAttributeSet
 *
 * @Table(name="eav_attribute_set")
 * @Entity
 */
class EavAttributeSet extends AbstractModel {
	/**
     * @var integer
     *
     * @Column(name="attribute_set_id", type="smallint", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    protected $attributeSetId;

    /**
     * @var string
     *
     * @Column(name="attribute_set_name", type="string", length=255, nullable=true)
     */
    protected $attributeSetName;

    /**
     * @var integer
     *
     * @Column(name="sort_order", type="smallint", nullable=false)
     */
    protected $sortOrder;

    /**
     * @var \EavEntityType
     *
     * @ManyToOne(targetEntity="EavEntityType")
     * @JoinColumns({
     *   @JoinColumn(name="entity_type_id", referencedColumnName="entity_type_id")
     * })
     */
    protected $entityType;
	
	protected $attribute;


	public static function getAttributesFor($class, $id) {
		$qb = EntityManager::get()->createQueryBuilder();
		$qb->select('atts.value')
			->from(Eav\EavAttributeSet::getEntityClass(), 'atts')
			// ->leftJoin(Eav\EavAttribute::getEntityClass(), 'att', 'WITH', 'att.entityType = atv.entityType')
			// ->leftJoin(Eav\EavAttributeValue::getEntityClass(), 'atv')
			->leftJoin($class, 'p')
			->where('p.entityId = ?1')
			;
		$qb->setParameter(1, $id);
		dump($qb->getQuery()->getSql());
	}
}
