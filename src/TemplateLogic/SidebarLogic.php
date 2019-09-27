<?php

namespace Cubetech\TemplateLogic;

use Cubetech\Base\CubetechPost;

/**
 * Logic Module for TemplateParts acting as a Sidebar
 *
 * @author Alex Scherer <alex.scherer@cubetech.ch>
 * @since 1.1.0
 */
class SidebarLogic extends ABaseLogic
{
    /**
     * The ID of the contact person displayed in the sidebar
     *
     * @var int
     */
    protected $contactPerson;
    
    /**
     * The Contact card to display in the sidebar
     *
     * @var TeamCard
     */
    protected $contactCard;
    
    /**
     * An array of menu items to display in the sidebar
     *
     * @var array
     */
    protected $menuItems;
    
    /**
     * Creates a new instance of the SidebarLogic using the given $menuItems
     *
     * @param array $menuItems
     *
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @since 1.1.0
     */
    public function __construct($menuItems)
    {
        $this->menuItems = $menuItems;
    }
    
    /**
     * Initializes this SidebarLogic with post-specific data
     *
     * @param integer $id
     * @return void
     *
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @since 1.1.0
     */
    public function initialize(int $id)
    {
        add_action('ct-sidebar', [$this, 'printSidebarBodyClass']);
        if ($id) {
            $post = new CubetechPost($id);
            $this->secondLevelItem = $this->getSecondLevelMenuItem($this->menuItems, $post->getLink());
        }
        
        if ($post && $post->isFieldValid('contact_person')) {
            $this->contactPerson = $post->getField('contact_person');
            $this->contactCard = new TeamCard($this->contactPerson);
        }
    }
    
    /**
     * Echoes a body class for a page with a sidebar
     *
     * @return void
     *
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @since 1.0.0
     */
    public function printSidebarBodyClass()
    {
        echo ' ct-template-with-sidebar';
    }
    
    /**
     * Gets the secend level menuItem for a specific url
     *
     * @param array $menuItems
     * @param string $currentUrl
     * @return array
     *
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @since 1.0.0
     */
    private function getSecondLevelMenuItem($menuItems, $currentUrl)
    {
        $secondLevelMenuItem = false;
        if (count($menuItems) < 1) {
            return;
        }
        foreach ($menuItems as $menuItem) {
            
            if ($menuItem->url === $currentUrl) {
                return $menuItem;
            }
            
            if ($menuItem->hasChildren) {
                $secondLevelMenuItem = $this->getSecondLevelMenuItem($menuItem->children, $currentUrl);
                if ($secondLevelMenuItem) {
                    return $menuItem;
                }
            }
        }
        
        return $secondLevelMenuItem;
    }
}