<?php
namespace App\Model\Entities;
use Doctrine\ORM\Mapping as ORM,
	Doctrine\Common\Collections\ArrayCollection;

/**
 * Documents
 *
 * @ORM\Table(name="pages")
 * @ORM\Entity
 */
class PageEntity extends \App\Model\Entity
{
    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

	/**
     * @ORM\OneToMany(targetEntity="PageTitleEntity", mappedBy="page")
     **/
    private $titles;
	
	
	/**
     * @var integer
     *
     * @ORM\Column(type="datetime", nullable=false)
     */
	protected $created;
	/**
     * @var integer
     *
     * @ORM\Column(type="datetime", nullable=false)
     */
	protected $published;
	
	public function __construct() {
        $this->titles = new ArrayCollection();
    }
	
	public function getTitles() {
		return $this->titles;
	}
}
