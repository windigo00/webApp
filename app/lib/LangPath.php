<?php

namespace App\Model;
use App\Model\Entity;
/**
 * Description of LangPath
 *
 * @author KuBik
 * @Entity
 * @Table(name="lang_path")
 */
class LangPath extends Entity{
	/** 
	 * @Id @Column(type="integer")
	 * @GeneratedValue 
	**/
	protected $id;
	/** @Column(type="string") **/
	protected $model;
	/** @Column(type="integer") **/
	protected $model_id;
	/** @Column(type="string") **/
	protected $language;
	/** @Column(type="string") **/
	protected $value;
	
	public static function getUid($class, $value)
	{
		$arr = array('model'=>$class,'language'=>Translator::getLang(), 'value'=>$value);
		$ret = self::getRepository()->findOneBy($arr);
		if ($ret) {
			$ret = $ret->model_id;
		}
		return $ret;
	}
	public static function getPath($class, $unitId)
	{
		$arr = array('model'=>$class,'model_id'=>$unitId,'language'=>Translator::getLang());
		return self::getRepository()->findOneBy($arr);
	}
}
