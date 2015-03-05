<?php
namespace App\Model\Security;
use App\Model\Entity;
/**
 * Description of AclPrivilege
 *
 * @author KuBik
 * @Entity
 * @Table(name="acl_privileges")
 */
class AclPrivilege extends Entity {
	/** @Id @Column(type="string") **/
	protected $name;
}
