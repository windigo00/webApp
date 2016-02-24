<?php
namespace App\Model;

use Doctrine\ORM\Mapping\Table,
	Doctrine\ORM\Mapping\Entity,
	Doctrine\ORM\Mapping\Column,
	Doctrine\ORM\Mapping\Id,
	Doctrine\ORM\Mapping\GeneratedValue,
	Doctrine\ORM\Mapping\ManyToOne,
	Doctrine\ORM\Mapping\JoinColumn
		;
/**
 * Documents
 *
 * @Table(name="cms_document_version")
 * @Entity
 */
class DocumentVersion extends AbstractModel {
	/**
     * @var integer
     *
     * @Column(type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

	/**
     * @ManyToOne(targetEntity="Document", inversedBy="version")
	 * @JoinColumn(name="document_id", referencedColumnName="id")
     **/
	protected $document;
	
	
	/**
     * @var string
     *
     * @Column(type="string", nullable=false)
     */
	protected $language;
	/**
     * @var text
     *
     * @Column(type="text", nullable=false)
     */
	protected $content;
	
	/**
     * @var string
     *
     * @Column(type="text", nullable=false)
     */
	protected $title;
	
}
