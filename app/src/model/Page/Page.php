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
 * Pages
 * @author KuBik
 *
 * @Table(name="cms_page")
 * @Entity
 */
class Page  extends AbstractModel {
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
     * @Column(type="string", nullable=false)
     */
    protected $template;
	/**
	 *
	 * @var PagePath
	 *
	 * @OneToMany(targetEntity="PagePath", mappedBy="page")
	 */
    protected $paths;
	/**
	 *
	 * @var PageTitle
	 *
	 * @OneToMany(targetEntity="PageTitle", mappedBy="page")
	 */
    protected $titles;
	
	public function __construct() {
        $this->paths = new ArrayCollection();
        $this->titles = new ArrayCollection();
    }
}