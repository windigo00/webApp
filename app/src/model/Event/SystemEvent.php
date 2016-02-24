<?php
namespace App\Model;

use Doctrine\ORM\Mapping\Table,
	Doctrine\ORM\Mapping\Entity,
	Doctrine\ORM\Mapping\Column,
	Doctrine\ORM\Mapping\Id,
	Doctrine\ORM\Mapping\GeneratedValue
		;
/**
 * SystemEvent
 *
 * @Table(name="system_events")
 * @Entity
 */
class SystemEvent extends  AbstractModel
{
	/**
     * @var integer
     *
     * @Column(type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @Column(type="string", length=1024, nullable=false)
     */
	protected $message;
	/**
     * @var integer
     *
     * @Column(type="datetime", nullable=false)
     */
	protected $created;
}
