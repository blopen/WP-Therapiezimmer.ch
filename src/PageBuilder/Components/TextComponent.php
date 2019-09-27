<?php

namespace Cubetech\PageBuilder\Components;

use \Cubetech\Rendering\IStringRenderable;

/**
 * Title/Text component class for pagebuilder
 *
 * @author Marc Mentha <marc@cubetech.ch>
 * @author Alex Scherer <alex.scherer@cubetech.ch>
 * @author Steeve Jeannin <steeve@cubetech.ch>
 * @version 1.0.0
 * @since 1.0.0
 */
class TextComponent extends BaseComponent implements IStringRenderable
{
    
    /**
     * Define if there is 1 or 2 text to display in this component
     * Generated from ACF WYSIWYG field
     *
     * @var string
     */
    protected $text_2_columns;
    
    /**
     * Text of this component
     * Generated from ACF WYSIWYG field
     *
     * @var string
     */
    protected $text;
    
    /**
     * Second text (optional) of this component
     * Generated from ACF WYSIWYG field
     *
     * @var string
     */
    protected $text2;
    
    /**
     * Constructor method for this component
     * Initializes title and text properties
     *
     * @param int $postId
     * @param int $index
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.0.0
     */
    public function __construct($postId, $index, $containerClass)
    {
        parent::__construct('Text', $postId, $index, $containerClass);
        $this->text_2_columns = $this->getComponentField('text_2_columns');
        $this->text = $this->getComponentField('text');
        $this->text2 = $this->getComponentField('text2');
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
        $returnString = $this->text . ' ';
        if ($this->text_2_columns) {
            $returnString .= $this->text2 . ' ';
        }
        return $returnString;
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
        return !empty($this->text);
    }
}