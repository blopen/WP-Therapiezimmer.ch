<?php

namespace Cubetech\Controller;

use \Cubetech\Base\Options;

/**
 * Handles all theme specific actions and hooks
 *
 * Adds Theme supports and loads the theme text domain
 *
 * @author Marc Mentha <marc@cubetech.ch>
 * @since 1.1.0
 * @version 1.0.0
 */
class ThemeController extends ABaseController
{
    /**
     * Abstraction from ABaseController
     *
     * @return void
     *
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.1.0
     * @version 1.0.0
     */
    public static function addActions()
    {
        add_action('after_setup_theme', __CLASS__ . '::addThemeSupport');
        add_action('after_setup_theme', __CLASS__ . '::loadTextdomain');
        if (is_admin()) {
            Options::initializeThemeOptionsPage();
        }
    }
    
    /**
     * Add Theme supports for thumbnails and widgets
     *
     * @return void
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.1.0
     * @version 1.0.0
     */
    public static function addThemeSupport()
    {
        add_theme_support('post-thumbnails', ['post']);
        add_theme_support('widgets');
    }
    
    /**
     * Loads the theme text domain
     *
     * @return void
     *
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public static function loadTextDomain()
    {
        load_theme_textdomain('wptheme-basetheme', get_template_directory() . '/languages');
    }
}