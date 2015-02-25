<?php

namespace App\Model\Security;

use App\Model\Entity;
/**
 * Description of AclResource
 *
 * @author KuBik
 * @Entity
 * @Table(name="acl_resources")
 */
class AclResource extends Entity {
	/** @Id @Column(type="string") **/
	protected $name;
}
