<?php

namespace Cubetech\TemplateLogic;

/**
 * Abstract class implementing empty functions not needed yet
 *
 * @author Alex Scherer <alex.scherer@cubetech.ch>
 * @since 1.1.0
 */
abstract class ABaseLogic implements ILogic
{
    /**
     * Gets called before the TemplatePart is rendered
     *
     * @return void
     *
     * @see Cubetech\TemplateLogic\ILogic
     *
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @since 1.1.0
     */
    public function beforeRender()
    {
        
    }
    
    /**
     * Gets called after the TemplatePart has been rendered
     *
     * @return void
     *
     * @see Cubetech\TemplateLogic\ILogic
     *
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @since 1.1.0
     */
    public function afterRender()
    {
        
    }
}