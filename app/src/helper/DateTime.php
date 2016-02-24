<?php
namespace App\Helper;
/**
 * Helping with DateTime
 *
 * @author KuBik
 */
class DateTime {
	
	const FORM_DATETIME_FORMAT = "m/d/Y";
	
	/**
	 * 
	 * @param string $separator
	 * @param string $input
	 * @return \DateTime Description
	 */
	public static function fromString($input) {
		if (empty($input)) return NULL;
		$date = explode('/', $input);
		$d = new \DateTime();
		$d->setDate($date[2], $date[0], $date[1]);
		return $d;
	}
}
