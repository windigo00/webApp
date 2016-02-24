<?php
namespace App\Model;
use Doctrine\ORM\Mapping\Table,
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
 * MenuItem
 *
 * @Table(name="cms_menu_item")
 * @Entity
 */
class MenuItem extends AbstractModel {
	
	/**
     * @var integer
     *
     * @Column(name="id", type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    protected $id;
	/**
	 *
	 * @var Menu
	 * 
     * @OneToOne(targetEntity="Menu")
     * @JoinColumn(name="menu_id", referencedColumnName="id")
	 */
	protected $menu;
	/**
	 * @var MenuItem Parent Item
	 * 
     * @OneToOne(targetEntity="MenuItem")
     * @JoinColumn(name="parent_id", referencedColumnName="id")
     **/
	protected $parent;

	/**
     * @var boolean
     *
     * @Column(type="boolean", nullable=false)
     */
    protected $active;
	/**
     * @var string
     *
     * @Column(type="string", length=255, nullable=false)
     */
    protected $text;
	/**
     * @var string
     *
     * @Column(type="string", length=1024, nullable=false)
     */
    protected $path;
	/**
     * @OneToMany(targetEntity="MenuItem", mappedBy="parent")
     */
	protected $children;
	protected $activeChildren;
	
	public function __construct() {
		$this->children = new ArrayCollection;
	}
	
	/**
	 * 
	 * @return MenuItem
	 */
	public function getRoot() {
		$tmp = $this;
		while ($tmp->parent != NULL) {
			$tmp = $tmp->parent;
		}
		return $tmp;
	}
	
	public function hasChildren() {
		return count($this->children) > 0;
	}
	
	public function hasActiveChildren(){
		return $this->getActiveChildren()->count() > 0;
	}
	
	public function getActiveChildren() {
		if (is_null($this->activeChildren)) {
			$this->activeChildren = $this->children->filter(function(MenuItem $entry){ return $entry->active; });
		}
		return $this->activeChildren;
	}
	
	/**
	 * @return array<MenuItem>
	 */
//	public function getChildren($recursive = FALSE) {
//		if ($this->children === NULL) {
//			$res = MenuItem::findBy(array('menu'=> $this->menu->id, 'parent' => $this->id));
//			$this->children = array();
//			foreach ($res as $child) {
//				$this->children[] = $child;
//				if ($recursive) {
//					$child->getChildren();
//				}
//			}
//		}
//		return $this->children;
//	}
	
}
