<?php

namespace Cubetech\TemplateLogic;

use \Cubetech\Controller\SidebarController;
use Cubetech\Base\Options;

/**
 * Logic Module for TemplateParts acting as a Footer
 *
 * @author Alex Scherer <alex.scherer@cubetech.ch>
 * @since 1.1.0
 */
class FooterLogic extends ABaseLogic
{
    /**
     * @var array<IRenderable> array of renderable sidebars
     */
    protected $sidebars;
    
    /**
     * @var string the footer adress defined in the theme options
     */
    protected $footerAddress;
    
    /**
     * Initializes this logic module with the Footer sidebars
     *
     * @param integer $id
     * @return void
     *
     * @see Cubetech\TemplateLogic\ILogic
     *
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @since 1.1.0
     */
    public function initialize(int $id)
    {
        $this->sidebars = SidebarController::getSidebars();
        $this->footerAddress = Options::getThemeOption('address');
        $this->initialized = true;
    }
    
    /**
     * Get the footer address from the theme options
     *
     * @return string
     *
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public function getFooterAddress()
    {
        return $this->footerAddress;
    }
    
    /**
     * Get the sidebars (widgets)
     *
     * @return string
     *
     * @author Lars Berg <lars.berg@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public function getSidebars()
    {
        return $this->sidebars;
    }
    
    /**
     * Checks if a footer address has been defined
     *
     * @return string
     *
     * @author Lars Berg <lars.berg@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public function hasFooterAddress()
    {
        return !empty($this->footerAddress);
    }
    
    /**
     * Checks if footer has any sidebars
     *
     * @return bool
     *
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public function hasSidebars()
    {
        return !empty($this->sidebars);
    }
}