<?php
namespace App\Model\Entities;
use Doctrine\ORM\Mapping as ORM;

/**
 * Page language dependent paths
 *
 * @ORM\Table(name="lang_path")
 * @ORM\Entity
 */
class PagePathEntity extends \App\Model\Entity {
	/**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

	/**
     * @var \PageEntity
     *
     * @ORM\ManyToOne(targetEntity="PageEntity")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="page_id", referencedColumnName="id")
     * })
     */
	protected $page;
	/**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=false)
     */
	protected $page_id;


	/**
     * @var string
     *
     * @ORM\Column(name="language", type="string", length=8, nullable=false)
     */
	protected $language;
	/**
     * @var string
     *
     * @ORM\Column(name="value", type="text", nullable=false)
     */
	protected $value;
}
