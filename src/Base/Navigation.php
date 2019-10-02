<?php

namespace Cubetech\Base;

use \Cubetech\Base\Media;

/**
 * Represents a Navigation
 *
 * MenuItems starts with the parennavigation items.
 * If you like to include chlidren MenuItems you can
 * get them with $menuItem->chodren or ask if the current item
 * has children with $menItem->hasChildren() method
 *
 * @author Marc Mentha <marc@cubetech.ch>
 * @since 1.1.0
 * @version 1.0.1
 */
class Navigation implements \Serializable
{
    /**
     * Items thenavigation constists of
     *
     * @var array <MenuItem>
     */
    public $menuItems;
    
    /**
     * Constructor for this class
     *
     * Depending on what type the $parameter have
     * the MenuItems getting extracted
     *
     * @param string $navMenuName
     * @return void
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.1.0
     * @version 1.0.0
     */
    public function __construct($navMenuName)
    {
        if (is_numeric($navMenuName)) {
            $items = wp_get_nav_menu_items($navMenuName);
        }
        else {
            $items = $this->extractMenuItems($navMenuName);
        }
        
        if ($items) {
            $this->menuItems = $this->sortMenuItemsHierachical($items);
            $this->addActiveClasses();
        }
        else {
            $this->menuItems = false;
        }
    }
    
    /**
     * Extracts the menu items from the navigation
     *
     * @param string $navMenuName
     * @return void
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     * @see https://wordpress.stackexchange.com/questions/143376/how-to-get-main-menu-only-with-wp-nav-menu
     */
    private function extractMenuItems(string $navMenuName)
    {
        $locations = get_nav_menu_locations();
        if ( !isset($locations[$navMenuName])) {
            return;
        }
        
        $menu = wp_get_nav_menu_object($locations[$navMenuName]);
        
        if ( !isset($menu->term_id)) {
            return;
        }
        return wp_get_nav_menu_items($menu->term_id);
    }
    
    /**
     * Sorts the naviagton into a nested form and adds active classes
     *
     * @return array
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    private function sortMenuItemsHierachical(array $menuItems)
    {
        $menuItems = $this->initializeMenuItems($menuItems);
        if (count($menuItems) < 1) {
            return;
        }
        
        $parents = $this->getParents($menuItems);

        foreach ($parents as $parent) {
            $parent->getChilds($menuItems);
        }
        return $parents;
    }
    
    /**
     * Add active classes to menuItems
     *
     * @param array $items
     * @return bool
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    private function addActiveClasses()
    {

        $id = intval(get_queried_object_id());

        foreach ($this->menuItems as &$item) {
            if ($item->objectId === $id) {
                $item->addClass('uk-active');
                $item->addClass('active');
            }
            
            if ($item->hasChildren) {
                $found = $this->addClasses($item->children);
                if ($found) {
                    $item->addClass('uk-parent');
                    $item->addClass('uk-active');
                    $item->addClass('active-parent');
                }
            }
        }
    }


    /**
     * prints a navigation recursivley with the
     * abillity to set a max depth
     *
     * @param integer $maxDepth
     * @return void
     * 
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.1.0
     * @version 1.0.0
     */
    public function printRecursiveNavigation(int $maxDepth)
    {
        $this->addActiveClasses();

        if (wp_is_mobile() === false) {
            echo '<nav class="uk-navbar-container tz-navbar" data-uk-navbar>';
            echo '<div class="uk-navbar">';
            $this->printItems($this->menuItems, $maxDepth, 1);
            echo '</div>';
            echo '</nav>';
        } else {
            echo '<nav class="uk-navbar-container tz-navbar-mobile" data-uk-navbar>';
            echo '<div class="uk-navbar">';
            $this->printItems($this->menuItems, $maxDepth, 1);
            echo '</div>';
            echo '<div class="tz-burger"><span></span><span></span><span></span></div>';
            echo '</nav>';
        }
    }

    /**
     * Add css classes to style the fifferent items
     *
     * @param array <MenuItems>
     * @return void
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.1.0
     * @version 1.0.0
     */
    public function addClasses(&$menuItems)
    {

        $id = intval(get_queried_object_id());
        foreach ($this->menuItems as &$item) {
            //crashpoint of multi level nav
            //var_dump($item->objectId, $id, '--');
            //die();
            if ($item->objectId === $id) {
                $item->addClass('uk-active');
                $item->addClass('active');
            }
            
            if ($item->hasChildren) {
                $found = $this->addClasses($item->children);
                if ($found) {
                    $item->addClass('uk-parent');
                    $item->addClass('uk-active');
                    $item->addClass('active-parent');
                }
            }
        }
    }
    
    /**


     * Print all given items
     *
     * If one of the items has children this method
     * will call himself
     *
     * @param array $items
     * @return void
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.1.0
     * @version 1.0.1
     */
    private function printItems(array $items, int $maxDepth, int $currentLevel)
    {
        if ($currentLevel > $maxDepth) {
            return;
        }

        if ($currentLevel === 1) {
            $this->printLogo();
        }
        echo '<ul class="uk-navbar-nav">';
        foreach ($items as $item) {
            echo '<li class="ct-menu-item tz-nav-item">';

            echo '<a class="ct-menu-link ' . $item->getCssClasses() . '" href="' . $item->url . '">' . $item->title . '</a>';
            if ($item->hasChildren) {
                $this->printItems($item->children, $maxDepth, $currentLevel + 1);
            }
            echo '</li>';
        }
        echo '</ul>';
    }
    
    private function printLogo()
    {
        $id = Options::getThemeOption('logo');
        $image = $id ? new Media(intval($id)) : false;
        if ( !$image) {
            return;
        }
        echo '<a class="uk-navbar-item uk-logo" href="' . get_home_url() . '">
            <figure class="ct-logo-wrap">
                <img class="ct-logo" src="' . $image->getImageUrl('logo') . '" alt="' . $image->alt . '">
            </figure>
        </a>';
    }
    
    /**
     * Creates Cubetech\Base\MenuItems form WordPress menu items
     *
     * @param array $menuItems
     * @return array
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    private function initializeMenuItems(array $menuItems)
    {
        $menuItemObjects = [];
        foreach ($menuItems as $menuItem) {
            $menuItemObjects[] = new MenuItem($menuItem);
        }
        return $menuItemObjects;
    }
    
    /**
     * Extract the first level navigation items
     *
     * @param array $menuItems
     * @return array
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    private function getParents(array $menuItems)
    {
        $parents = [];
        foreach ($menuItems as $menuItem) {
            if ($menuItem->parentId === 0) {
                $parents[] = $menuItem;
            }
        }
        return $parents;
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
        return serialize([$this->menuItems]);
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
        list($this->menuItems) = unserialize($data);
    }
}
