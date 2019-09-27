<?php

namespace Cubetech\Controller;

/**
 * Calls the run function for all Packages
 *
 * @author Marc Mentha <marc@cubetech.ch>
 * @since 1.1.0
 * @version 1.0.0
 */
class PackageController extends ABaseController
{
    /**
     * Classes of Frontend packeages
     *
     * @var array
     */
    private const FRONTEND_PACKAGES = [\Cubetech\Packages\Frontend\LoginScreen::class, \Cubetech\Packages\Frontend\CubetechPerformanceCenter::class, \Cubetech\Packages\Frontend\GravityFormPackage::class, \Cubetech\Packages\Frontend\Shortcodes::class];
    
    /**
     * Classes of Backend packeages
     *
     * @var array
     */
    private const BACKEND_PACKAGES = [\Cubetech\Packages\Backend\Dashboard::class, \Cubetech\Packages\Backend\CubetechPostCacher::class];
    
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
        self::loadPackages(self::FRONTEND_PACKAGES);
        if (is_admin()) {
            self::loadPackages(self::BACKEND_PACKAGES);
        }
    }
    
    /**
     * Loads all Packages defined in $this->packages
     *
     * @param array $packages
     * @return void
     *
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    private static function loadPackages(array $packages)
    {
        foreach ($packages as $package) {
            $instance = new $package();
            $instance->run();
        }
    }
}