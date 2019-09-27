<?php

namespace Cubetech\TemplateLogic;

use \Cubetech\Controller\NavigationController;

/**
 * Logic Module for TemplateParts acting as a Navigation
 *
 * @author Alex Scherer <alex.scherer@cubetech.ch>
 * @since 1.1.0
 */
class NavigationLogic extends ABaseLogic
{
    /**
     * A Navigation Object
     *
     * @var \Cubetech\Base\Navigation
     */
    public $navigation;
    
    /**
     * Creates a new NavigationLogic instance with the given $menuItems
     *
     * @param array $menuItems
     *
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @since 1.1.0
     */
    public function __construct(string $navMenuName)
    {
        $this->navigation = NavigationController::getNavigation($navMenuName);
    }
    
    /**
     * Initializes this logic module
     *
     * @param integer $id
     * @return void
     *
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @since 1.1.0
     */
    public function initialize(int $id)
    {
        
    }
}