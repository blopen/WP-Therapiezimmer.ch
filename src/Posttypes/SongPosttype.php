<?php
namespace Cubetech\Posttypes;
/**
 * Adds the custom posttype "songs" to WordPress
 *
 * @author Nelson Lopez <nelson.lopez@cubetech.ch>
 * @since 1.0.0
 * @version 1.0.0
 */
class SongPosttype extends APosttype
{
    /**
     * Adds all actions for this custom posttype
     *
     * @return void
     *
     * @author Nelson Lopez <nelson.lopez@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public static function initialize()
    {
        add_action('init', __CLASS__ . '::registerPostType');
        add_action('init',  __CLASS__ . '::registerTaxonomy');
    }
    /**
     * Registers the taxonomy
     *
     * @return void
     *
     * @author Nelson Lopez <nelson.lopez@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public static function registerTaxonomy()
    {
        $args = [
            'hierarchical' => true,
            'labels' => [
                'name' =>               _x('Songkategorie', 'General name', 'wptheme-therapiezimmer'),
                'singular_name' =>      _x('Songkategorie', 'Singular name', 'wptheme-therapiezimmer'),
                'menu_name' =>          _x('Songkategorien', 'Menu name', 'wptheme-therapiezimmer'),
                'parent_item_colon' =>  _x('Übergeordnete Songkategorie', 'Parent item with colon', 'wptheme-therapiezimmer'),
                'all_items' =>          _x('Alle Songkategorien', 'All items', 'wptheme-therapiezimmer'),
                'view_item' =>          _x('Songkategorie ansehen', 'View item', 'wptheme-therapiezimmer'),
                'add_new_item' =>       _x('Songkategorie hinzufügen', 'Add new item', 'wptheme-therapiezimmer'),
                'add_new' =>            _x('Songkategorie hinzufügen', 'Add new', 'wptheme-therapiezimmer'),
                'edit_item' =>          _x('Songkategorie bearbeiten', 'Edit item', 'wptheme-therapiezimmer'),
                'update_item' =>        _x('Songkategorie aktualisieren', 'Update item', 'wptheme-therapiezimmer'),
                'search_items' =>       _x('Songkategorie suchen', 'Search items', 'wptheme-therapiezimmer'),
                'not_found' =>          _x('Keine Songkategorie gefunden.', 'Not found', 'wptheme-therapiezimmer'),
                'not_found_in_trash' => _x('Keine Songkategorie im Papierkorb gefunden.', 'Not found in trash', 'wptheme-therapiezimmer'),
            ],
            'public' =>             true,
            'show_ui' =>            true,
            'show_admin_column' =>  true,
            'query_var' =>          true,
            'rewrite' =>            ['slug' => 'song-category'],
        ];
        register_taxonomy('song-category', ['song'], $args);
        $args = [
            'hierarchical' => true,
            'labels' => [
                'name' =>               _x('Genre', 'General name', 'wptheme-therapiezimmer'),
                'singular_name' =>      _x('Genre', 'Singular name', 'wptheme-therapiezimmer'),
                'menu_name' =>          _x('Genre', 'Menu name', 'wptheme-therapiezimmer'),
                'parent_item_colon' =>  _x('Übergeordnete Genre', 'Parent item with colon', 'wptheme-therapiezimmer'),
                'all_items' =>          _x('Alle Genre', 'All items', 'wptheme-therapiezimmer'),
                'view_item' =>          _x('Genre ansehen', 'View item', 'wptheme-therapiezimmer'),
                'add_new_item' =>       _x('Genre hinzufügen', 'Add new item', 'wptheme-therapiezimmer'),
                'add_new' =>            _x('Genre hinzufügen', 'Add new', 'wptheme-therapiezimmer'),
                'edit_item' =>          _x('Genre bearbeiten', 'Edit item', 'wptheme-therapiezimmer'),
                'update_item' =>        _x('Genre aktualisieren', 'Update item', 'wptheme-therapiezimmer'),
                'search_items' =>       _x('Genre suchen', 'Search items', 'wptheme-therapiezimmer'),
                'not_found' =>          _x('Keine Genre gefunden.', 'Not found', 'wptheme-therapiezimmer'),
                'not_found_in_trash' => _x('Keine Genre im Papierkorb gefunden.', 'Not found in trash', 'wptheme-therapiezimmer'),
            ],
            'public' =>             true,
            'show_ui' =>            true,
            'show_admin_column' =>  true,
            'query_var' =>          true,
            'rewrite' =>            ['slug' => 'Genre-category'],
        ];
        register_taxonomy('Genre-category', ['song'], $args);
    }
    /**
     * Returns the posttype
     *
     * @return string
     *
     * @author Nelson Lopez <nelson.lopez@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public static function getType()
    {
        return 'Song';
    }
    /**
     * Returns all labels
     *
     * @return array
     *
     * @author Nelson Lopez <nelson.lopez@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public static function getLabels()
    {
        return [
            'name'               => _x('Songs', 'General name', 'wptheme-therapiezimmer'),
            'singular_name'      => _x('Song', 'Singular name', 'wptheme-therapiezimmer'),
            'menu_name'          => _x('Songs', 'Menu name', 'wptheme-therapiezimmer'),
            'parent_item_colon'  => _x('Übergeordnetes Song:', 'Parent item with colon', 'wptheme-therapiezimmer'),
            'all_items'          => _x('Alle Songs anzeigen', 'All items', 'wptheme-therapiezimmer'),
            'view_item'          => _x('Song anzeigen', 'View item', 'wptheme-therapiezimmer'),
            'add_new_item'       => _x('Song hinzufügen', 'Add new item', 'wptheme-therapiezimmer'),
            'add_new'            => _x('Song hinzufügen', 'Add new', 'wptheme-therapiezimmer'),
            'edit_item'          => _x('Song bearbeiten', 'Edit item', 'wptheme-therapiezimmer'),
            'update_item'        => _x('Song aktualisieren', 'Update item', 'wptheme-therapiezimmer'),
            'search_items'       => _x('Songs suchen', 'Search items', 'wptheme-therapiezimmer'),
            'not_found'          => _x('Keine Songs gefunden.', 'Not found', 'wptheme-therapiezimmer'),
            'not_found_in_trash' => _x('Keine Songs im Papierkorb gefunden.', 'Not found in trash', 'wptheme-therapiezimmer')
        ];
    }
    /**
     * Returns all Arguments
     *
     * @return array
     *
     * @author Nelson Lopez <nelson.lopez@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public static function getArguments()
    {
        return [
            'labels'              => self::getLabels(),
            'description'         => _x('song items', 'Description', 'wptheme-therapiezimmer'),
            'supports'            => [
                'title',
                'editor',
                'thumbnail',
            ],
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'can_export'          => true,
            'has_archive'         => false,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'post',
            'map_meta_cap'        => true,
            'rewrite'             => ['slug' => _x('song', 'Slug for posttype song', 'wptheme-therapiezimmer')],
            'menu_icon'           => 'dashicons-controls-volumeon',
        ];
    }
}