<?php

namespace Cubetech\PageBuilder;

use \Cubetech\Rendering\IRenderable;
use \Cubetech\Rendering\IStringRenderable;
use \Cubetech\Base\ACFWrapper;

/**
 * PageBuilder class for loading page builder components from a
 * Post object and rendering them.
 *
 * @author Alex Scherer <alex.scherer@cubetech.ch>
 * @author Marc Mentha <marc@cubetech.ch>
 * @version 1.1.0
 * @since 1.0.0
 */
class PageBuilder extends ACFWrapper implements IRenderable, IStringRenderable
{
    
    /**
     * post id from page or post were the pagebuilder is recorded
     *
     * @var int
     */
    private $postId;
    
    /**
     * Array with strings containing the recorded components
     *
     * @var array of strings
     */
    private $layouts;
    
    /**
     * Holds the component classes for rendering
     *
     * @var array of \Cubetech\PageBuilder\Components
     */
    private $components;
    
    /**
     * String to define all comoponents container classes.
     *
     * @var string
     */
    private $containerClass;
    
    /**
     * Used for dynamically loading component classes
     */
    const COMPONENT_NAMESPACE = '\Cubetech\PageBuilder\Components\\';
    
    /**
     * Constructor for the pageBuilder class
     * Initializes postId, getting layouts from backend
     * and coponentclasses
     *
     * @param int $postId
     *
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @version 1.0.0
     * @since 1.0.0
     */
    public function __construct($postId, $containerClass = 'uk-container')
    {
        $this->containerClass = $containerClass;
        $this->postId = $postId;
        $this->layouts = $this->getField('pagebuilder');
        $this->initialize();
    }
    
    /**
     * Initializes the page builder from the post id
     * given to the constructor
     *
     * @return void
     *
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @version 1.0.0
     * @since 1.0.0
     */
    public function initialize()
    {
        if ($this->isFieldValid('layouts')) {
            foreach ($this->layouts as $componentIndex => $layout) {
                $componentNamespace = self::COMPONENT_NAMESPACE . $layout . 'Component';
                $this->components[] = new $componentNamespace($this->postId, $componentIndex, $this->containerClass);
            }
        }
    }
    
    /**
     * Checks if the pagebuilder has components
     *
     * @return bool
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @version 1.0.0
     * @since 1.1.0
     */
    public function hasComponents()
    {
        if (empty($this->layouts)) {
            return false;
        }
        return true;
    }
    
    /**
     * Render method for looping through all components for this post
     * and rendering them.
     * Inheritet from Cubetech\Rendering\IRenderable
     *
     * @return void
     *
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @version 1.0.0
     * @since 1.0.0
     * @final
     */
    final public function render()
    {
        if ( !empty($this->components)) {
            foreach ($this->components as $component) {
                $component->render();
            }
        }
    }
    
    /**
     * Renders all compatible components' contents into
     * a string
     *
     * @return string
     *
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @version 1.0.0
     * @since 1.0.0
     * @final
     */
    final public function renderToString()
    {
        $returnString = '';
        if ( !empty($this->components)) {
            foreach ($this->components as $component) {
                if ($component instanceof IStringRenderable) {
                    $returnString .= $component->renderToString();
                }
            }
        }
        return $returnString;
    }
    
    /**
     * Get the post id the pagebuilder lives on
     * Inherited from Cubetech\Base\ACFWrapper
     *
     * @return int
     *
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @version 1.0.0
     * @since 1.0.0
     */
    public function getId()
    {
        return $this->postId;
    }
    
    /**
     * Checks if properties are valid
     * Inherited from Cubetech\Base\ACFWrapper
     *
     * @param string $key
     * @return bool
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @version 1.0.0
     * @since 1.0.0
     */
    public function isFieldValid(string $key)
    {
        return !empty($this->$key);
    }
}