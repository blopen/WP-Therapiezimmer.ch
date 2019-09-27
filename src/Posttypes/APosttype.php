<?php

namespace Cubetech\Posttypes;

use \Cubetech\Theme;

/**
 * The base class for all custom posttypes
 *
 * @author Marc Mentha <marc@cubetech.ch
 * @since 0.0.1
 * @version 1.1.0
 * @abstract
 */
abstract class APosttype
{
    /**
     * The constructor defined as final to prevent multiple
     * method calls on usage of static functions
     *
     * @return void
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     * @final
     */
    final public function __construct()
    {
    }
    
    /**
     * Hooks into init for registering the custom posttype
     * and optionally registering taxonomies
     * Defined abstract to prevent fatal errors in posttype loader
     *
     * @return void
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 0.0.1
     * @version 1.0.0
     * @abstract
     */
    abstract public static function initialize();
    
    /**
     * Sets labels and arguments for registering a custom posttype
     * Defined abstract to force developers to follow the codingstandards
     *
     * @return void
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     * @abstract
     */
    public static function registerPosttype()
    {
        register_post_type(static::getType(), static::getArguments());
    }
    
    /**
     * Returns an array with all posts of the
     * specific posttype as CubetechPosts
     *
     * @return array <CubetechPost>
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.1.0
     * @version 1.0.0
     */
    public static function getAll()
    {
        $arguments = ['post_type' => static::getType(), 'numberposts' => -1,];
        return Theme::getPosts($arguments);
    }
    
    /**
     * Returns all needed labels for
     * registering a posttype
     *
     * @return void
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.1.0
     * @version 1.0.0
     */
    abstract public static function getLabels();
    
    /**
     * Returns all needed arguments for
     * registering a posttype
     *
     * @return void
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.1.0
     * @version 1.0.0
     */
    abstract public static function getArguments();
    
    /**
     * Make the posttype accessible in parent class
     *
     * @return void
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.1.0
     * @version 1.0.0
     */
    abstract public static function getType();
}