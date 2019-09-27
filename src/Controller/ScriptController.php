<?php

namespace Cubetech\Controller;

/**
 * The place to add js dependencies
 *
 * Handles the registering and the enqueuing of
 * JS dependencies
 *
 * @author Marc Mentha <marc@cubetech.ch>
 * @since 1.1.0
 * @version 1.0.1
 */
class ScriptController extends ABaseController
{
    /**
     * Path to the distribution directory of scripts
     *
     * @var string
     */
    private const ASSETS_DIR = '/assets/dist/scripts/';
    
    /**
     * Path to the distribution directory of backend scripts
     *
     * @var string
     */
    private const BACKEND_ASSETS_DIR = '/assets/dist/backend/';
    
    /**
     * All frontend releated scripts
     *
     * Register with handle => [  file => filename, dependencies => [dependency-one, ...]
     *
     * @var array
     * @static
     */
    private static $Scripts = ['main' => ['file' => 'main.min.js', 'dependencies' => ['jquery']]];
    
    /**
     * All backend releated scripts
     *
     * Register with handle => [  file => filename, dependencies => [dependency-one, ...]
     *
     * @var array
     * @static
     */
    private static $AdminScripts = ['cubetechBackend' => ['file' => 'backend.min.js', 'dependencies' => ['jquery']]];
    
    /**
     * Abstraction from ABaseController
     *
     * @return void
     *
     * @static
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @author Jethro Christen <jethro@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.1
     */
    public static function addActions()
    {
        add_action('wp_enqueue_scripts', __CLASS__ . '::registerFrontendScripts');
        if (is_admin()) {
            add_action('admin_enqueue_scripts', __CLASS__ . '::registerAdminScripts');
        }
        else {
            add_action('wp_enqueue_scripts', __CLASS__ . '::replaceWordpressdefaultJquery');
            add_action('wp_enqueue_scripts', __CLASS__ . '::localizeScript');
            add_filter('script_loader_tag', __CLASS__ . '::addAsyncAttributes', 10, 2);
        }
    }
    
    /**
     * Registers all admin script (Frontend)
     *
     * @return void
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.1.0
     * @version 1.0.0
     */
    public static function registerFrontendScripts()
    {
        foreach (self::$Scripts as $handle => $data) {
            $path = get_template_directory() . self::ASSETS_DIR . $data['file'];
            $uri = get_template_directory_uri() . self::ASSETS_DIR . $data['file'];
            self::registerScript($handle, $path, $uri, $data['dependencies']);
        }
    }
    
    /**
     * Registers all admin script (Backend)
     *
     * @return void
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.1.0
     * @version 1.0.0
     */
    public static function registerAdminScripts()
    {
        foreach (self::$AdminScripts as $handle => $data) {
            $path = get_template_directory() . self::BACKEND_ASSETS_DIR . $data['file'];
            $uri = get_template_directory_uri() . self::BACKEND_ASSETS_DIR . $data['file'];
            self::registerScript($handle, $path, $uri, $data['dependencies']);
        }
    }
    
    /**
     * Deregister Wordpress' default jQuery and jquery-migrate
     *
     * @return void
     *
     * @author Markus Langenegger <markus@cubetech.ch>
     * @since 1.1.0
     * @version 1.0.0
     */
    public static function replaceWordpressdefaultJquery()
    {
        wp_deregister_script('jquery');
        if (file_exists(get_template_directory() . '/node_modules/jquery/dist/jquery.min.js')) {
            wp_enqueue_script('jquery', get_template_directory_uri() . '/node_modules/jquery/dist/jquery.min.js', [], null, false);
        }
    }
    
    /**
     * Registers a single script
     *
     * @param string $handle
     * @param string $path
     * @param string $uri
     * @param array $dependencies
     * @return void
     *
     * @static
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.1.0
     * @version 1.0.0
     */
    private static function registerScript(string $handle, string $path, string $uri, array $dependencies)
    {
        if ( !file_exists($path)) {
            error_log(var_export($path, true) . ' not found');
            return;
        }
        wp_enqueue_script($handle, $uri, $dependencies, wp_get_theme()->version, true);
    }
    
    /**
     * Adds async attribute to scripttags given in
     * this methods $cubetechHandles
     *
     * @param string $tag
     * @param string $handle
     * @return void
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @author Jethro Christen <jethro@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.1
     */
    public static function addAsyncAttributes($tag, $handle)
    {
        $cubetechHandles = ['jquery-core'];
        foreach ($cubetechHandles as $cubetechHandle) {
            if ($cubetechHandle === $handle) {
                return str_replace(' src', ' async="async" src', $tag);
            }
        }
        return self::addDeferAttribute($tag, $handle);
    }
    
    /**
     * Adds defer attribute to all scripttags except
     * the defined ones in exceptions variable
     *
     * @param string $tag
     * @param string $handle
     * @return void
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @author Jethro Christen <jethro@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.1
     */
    private static function addDeferAttribute($tag, $handle)
    {
        $exeptions = ['jquery'];
        foreach ($exeptions as $exeption) {
            if ($exeption === $handle) {
                return $tag;
            }
        }
        return str_replace(' src', ' defer="defer" src', $tag);
    }
    
    /**
     * Add options to javascript context
     *
     * @return void
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public static function localizeScript()
    {
        $mapboxStylePath = 'mapbox://styles/mapbox/light-v9?optimized=true';
        if (file_exists(get_stylesheet_directory() . "/assets/src/styles/mapbox/mapstyle.json")) {
            $mapboxStylePath = get_stylesheet_directory_uri() . "/assets/src/styles/mapbox/mapstyle.json";
        }
        
        $values = ['MapboxStylePath' => $mapboxStylePath, 'TemplatePath' => get_template_directory_uri()];
        wp_localize_script('main', 'localized', $values);
    }
}