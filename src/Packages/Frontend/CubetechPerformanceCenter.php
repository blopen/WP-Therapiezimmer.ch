<?php

namespace Cubetech\Packages\Frontend;

use \Cubetech\Packages\IPackage;

/**
 * Remove all WordPress related nonsense
 *
 * @author Marc Mentha <marc@cubetech.ch>
 * @since 1.1.0
 * @version 1.0.0
 */
class CubetechPerformanceCenter implements IPackage
{
    
    public function run()
    {
        add_action('init', [$this, 'disableEmojis']);
    }
    
    /**
     * Disable the emoji's
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.1.0
     * @version 1.0.0
     */
    public function disableEmojis()
    {
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('admin_print_scripts', 'print_emoji_detection_script');
        remove_action('wp_print_styles', 'print_emoji_styles');
        remove_action('admin_print_styles', 'print_emoji_styles');
        remove_filter('the_content_feed', 'wp_staticize_emoji');
        remove_filter('comment_text_rss', 'wp_staticize_emoji');
        remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
        add_filter('tiny_mce_plugins', [$this, 'disableEmojisTinyMCE']);
    }
    
    /**
     * Filter function used to remove the tinymce emoji plugin.
     *
     * @param array $plugins
     * @return   array  Difference betwen the two arrays
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.1.0
     * @version 1.0.0
     */
    public function disableEmojisTinyMCE($plugins)
    {
        if (is_array($plugins)) {
            return array_diff($plugins, ['wpemoji']);
        }
        else {
            return [];
        }
    }
}