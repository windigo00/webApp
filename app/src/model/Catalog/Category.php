<?php
namespace App\Model\Catalog;

use App\Model\Eav\EavAttributeSet,
	App\Model\AbstractModel,
	Doctrine\ORM\Mapping\Table,
	Doctrine\ORM\Mapping\Entity,
	Doctrine\ORM\Mapping\Column,
	Doctrine\ORM\Mapping\Id,
	Doctrine\ORM\Mapping\GeneratedValue,
	Doctrine\ORM\Mapping\OneToOne,
	Doctrine\ORM\Mapping\OneToMany,
	Doctrine\ORM\Mapping\JoinColumn,
	Doctrine\Common\Collections\ArrayCollection
		;

/**
 * CatalogCategoryEntity
 *
 * @Table(name="catalog_category_entity")
 * @Entity
 */
class Category extends AbstractModel {
	/**
     * @var integer
     *
     * @Column(name="entity_id", type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var integer
     *
	 * @OneToOne(targetEntity="\App\Model\Eav\EavEntityType")
     * @JoinColumn(name="entity_type_id", referencedColumnName="entity_type_id")
     */
    protected $entityType;

    /**
     * @var integer
     *
	 * @ OneToOne(targetEntity="CatalogCategoryAttributeSet")
     * @ JoinColumn(name="attribute_set_id", referencedColumnName="id")
     */
//    protected $attributeSet;

    /**
     * @var integer
     *
	 * @OneToOne(targetEntity="Category")
     * @JoinColumn(name="parent_id", referencedColumnName="entity_id")
     */
    protected $parent;
	/**
     * @var <Category>
     *
	 * @OneToMany(targetEntity="Category", mappedBy="parent")
     */
    protected $children;

    /**
     * @var \DateTime
     *
     * @Column(name="created_at", type="datetime", nullable=true)
     */
    protected $createdAt;

    /**
     * @var \DateTime
     *
     * @Column(name="updated_at", type="datetime", nullable=true)
     */
    protected $updatedAt;

    /**
     * @var string
     *
     * @ Column(name="path", type="string", length=255, nullable=false)
     */
//    protected $path;

    /**
     * @var integer
     *
     * @Column(name="position", type="integer", nullable=false)
     */
    protected $position;

    /**
     * @var integer
     *
     * @Column(name="level", type="integer", nullable=false)
     */
    protected $level;


    /**
     * @var Page
     *
     * @OneToOne(targetEntity="App\Model\Page")
     * @JoinColumn(name="page_id", referencedColumnName="id")
     */
    protected $page;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->children = new ArrayCollection();
    }
	
//	public function __get($name) {
//		try {
//			$ret = parent::__get($name);
//		} catch (\Exception $ex) {
//			$ret = $this->getAttribute($name);
//		}
//		
//	}
	
//	public function hasChildren() {
//		return $this->childrenCount > 0;
//	}
//	protected $children;
//	public function getChildren() {
//		if ($this->children === NULL) {
//			$id = $this->entity->entityId;
//			$this->children = self::findBy(array('parentId'=>($id ? $id :0)));
//		}
//		return $this->children;
//	}
//	
//	protected $attributes;
//	public function getAttribute($name) {
//		if (isset($this->attributes[$name])) {
//			return $this->attributes[$name];
//		} else {
//			// $this->loadAttributes();
//			if (isset($this->attributes[$name])) {
//				return $this->attributes[$name];
//			}
//		}
//		return NULL;
//	}
//	
//	protected function loadAttributes() {
//		$this->attributes = EavAttributeSet::getAttributesFor(
//			get_called_class(), 
//			$this->entity->attributeSetId
//		);
//	}
}
