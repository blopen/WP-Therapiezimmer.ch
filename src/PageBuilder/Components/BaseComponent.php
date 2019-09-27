<?php

namespace Cubetech\PageBuilder\Components;

use \Cubetech\Rendering\IRenderable;
use \Cubetech\Base\ACFWrapper;
use Cubetech\Rendering\RenderableTrait;

/**
 * Abstract BaseComponent describes the bare minimum any
 * PageBuilder component must provide and includes a final
 * render method for unified rendering
 *
 * @author Alex Scherer <alex.scherer@cubetech.ch>
 * @author Marc Mentha <marc@cubetech.ch>
 * @since 0.0.1
 * @version 1.0.0
 * @abstract
 */
abstract class BaseComponent extends ACFWrapper implements IRenderable
{
    /**
     * This implements all needed functionality to satisfy IRenderable
     * and to automate the inclusion of the correct view file
     */
    use RenderableTrait;
    
    /**
     * Post id the component recorded at.
     * Used to get values out of teh database
     *
     * @var int
     */
    private $postId;
    
    /**
     * The index (position) inside the pagbuilder.
     * Also used to get the values out of the database
     *
     * @var int
     */
    private $index;
    
    /**
     * Initializes class properties
     *
     * @param string $name
     * @param int $postId
     * @param int $index
     * @return void
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @version 1.0.0
     * @since 1.0.0
     */
    public function __construct($name, $postId, $index, $containerClass)
    {
        $this->initializeRenderable('components', get_class($this), $name);
        $this->postId = $postId;
        $this->index = $index;
        $this->containerClass = $containerClass;
    }
    
    /**
     * Checks if the current component is valid.
     * CAUTION: Only valid components will be rendered!
     *
     * @return bool
     *
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @version 1.0.0
     * @since 1.0.0
     * @abstract
     */
    abstract public function isValid();
    
    /**
     * Creates the correct format for getting a value from the pagebuilder
     * without generating queries
     *
     * @param string $name of the acf field inside the pagebuilder
     * @return string
     *
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @version 1.0.0
     * @since 1.0.0
     */
    protected function getFieldName($name)
    {
        return $this->name . '_fields_' . $name;
    }
    
    /**
     * Implementation specially for pagebuildercomponents values
     *
     * @param string $name
     * @param boolean $returnSingle
     * @return string
     *
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @author Marc Mentha <marc@cubetech.ch>
     * @version 1.0.0
     * @since 1.0.0
     */
    protected function getComponentField($name, $returnSingle = true)
    {
        return $this->getField('pagebuilder_' . $this->index . '_' . $this->getFieldName($name), $returnSingle);
    }
    
    /**
     * Implementation specially for pagebuildercomponents repeater fields
     *
     * @param string $name
     * @param array $subFields
     * @param int $subIndex (for recursive call only)
     * @param string $subName (for recursive call only)
     * @return string
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @author Steeve Jeannin <steeve@cubetech.ch>
     * @version 1.0.0
     * @since 1.0.0
     */
    protected function getComponentRepeaterField($name, $subFields, $subIndex = -1, $subName = "")
    {
        $recursiveName = ($subIndex > -1) && !empty($subName) ? "_" . $subIndex . "_" . $subName : "";
        $count = $this->getComponentField($name . $recursiveName);
        $acfFlexibleContentLayout = [];
        if (is_array($count)) {
            // Possible in case of "Flexible Content" (Flexible Inhalte) instead of "Repeater" (Wiederholung)
            $acfFlexibleContentLayout = $count;
            $count = count($count);
        }
        $results = [];
        for ($i = 0; $i < $count; $i++) {
            $entry = new \stdClass();
            foreach ($subFields as $subKey => $subField) {
                if (is_array($subField)) {
                    $entry->$subKey = $this->getComponentRepeaterField($name, $subField, $i, $subKey);
                }
                else {
                    $fieldName = 'pagebuilder_' . $this->index . '_' . $this->getFieldName($name) . $recursiveName . '_' . $i . '_' . $subField;
                    $entry->$subField = $this->getField($fieldName);
                }
            }
            $entry->acfFlexibleContentLayout = isset($acfFlexibleContentLayout[$i]) ? $acfFlexibleContentLayout[$i] : "";
            $results[] = $entry;
        }
        return $results;
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
     * Checks if propertys are valid
     * Inherited from Cubetech\Base\ACFWrapper
     *
     * @param string $key
     * @return bool
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @since 1.0.0
     */
    public function isFieldValid(string $key)
    {
        return !empty($this->$key);
    }
}