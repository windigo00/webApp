<?php
namespace App\Model;
/**
 * Description of BlogPost
 *
 * @author KuBik
 */
class BlogPost  extends \App\Model\Model {
	protected static $entityClass = '\App\Model\Entities\BlogPosts';
	/**
	 * 
	 * @param type $count
	 * @return array
	 */
	public static function loadNew($count) {
		$ret = array();
//		$ret = self::getRepository()->findBy
		return $ret;
	}
}
