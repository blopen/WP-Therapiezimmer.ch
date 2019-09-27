<?php

namespace Cubetech\Controller;

use \Cubetech\Base\Options;
use \Cubetech\Base\Navigation;

/**
 * Loads navigations from transients
 * registers navigation positions
 *
 * @author Marc Mentha <marc@cubetech.ch>
 * @since 1.0.0
 * @version 1.0.0
 */
class NavigationController
{
    /**
     * Suffix for saving into transient
     *
     * @var string
     */
    private const TRANSIENT_SUFFIX = '_navigation';
    
    /**
     * Navigation positions
     *
     * Register slug => name
     *
     * @static
     *
     * @var array
     */
    private static $Positions = [
        'primary'   => 'Primary Navigation',
        'secondary' => 'Secondary Menu',
    ];
    
    /**
     * Navigatoins already taken from transient
     * from same request
     *
     * This enhances the speed when the same navigation is used
     * multiple times on a page
     *
     * @static
     * @var array
     */
    private static $LoadedNavigations;
    
    /**
     * Abstraction from ABaseController
     *
     * @return void
     *
     * @static
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public static function addActions()
    {
        add_action('after_setup_theme', __CLASS__ . '::registerPositions');
        add_action('wp_update_nav_menu', __CLASS__ . '::clearTransients');
        add_action('wp_save_nav_menu', __CLASS__ . '::clearTransients');
        
    }
    
    /**
     * Get a navigation from string (position)
     *
     * @param string $position
     * @return Navigation
     *
     * @static
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public static function getNavigation(string $position)
    {
        
        if (isset(self::$LoadedNavigations[$position])) {
            return self::$LoadedNavigations[$position];
        }
        
        $cachedNavigation = self::getNavigationTransient($position);
        
        if ($cachedNavigation instanceof \Cubetech\Base\Navigation) {
            return $cachedNavigation;
        }
        else {
            $navigation = new Navigation($position);
            self::setNavigationTransient($position, $navigation);
            return $navigation;
        }
    }
    
    /**
     * Clears all transients after a navigation has
     * been updated
     *
     * @return void
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.0.0
     * @version 2.0.0
     */
    public static function clearTransients()
    {
        if (function_exists('pll_languages_list')) {
            $languages = pll_languages_list([
                'hide_empty' => true,
                'fields'     => 'slug',
            ]);
        }
        else {
            $languages = ['de'];
        }
        foreach (self::$Positions as $positionSlug => $positionName) {
            
            foreach ($languages as $language) {
                delete_transient('ct_' . $positionSlug . '_' . $language . self::TRANSIENT_SUFFIX);
            }
        }
    }
    
    /**
     * Sets a transient
     *
     * @param string $position
     * @param Navigation $navigation
     * @return void
     *
     * @static
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    private static function setNavigationTransient(string $position, Navigation $navigation)
    {
        self::$LoadedNavigations[$position] = $navigation;
        set_transient('ct_' . $position . '_' . Options::getCurrentLanguage() . self::TRANSIENT_SUFFIX, serialize($navigation));
    }
    
    /**
     * get a navigation transient
     *
     * @param string $position
     * @return void
     *
     * @static
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    private static function getNavigationTransient(string $position)
    {
        return unserialize(get_transient('ct_' . $position . '_' . Options::getCurrentLanguage() . self::TRANSIENT_SUFFIX));
    }
    
    /**
     * Get the navigations slug by id
     *
     * @param int $menuId
     * @return void
     *
     * @static
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    private static function getNavigationPosition($menuId)
    {
        $locations = get_nav_menu_locations();
        foreach ($locations as $position => $id) {
            if ($menuId === $id) {
                return $position;
            }
        }
        return false;
    }
    
    /**
     * Resgisters the Navigation positions
     *
     * @return void
     *
     * @static
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public static function registerPositions()
    {
        foreach (self::$Positions as $positionSlug => $positionName) {
            register_nav_menu($positionSlug, $positionName);
        }
    }
}