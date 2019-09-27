<?php

namespace Cubetech\Controller;

/**
 * The place to add css dependencies
 *
 * Handles the registering and the enqueuing of
 * CSS dependencies
 *
 * @author Marc Mentha <marc@cubetech.ch>
 * @since 1.1.0
 * @version 1.1.0
 */
class StyleController extends ABaseController
{
    /**
     * Path to the distribution directory of styles
     *
     * @var string
     */
    private const ASSETS_DIR = '/assets/dist/styles/';
    
    /**
     * Path to the distribution directory of styles
     *
     * @var string
     */
    private const BACKEND_ASSETS_DIR = '/assets/dist/backend/';
    
    /**
     * Path to the distribution directory of styles
     *
     * @var string
     */
    private const NODE_ASSETS_DIR = '/node_modules/';
    
    /**
     * All frontend releated styles
     *
     * Register with handle => filename
     *
     * @var array
     * @static
     */
    private static $Styles = ['theme-main' => 'theme.min.css'];
    
    /**
     * All backend related styles
     *
     * Register with handle => filename
     *
     * @var array
     * @static
     */
    private static $BackendStyles = ['backend' => 'backend.min.css'];
    
    /**
     * All node_modules related styles
     *
     * Register with handle => filename
     *
     * @var array
     * @static
     */
    private static $NodeStyles = [];
    
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
        add_action('wp_enqueue_scripts', __CLASS__ . '::registerStyles');
        add_action('admin_enqueue_scripts', __CLASS__ . '::registerBackendStyles');
        add_action('wp_print_styles', __CLASS__ . '::deRegisterUnused', 100);
    }
    
    /**
     * Add a new css dependency from node_modules
     *
     * Can be used for components like the map or gallery
     *
     * @param array $dependency
     * @return void
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.1.0
     * @version 1.0.0
     */
    public static function addNodeDependency($dependency)
    {
        foreach (self::$NodeStyles as $handle => $path) {
            if (array_key_exists($handle, $dependency)) {
                return;
            }
        }
        foreach ($dependency as $key => $value) {
            self::$NodeStyles[$key] = $value;
        }
    }
    
    /**
     * Registering all styles
     *
     * Depending on frontend
     * this method decides wheather to include
     * the backend styles or not
     *
     * @return void
     *
     * @static
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.1.0
     * @version 1.0.0
     */
    public static function registerStyles()
    {
        foreach (self::$Styles as $handle => $file) {
            self::registerStyle($handle, self::ASSETS_DIR . $file);
        }
        if ( !is_admin()) {
            foreach (self::$NodeStyles as $handle => $file) {
                self::registerStyle($handle, self::NODE_ASSETS_DIR . $file);
            }
        }
    }
    
    /**
     * Registering  Backend styles
     *
     * Depending on backend
     * this method decides wheather to include
     * the backend styles or not
     *
     * @return void
     *
     * @static
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @author Markus Langenegger <markus@cubetech.ch>
     * @since 1.4.2
     * @version 1.0.0
     */
    public static function registerBackendStyles()
    {
        if (is_admin()) {
            foreach (self::$BackendStyles as $handle => $file) {
                self::registerStyle($handle, self::BACKEND_ASSETS_DIR . $file);
            }
        }
    }
    
    /**
     * Registers a single style
     *
     * @param string $handle
     * @param string $file
     * @return void
     *
     * @static
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.1.0
     * @version 1.0.0
     */
    private static function registerStyle(string $handle, string $file)
    {
        $path = get_template_directory() . $file;
        $uri = get_template_directory_uri() . $file;
        if ( !file_exists($path)) {
            error_log(var_export($file, true) . ' not found');
            return;
        }
        wp_enqueue_style($handle, $uri, [], wp_get_theme()->version);
    }
    
    /**
     * Deregisters all unused styles
     *
     * @static
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.1.0
     * @version 1.0.0
     */
    public static function deRegisterUnused()
    {
        wp_dequeue_style('wp-block-library');
        wp_deregister_style('wp-block-library');
        
        if ( !is_user_logged_in()) {
            wp_deregister_style('dashicons');
        }
    }
}