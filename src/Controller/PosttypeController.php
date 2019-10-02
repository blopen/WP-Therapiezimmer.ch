<?php

namespace Cubetech\Controller;

/**
 * Calls the initialize fmethod for all posttypes
 *
 * @author Marc Mentha <marc@cubetech.ch>
 * @since 1.1.0
 * @version 1.0.0
 */
class PosttypeController extends ABaseController
{
    /**
     * All Poposttypes to be rregistered
     *
     * @var array
     */
    private const POSTTYPES = [
        \Cubetech\Posttypes\CrewPosttype::class,
        \Cubetech\Posttypes\DownloadPosttype::class,
        \Cubetech\Posttypes\EventPosttype::class,
    ];
    
    /**
     * Abstraction from ABaseController
     *
     * @return void
     *
     * @static
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.1.0
     * @version 1.0.0
     */
    public static function addActions()
    {
        foreach (self::POSTTYPES as $posttype) {
            if (self::isPosttypeClass($posttype)) {
                $posttype::initialize();
            }
        }
    }
    
    /**
     * Checks if the given class has all
     * needed props
     *
     * @param string $posttype
     * @return boolean
     *
     * @static
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.1.0
     * @version 1.0.0
     */
    private static function isPosttypeClass(string $posttype)
    {
        
        if ( !class_exists($posttype)) {
            return false;
        }
        if ( !method_exists($posttype, 'initialize')) {
            return false;
        }
        return true;
    }
}