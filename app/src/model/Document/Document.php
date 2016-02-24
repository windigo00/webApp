<?php
namespace App\Model;

use Doctrine\ORM\Mapping\Table,
	Doctrine\ORM\Mapping\Entity,
	Doctrine\ORM\Mapping\Column,
	Doctrine\ORM\Mapping\Id,
	Doctrine\ORM\Mapping\GeneratedValue,
	Doctrine\ORM\Mapping\OneToMany,
	Doctrine\Common\Collections\ArrayCollection
		;
/**
 * Documents
 *
 * @Table(name="cms_document")
 * @Entity
 */
class Document extends AbstractModel {
	/**
     * @var integer
     *
     * @Column(type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

	/**
	 * @OneToMany(targetEntity="DocumentVersion", mappedBy="document")
	 */
	protected $version;

	/**
     * @var integer
     *
     * @Column(type="datetime", nullable=false)
     */
	protected $created;
	/**
     * @var integer
     *
     * @Column(type="datetime", nullable=false)
     */
	protected $published;
	
	public function __construct() {
        $this->title = new ArrayCollection();
        $this->version = new ArrayCollection();
    }
	
	
}
