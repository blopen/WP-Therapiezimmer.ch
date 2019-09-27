<?php

namespace Cubetech\Base;

/**
 * Wrapper class for ACF functionallity
 * The meaning of this class is to prevent
 * acf from generating additional, unneeded queries
 *
 * @author Marc Mentha <marc@cubetech.ch>
 * @author Christoph S. Ackermann <acki@cubetech.ch>
 * @since 1.0.0
 * @version 1.0.0
 * @abstract
 */
abstract class ACFWrapper
{
    
    /**
     * get a value from post meta added by acf
     *
     * @param string $key name of the meta field requested
     * @param bool $formatValue return a single value defaults to true
     * @return mixed string or integer
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public function getField(string $key, bool $formatValue = true)
    {
        if (function_exists('get_post_meta') && function_exists('acf_get_valid_post_id')) {
            return get_post_meta(acf_get_valid_post_id($this->getId()), $key, $formatValue);
        }
    }
    
    /**
     * Checks if the field is set and therefore valid
     *
     * @param string $key name of the meta field requested
     * @return bool true if not empty
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public abstract function isFieldValid(string $key);
    
    /**
     * Get values of a repeater field without generating queries
     *
     * @param string $key
     * @param array $subFields
     * @return array with stdClasses including the requested values from subFields
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public function getRepeaterField(string $key, array $subFields)
    {
        $count = $this->getField($key, true);
        $results = [];
        for ($i = 0; $i < $count; $i++) {
            $entry = new \stdClass();
            foreach ($subFields as $subKey => $subField) {
                if (is_array($subField)) {
                    $entry->$subKey = $this->getRepeaterField($key . '_' . $i . '_' . $subKey, $subField);
                }
                else {
                    $entry->$subField = $this->getField($key . '_' . $i . '_' . $subField, true);
                }
            }
            $results[] = $entry;
        }
        return $results;
    }
    
    
    /**
     * Get post id
     * Defined abstract because needed for getting the right values
     *
     * @return int id of post
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public abstract function getId();
}