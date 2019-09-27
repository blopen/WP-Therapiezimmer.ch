<?php

namespace Cubetech\Posttypes;

/**
 * Adds the custom posttype "downloads" to WordPress
 *
 * @author Steeve Jeannin <steeve@cubetech.ch>
 * @since 1.0.0
 * @version 1.0.0
 */
class DownloadPosttype extends APosttype
{
    /**
     * Adds all actions for this custom posttype
     *
     * @return void
     *
     * @author Steeve Jeannin <steeve@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public static function initialize()
    {
        add_action('init', __CLASS__ . '::registerPostType');
    }
    
    /**
     * Returns the posttype
     *
     * @return string
     *
     * @author Steeve Jeannin <steeve@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public static function getType()
    {
        return 'download';
    }
    
    /**
     * Returns all labels
     *
     * @return array
     *
     * @author Steeve Jeannin <steeve@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public static function getLabels()
    {
        return ['name' => _x('Downloads', 'General name', 'wptheme-basetheme'), 'singular_name' => _x('Download', 'Singular name', 'wptheme-basetheme'), 'menu_name' => _x('Downloads', 'Menu name', 'wptheme-basetheme'), 'parent_item_colon' => _x('Übergeordnetes Download:', 'Parent item with colon', 'wptheme-basetheme'), 'all_items' => _x('Alle Downloads anzeigen', 'All items', 'wptheme-basetheme'), 'view_item' => _x('Download anzeigen', 'View item', 'wptheme-basetheme'), 'add_new_item' => _x('Download hinzufügen', 'Add new item', 'wptheme-basetheme'), 'add_new' => _x('Download hinzufügen', 'Add new', 'wptheme-basetheme'), 'edit_item' => _x('Download bearbeiten', 'Edit item', 'wptheme-basetheme'), 'update_item' => _x('Download aktualisieren', 'Update item', 'wptheme-basetheme'), 'search_items' => _x('Downloads suchen', 'Search items', 'wptheme-basetheme'), 'not_found' => _x('Keine Downloads gefunden.', 'Not found', 'wptheme-basetheme'), 'not_found_in_trash' => _x('Keine Downloads im Papierkorb gefunden.', 'Not found in trash', 'wptheme-basetheme')];
    }
    
    /**
     * Returns all Arguments
     *
     * @return array
     *
     * @author Steeve Jeannin <steeve@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public static function getArguments()
    {
        return ['labels' => self::getLabels(), 'description' => _x('Download items', 'Description', 'wptheme-basetheme'), 'supports' => ['title', 'editor'], 'hierarchical' => false, 'public' => true, 'show_ui' => true, 'show_in_menu' => true, 'show_in_nav_menus' => true, 'show_in_admin_bar' => true, 'can_export' => true, 'has_archive' => false, 'exclude_from_search' => false, 'publicly_queryable' => false, 'capability_type' => 'post', 'map_meta_cap' => true, 'rewrite' => ['slug' => _x('downloads', 'Slug for posttype download', 'wptheme-basetheme')], 'menu_icon' => 'dashicons-download',];
    }
}