<?php
namespace App\Model\Entities;
use Doctrine\ORM\Mapping as ORM;

/**
 * SystemEvent
 *
 * @ORM\Table(name="system_events")
 * @ORM\Entity
 */
class SystemEvent extends \App\Model\Entity {
	/**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=1024, nullable=false)
     */
	protected $message;
	/**
     * @var integer
     *
     * @ORM\Column(type="datetime", nullable=false)
     */
	protected $created;
}
