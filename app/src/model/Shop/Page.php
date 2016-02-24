<?php
namespace App\Model;

use Doctrine\ORM\Mapping\Table,
	Doctrine\ORM\Mapping\Entity,
	Doctrine\ORM\Mapping\Column,
	Doctrine\ORM\Mapping\Id,
	Doctrine\ORM\Mapping\GeneratedValue,
	Doctrine\Common\Collections\ArrayCollection
		;
/**
 * Documents
 *
 * @Table(name="shops")
 * @Entity
 */
class Shop extends AbstractModel {
	/**
     * @var integer
     *
     * @Column(type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

	/**
	 * @Column(type="string", nullable=false)
	 */
	protected $label;

	/**
     * @var integer
     *
     * @Column(type="datetime", nullable=false)
     */
	protected $created;
	
	
	
}
