<?php

namespace Cubetech\Controller;

/**
 * Registers all sidebars specially for the footer
 *
 * @author Marc Mentha <marc@cubetech.ch>
 * @since 1.1.0
 * @version 1.0.0
 */
class SidebarController
{
    /**
     * Sidebars to register
     *
     * @var array
     */
    private const SIDEBARS = ['Footer left', 'Footer right'];
    
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
        add_action('widgets_init', __CLASS__ . '::addSidebars');
    }
    
    /**
     * Registers all sidebars, previously defined in the $sidebars variable
     *
     * @author Lars Berg <lars.berg@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public static function addSidebars()
    {
        foreach (self::SIDEBARS as $sidebar) {
            $sidebarSettings = self::createSidebarSettings($sidebar);
            register_sidebar($sidebarSettings);
        }
        
    }
    
    /**
     * Returns an array of all registered sidebar (widget) ids, mainly used to display widgets in footer.php
     * The widget data can be defined here aswell
     *
     * @return array
     *
     * @author Lars Berg <lars.berg@cubetech.ch>
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.0.0
     * @version 2.0.0
     */
    public static function getSidebars()
    {
        return self::SIDEBARS;
    }
    
    /**
     * Creates a settings array for registering a sidebar
     * to wWordPress core
     *
     * @param string $name
     * @param string $descritpion
     * @param string $widgetElement
     * @param array $widgetClasses
     * @param string $titleElement
     * @param array $titleClasses
     * @return void
     *
     * @static
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    private static function createSidebarSettings(string $name, $description = 'Footerwidget', $widgetElement = 'div', $widgetClasses = ['ct-widget', 'widget'], $titleElement = 'h3', $titleClasses = ['footer-widget-title'])
    {
        return ['name' => $name, 'id' => preg_replace('/[^A-Za-z0-9-]+/', '-', $name), 'description' => $description, 'before_widget' => '<' . $widgetElement . ' class="' . join(' ', $widgetClasses) . ' %2$s">', 'after_widget' => '</' . $widgetElement . '>', 'before_title' => '<' . $titleElement . ' class="' . join(' ', $titleClasses) . '">', 'after_title' => '</' . $titleElement . '>'];
    }
}