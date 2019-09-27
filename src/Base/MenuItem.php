<?php

namespace Cubetech\Base;

/**
 * Base class for menu items
 *
 * @author Marc Mentha <marc@cubetech.ch>
 * @since 1.0.0
 * @version 1.1.0
 */
class MenuItem extends ACFWrapper implements \Serializable
{
    /**
     * Id of the menu item
     *
     * @var int
     */
    public $id;
    /**
     * Id of the post or page which is represented by the menu item
     *
     * @var int
     */
    public $objectId;
    /**
     * Id of the menu items parent manu item
     * Used to create hierarchical menus
     *
     * @var int
     */
    public $parentId;
    /**
     * Name given in the Backenn menu
     *
     * @var string
     */
    public $title;
    /**
     * Array wich contains classes of menu item
     *
     * @var array
     */
    public $classes;
    /**
     * Url where the menu item points to
     *
     * @var string
     */
    public $url;
    /**
     * True if the menu item has children
     *
     * @var boolean
     */
    public $hasChildren;
    /**
     * Children of this menu item
     *
     * @var array
     */
    public $children;
    
    /**
     * Initalizes all members of thsi class
     *
     * @param WP_Post $menuItem
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @version 1.0.1
     * @since 1.0.0
     */
    public function __construct(\WP_Post $menuItem)
    {
        $this->id = intval($menuItem->ID);
        $this->parentId = intval($menuItem->menu_item_parent);
        $this->objectId = intval($menuItem->object_id);
        $this->title = $menuItem->title;
        $this->url = $menuItem->url;
        $this->hasChildren = false;
        $this->children = [];
        $this->classes = [];
        
        // WordPress menu items comes with an array where the first element is empty by default
        // the classes given from backend
        if ( !empty($menuItem->classes[0])) {
            $this->classes = $menuItem->classes;
        }
    }
    
    /**
     * Returns the menuitems css classes separated by a space
     *
     * @return string
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.1.0
     * @version 1.0.0
     */
    public function getCssClasses()
    {
        return join($this->classes, ' ');
    }
    
    /**
     * Get children recusive for this MenuItem
     *
     * @param array $menuItems
     * @return void
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public function getChilds($menuItems)
    {
        foreach ($menuItems as $menuItem) {
            if ($this->id === $menuItem->parentId) {
                $this->addChild($menuItem);
            }
        }
        if (count($this->children) > 0) {
            $this->hasChildren = true;
        }
        
        if ($this->hasChildren) {
            foreach ($this->children as $item) {
                $item->getChilds($menuItems);
            }
        }
    }
    
    /**
     * Add a classname to the list of classes
     *
     * @param string $className
     * @return void
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @version 1.0.0
     * @since 1.0.0
     */
    public function addClass(string $className)
    {
        $this->classes[] = $className;
    }
    
    /**
     * Add a child menu item
     *
     * @param menuItem $child
     * @return void
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @version 1.0.0
     * @since 1.0.0
     */
    public function addChild(MenuItem $child)
    {
        $this->children[] = $child;
    }
    
    /**
     * Checks if the given key is set and not empty or false
     * Inherited from ACFWrapper
     *
     * @param string $key
     * @return boolean
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @version 1.0.0
     * @since 1.0.0
     */
    public function isFieldValid(string $key)
    {
        return !empty(trim($this->$key));
    }
    
    /**
     * Returns the id of this object
     * Inherited from ACFWrapper
     *
     * @return int
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @version 1.0.0
     * @since 1.0.0
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Serializes the Navigation in preparation forsetting the transient
     *
     * @return void
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.1.0
     * @version 1.0.0
     */
    public function serialize()
    {
        return serialize([
            $this->id,
            $this->objectId,
            $this->parentId,
            $this->title,
            $this->classes,
            $this->url,
            $this->hasChildren,
            $this->children,
        ]);
    }
    
    /**
     * Deserializes the Navigation for usage in PHP
     *
     * @param string $data serialized
     * @return void
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.1.0
     * @version 1.0.0
     */
    public function unserialize($data)
    {
        list($this->id, $this->objectId, $this->parentId, $this->title, $this->classes, $this->url, $this->hasChildren, $this->children,) = unserialize($data);
    }
}
