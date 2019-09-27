<?php

namespace Cubetech\Packages\Frontend;

use \Cubetech\Packages\IPackage;

/**
 * Theme package for gravityform.
 *
 * @author Jethro Christen <jethro.christen@cubetech.ch>
 * @version 1.0.0
 */
class GravityFormPackage implements IPackage
{
    /**
     *
     * @return void
     *
     * @author Jethro Christen <jethro.christen@cubetech.ch>
     * @version 1.0.0
     */
    public function run()
    {
        add_filter('gform_field_css_class', [$this, 'addCustomClass'], 10, 2);
        add_filter('gform_field_content', [$this, 'changeFieldHtml'], 10, 2);
        add_action('gform_editor_js_set_default_values', [$this, 'defaultFieldSize'], 10, 2);
    }
    
    /**
     *
     * Change field html.
     *
     * @param string fieldhtml
     * @param array field data
     * @return string fieldhtml
     *
     * @author Jethro Christen <jethro.christen@cubetech.ch>
     * @version 1.0.0
     */
    public function changeFieldHtml($content, $field)
    {
        
        if ($field->type === "textarea") {
            $content = str_replace("class='textarea", "class='textarea uk-textarea", $content);
        }
        if ($field->type === "text") {
            $content = str_replace("class='medium", "class='medium uk-input", $content);
            $content = str_replace("class='small", "class='small uk-input", $content);
            $content = str_replace("class='large", "class='large uk-input", $content);
        }
        if ($field->type === "number") {
            $content = str_replace("class='medium", "class='medium uk-input", $content);
            $content = str_replace("class='small", "class='small uk-input", $content);
            $content = str_replace("class='large", "class='large uk-input", $content);
        }
        
        return $content;
    }
    
    /**
     *
     * Add class to field wrapper.
     *
     * @param string classes
     * @param array field data
     * @return string classes
     *
     * @author Jethro Christen <jethro.christen@cubetech.ch>
     * @version 1.0.0
     */
    public function addCustomClass($classes, $field)
    {
        return $classes . ' ct-' . $field->type;
    }
    
    /**
     *
     * The content of this function is executed in JS.
     * It sets the default field values for the defined fields (default text, textarea and number)
     * WARNING THIS IS A HACK!!!!
     *
     *
     * @author Lars Berg <lars.berg@cubetech.ch>
     * @version 1.0.0
     */
    public function defaultFieldSize()
    {
        ?>

			} //finishes the already opened switch case

			field.size = "large"; //set the field size, no matter what field type (can't be achieved by default)

			switch(inputType) { // continues the previously started siwtch case
        <?php
    }
}