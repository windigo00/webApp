<?php
namespace App\Model\Eav;
/**
 * Description of EavAttributeSet
 *
 * @author KuBik
 */
class EavAttributeSet extends \App\Model\Model {
	protected static $entityClass = '\App\Model\Entities\EavAttributeSet';
	
	public static function getAttributesFor($class, $id) {
		$qb = \App\Management\EntityManager::get()->createQueryBuilder();
		$qb->select('as.value')
			->from(EavAttributeSet::getEntityClass(), 'as')
//			->leftJoin(EavAttribute::getEntityClass(), 'at', 'WITH', 'at.entityType = av.entityType')
//			->leftJoin(EavAttributeValue::getEntityClass(), 'av')
//			->leftJoin($class, 'p')
//			->where('p.entityId = ?1')
			;
		dump($qb->getQuery()->getResult());
	}
}
