<?php
namespace App\Model\Entities;
use Doctrine\ORM\Mapping as ORM;

/**
 * LangPath
 *
 * @ORM\Table(name="lang_path")
 * @ORM\Entity
 */
class LangPath extends \App\Model\Entity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="model", type="string", length=255, nullable=false)
     */
    protected $model;

    /**
     * @var integer
     *
     * @ORM\Column(name="model_id", type="integer", nullable=false)
     */
    protected $modelId;

    /**
     * @var string
     *
     * @ORM\Column(name="language", type="string", length=8, nullable=false)
     */
    protected $language;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=1024, nullable=false)
     */
    protected $value;


}
