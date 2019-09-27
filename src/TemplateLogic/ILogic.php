<?php

namespace Cubetech\TemplateLogic;

/**
 * Interface for the LogicModules used in TemplateParts
 */
interface ILogic
{
    /**
     * Function for initializing the Logic module
     *
     * Gets called by TemplatePart
     *
     * @param integer $id
     * @return void
     *
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @since 1.1.0
     */
    public function initialize(int $id);
    
    /**
     * Gets called before the TemplatePart is rendered
     *
     * @return void
     *
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @since 1.1.0
     */
    public function beforeRender();
    
    /**
     * Gets called after the TemplatePart is rendered
     *
     * @return void
     *
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @since 1.1.0
     */
    public function afterRender();
}