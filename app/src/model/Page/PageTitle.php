<?php
namespace App\Model;

use Doctrine\ORM\Mapping\Table,
	Doctrine\ORM\Mapping\Entity,
	Doctrine\ORM\Mapping\Column,
	Doctrine\ORM\Mapping\Id,
	Doctrine\ORM\Mapping\GeneratedValue,
	Doctrine\ORM\Mapping\ManyToOne,
	Doctrine\ORM\Mapping\JoinColumn,
	Doctrine\ORM\Mapping\JoinColumns
		;
/**
 * Page language dependent paths
 *
 * @Table(name="cms_page_title")
 * @Entity
 */
class PageTitle extends AbstractModel {
	/**
     * @var integer
     *
     * @Column(type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

	/**
     * @var \PageEntity
     *
     * @ManyToOne(targetEntity="Page")
     * @JoinColumns({
     *   @JoinColumn(name="page_id", referencedColumnName="id")
     * })
     */
	protected $page;
	
	/**
     * @var string
     *
     * @Column(name="language", type="string", length=8, nullable=false)
     */
	protected $language;
	/**
     * @var string
     *
     * @Column(name="value", type="text", nullable=false)
     */
	protected $value;
}
