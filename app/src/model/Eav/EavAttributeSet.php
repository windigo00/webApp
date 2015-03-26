<?php
namespace App\Model\Eav;

use App\Management\EntityManager,
	App\Model\Model,
	App\Model\Eav,
	App\Model\Entities
	;
/**
 * Description of EavAttributeSet
 *
 * @author KuBik
 */
class EavAttributeSet extends Model {
	protected static $entityClass = '\App\Model\Entities\EavAttributeSet';
	
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
