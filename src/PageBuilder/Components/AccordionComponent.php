<?php

namespace Cubetech\PageBuilder\Components;

use Cubetech\Rendering\IStringRenderable;

/**
 * Accordion component class for pagebuilder
 *
 * @author Jurij Kamolov <jurij@cubetech.ch>
 * @version 1.0.0
 * @since 1.0.0
 */
class AccordionComponent extends BaseComponent implements IStringRenderable
{
    /**
     * Title of this component
     * Generated from ACF singleline field
     *
     * @var string
     */
    protected $title;
    
    /**
     *Title and Text of accordion field
     *Generated from ACF singleline field
     *and WYSIWYG field
     *
     * @var string
     */
    protected $accordions;
    
    /**
     * Initializes the component
     *
     * @param int $postId
     * @param int $index
     * @param string $containerClass
     *
     * @return void
     *
     * @author Jurij Kamolov <jurij@cubetech.ch>
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public function __construct($postId, $index, $containerClass)
    {
        parent::__construct('Accordion', $postId, $index, $containerClass);
        $this->title = $this->getComponentField('accordion_component_title');
        $this->accordions = $this->getComponentRepeaterField('accordion', ['accordion_title', 'accordion_content']);
    }
    
    /**
     * Validates the component for this particular component
     * Both the title and text properties of accordion are needed
     * and therefore both must have been set
     *
     * @return boolean
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public function isValid()
    {
        return !empty($this->accordions);
    }
    
    /**
     * Returns the text of the component as a string
     *
     * @return string
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public function renderToString()
    {
        $returnString = $this->title . ' ';
        foreach ($this->getComponentRepeaterField('accordion', ['accordion_title', 'accordion_content']) as $accordion) {
            $returnString .= $accordion->accordion_title . ' ' . $accordion->accordion_content . ' ';
        }
        return $returnString;
    }
}