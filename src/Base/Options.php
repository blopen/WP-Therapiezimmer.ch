<?php

namespace Cubetech\Base;

/**
 * Class to handle genreal options and saves them
 * to a transient for faaster options handling
 *
 * @author Marc Mentha <marc@cubetech.ch>
 * @author Christoph S. Ackermann <acki@cubetech.ch>
 * @since 1.0.0
 * @version 1.0.0
 */
class Options
{
    
    private static $LoadedOptions;
    
    /**
     * Returns a "Theme Options" field
     * If the vlue already isset in transient "ct_option_cache"
     * this value will be returned
     * If the value is not found in the transient,
     * this function will call get_option and safe the value to the transient afterwards
     *
     * @param string $key
     * @return mixed
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public static function getThemeOption(string $key)
    {
        if (isset(self::$LoadedOptions[$key])) {
            return self::$LoadedOptions[$key];
        }
        
        $optionsCache = unserialize(get_transient('ct_option_cache'));
        if ( !isset($optionsCache[self::getCurrentLanguage() . '_' . $key])) {
            $optionsCache[self::getCurrentLanguage() . '_' . $key] = get_option('options_' . self::getCurrentLanguage() . '_' . $key);
        }
        self::$LoadedOptions[$key] = $optionsCache[self::getCurrentLanguage() . '_' . $key];
        set_transient('ct_option_cache', serialize($optionsCache));
        return $optionsCache[self::getCurrentLanguage() . '_' . $key];
    }
    
    /**
     * Resets te transient after the
     * Theme Options page has been saved
     *
     * @return void
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public static function resetCache()
    {
        $screen = get_current_screen();
        if ( !strpos($screen->id, 'theme-options')) {
            return;
        }
        delete_transient('ct_option_cache');
    }
    
    /**
     * Returns the current languae slud (i.e. "de" for german)
     * Defaults to "de" if polylang plugin is missing
     *
     * @return string
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public static function getCurrentLanguage()
    {
        if ( !function_exists('pll_current_language')) {
            return 'de';
        }
        return pll_current_language();
    }
    
    /**
     * Registers an options page "Theme Optionen"
     * wherer diefferent settings about the theme vcan be made
     * Hooks into acf/save_post to check if the transient needs to be reseted
     *
     * @return void
     */
    public static function initializeThemeOptionsPage()
    {
        if (function_exists('acf_add_options_page')) {
            acf_add_options_sub_page([
                'page_title'  => 'Theme Optionen',
                'menu_title'  => 'Theme Optionen',
                'menu_slug'   => 'theme-options',
                'capability'  => 'edit_posts',
                'redirect'    => false,
                'parent_slug' => 'themes.php',
            ]);
        }
        add_action('acf/save_post', [
            'Cubetech\Base\Options',
            'resetCache',
        ], 10, 1);
    }
}
