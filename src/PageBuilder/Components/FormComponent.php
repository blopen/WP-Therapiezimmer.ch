<?php

namespace Cubetech\PageBuilder\Components;

use \Cubetech\Rendering\IStringRenderable;

/**
 * Title/Text component class for pagebuilder
 *
 * @author Alex Scherer <alex.scherer@cubetech.ch>
 * @version 1.0.0
 * @since 1.0.0
 */
class FormComponent extends BaseComponent implements IStringRenderable
{
    /**
     * ID of the gravity form
     *
     * @var string
     */
    protected $formId;
    
    /**
     * Constructor method for this component
     * Initializes title and formId properties
     *
     * @param int $postId
     * @param int $index
     *
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @since 1.0.0
     */
    public function __construct($postId, $index, $containerClass)
    {
        parent::__construct('Form', $postId, $index, $containerClass);
        $this->formId = $this->getComponentField('form');
    }
    
    /**
     * Returns the text of the component as a string
     *
     * @return string
     *
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @since 1.0.0
     */
    public function renderToString()
    {
        return '';
    }
    
    /**
     * Validates the component for this particular component
     * Both the title and text properties are needed
     * and therefore both must have been set
     *
     * @return boolean
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.0.0
     */
    public function isValid()
    {
        if ( !empty($this->formId)) {
            return true;
        }
        return false;
    }
}