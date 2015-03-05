<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model;

use Nette
		;
/**
 * @Entity 
 */
abstract class BaseObject {
	/** @Id @Column(type="integer") @GeneratedValue **/
	protected $id;

}
