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
                'name' =>               _x('Songkategorie', 'General name', 'wptheme-ditzler'),
                'singular_name' =>      _x('Songkategorie', 'Singular name', 'wptheme-ditzler'),
                'menu_name' =>          _x('Songkategorien', 'Menu name', 'wptheme-ditzler'),
                'parent_item_colon' =>  _x('Übergeordnete Songkategorie', 'Parent item with colon', 'wptheme-ditzler'),
                'all_items' =>          _x('Alle Songkategorien', 'All items', 'wptheme-ditzler'),
                'view_item' =>          _x('Songkategorie ansehen', 'View item', 'wptheme-ditzler'),
                'add_new_item' =>       _x('Songkategorie hinzufügen', 'Add new item', 'wptheme-ditzler'),
                'add_new' =>            _x('Songkategorie hinzufügen', 'Add new', 'wptheme-ditzler'),
                'edit_item' =>          _x('Songkategorie bearbeiten', 'Edit item', 'wptheme-ditzler'),
                'update_item' =>        _x('Songkategorie aktualisieren', 'Update item', 'wptheme-ditzler'),
                'search_items' =>       _x('Songkategorie suchen', 'Search items', 'wptheme-ditzler'),
                'not_found' =>          _x('Keine Songkategorie gefunden.', 'Not found', 'wptheme-ditzler'),
                'not_found_in_trash' => _x('Keine Songkategorie im Papierkorb gefunden.', 'Not found in trash', 'wptheme-ditzler'),
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
                'name' =>               _x('Genre', 'General name', 'wptheme-ditzler'),
                'singular_name' =>      _x('Genre', 'Singular name', 'wptheme-ditzler'),
                'menu_name' =>          _x('Genre', 'Menu name', 'wptheme-ditzler'),
                'parent_item_colon' =>  _x('Übergeordnete Genre', 'Parent item with colon', 'wptheme-ditzler'),
                'all_items' =>          _x('Alle Genre', 'All items', 'wptheme-ditzler'),
                'view_item' =>          _x('Genre ansehen', 'View item', 'wptheme-ditzler'),
                'add_new_item' =>       _x('Genre hinzufügen', 'Add new item', 'wptheme-ditzler'),
                'add_new' =>            _x('Genre hinzufügen', 'Add new', 'wptheme-ditzler'),
                'edit_item' =>          _x('Genre bearbeiten', 'Edit item', 'wptheme-ditzler'),
                'update_item' =>        _x('Genre aktualisieren', 'Update item', 'wptheme-ditzler'),
                'search_items' =>       _x('Genre suchen', 'Search items', 'wptheme-ditzler'),
                'not_found' =>          _x('Keine Genre gefunden.', 'Not found', 'wptheme-ditzler'),
                'not_found_in_trash' => _x('Keine Genre im Papierkorb gefunden.', 'Not found in trash', 'wptheme-ditzler'),
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
        return 'song';
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
            'name'               => _x('Songs', 'General name', 'wptheme-ditzler'),
            'singular_name'      => _x('Song', 'Singular name', 'wptheme-ditzler'),
            'menu_name'          => _x('Songs', 'Menu name', 'wptheme-ditzler'),
            'parent_item_colon'  => _x('Übergeordnetes Song:', 'Parent item with colon', 'wptheme-ditzler'),
            'all_items'          => _x('Alle Songs anzeigen', 'All items', 'wptheme-ditzler'),
            'view_item'          => _x('Song anzeigen', 'View item', 'wptheme-ditzler'),
            'add_new_item'       => _x('Song hinzufügen', 'Add new item', 'wptheme-ditzler'),
            'add_new'            => _x('Song hinzufügen', 'Add new', 'wptheme-ditzler'),
            'edit_item'          => _x('Song bearbeiten', 'Edit item', 'wptheme-ditzler'),
            'update_item'        => _x('Song aktualisieren', 'Update item', 'wptheme-ditzler'),
            'search_items'       => _x('Songs suchen', 'Search items', 'wptheme-ditzler'),
            'not_found'          => _x('Keine Songs gefunden.', 'Not found', 'wptheme-ditzler'),
            'not_found_in_trash' => _x('Keine Songs im Papierkorb gefunden.', 'Not found in trash', 'wptheme-ditzler')
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
            'description'         => _x('song items', 'Description', 'wptheme-ditzler'),
            'supports'            => ['title'],
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'post',
            'map_meta_cap'        => true,
            'rewrite'             => ['slug' => _x('songs', 'Slug for posttype song', 'wptheme-ditzler')],
            'menu_icon'           => 'dashicons-controls-volumeon',
        ];
    }
}