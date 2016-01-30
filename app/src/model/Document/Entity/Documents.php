<?php
namespace App\Model\Entities;
use Doctrine\ORM\Mapping as ORM;

/**
 * Documents
 *
 * @ORM\Table(name="cms_documents")
 * @ORM\Entity
 */
class Documents extends \App\Model\Entity
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
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    protected $uid;

	
	/**
     * @var string
     *
     * @ORM\Column(type="string", length=1024, nullable=false)
     */
    protected $path;
	/**
     * @var string
     *
     * @ORM\Column(type="string", length=1024, nullable=false)
     */
    protected $title;
	/**
     * @var string
     *
     * @ORM\Column(type="string", length=1024, nullable=false)
     */
    protected $author;
	/**
     * @var string
     *
     * @ORM\Column(type="string", length=10, nullable=false)
     */
    protected $language;
	/**
     * @var string
     *
     * @ORM\Column(type="string", length=1024, nullable=false)
     */
	protected $module;
	
	/**
     * @var string
     *
     * @ORM\Column(type="string", length=1024, nullable=false)
     */
	protected $content;
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
}
