<?php
namespace Cubetech\Posttypes;
/**
 * Adds the custom posttype "documents" to WordPress
 *
 * @author Nelson Lopez <nelson.lopez@cubetech.ch>
 * @since 1.0.0
 * @version 1.0.0
 */
class DocumentPosttype extends APosttype
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
                'name' =>               _x('Dokuemntphase', 'General name', 'wptheme-ipa'),
                'singular_name' =>      _x('Dokuemntphase', 'Singular name', 'wptheme-ipa'),
                'menu_name' =>          _x('Dokuemntphasen', 'Menu name', 'wptheme-ipa'),
                'parent_item_colon' =>  _x('Übergeordnete Dokuemntphase', 'Parent item with colon', 'wptheme-ipa'),
                'all_items' =>          _x('Alle Dokuemntphasen', 'All items', 'wptheme-ipa'),
                'view_item' =>          _x('Dokuemntphase ansehen', 'View item', 'wptheme-ipa'),
                'add_new_item' =>       _x('Dokuemntphase hinzufügen', 'Add new item', 'wptheme-ipa'),
                'add_new' =>            _x('Dokuemntphase hinzufügen', 'Add new', 'wptheme-ipa'),
                'edit_item' =>          _x('Dokuemntphase bearbeiten', 'Edit item', 'wptheme-ipa'),
                'update_item' =>        _x('Dokuemntphase aktualisieren', 'Update item', 'wptheme-ipa'),
                'search_items' =>       _x('Dokuemntphase suchen', 'Search items', 'wptheme-ipa'),
                'not_found' =>          _x('Keine Dokuemntphase gefunden.', 'Not found', 'wptheme-ipa'),
                'not_found_in_trash' => _x('Keine Dokuemntphase im Papierkorb gefunden.', 'Not found in trash', 'wptheme-ipa'),
            ],
            'public' =>             true,
            'show_ui' =>            true,
            'show_admin_column' =>  true,
            'query_var' =>          true,
            'rewrite' =>            ['slug' => 'document-category'],
        ];
        register_taxonomy('document-category', ['document'], $args);
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
        return 'Document';
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
            'name'               => _x('Dokumente', 'General name', 'wptheme-ipa'),
            'singular_name'      => _x('Dokuemnt', 'Singular name', 'wptheme-ipa'),
            'menu_name'          => _x('Dokumente', 'Menu name', 'wptheme-ipa'),
            'parent_item_colon'  => _x('Übergeordnetes Dokuemnt:', 'Parent item with colon', 'wptheme-ipa'),
            'all_items'          => _x('Alle Dokumente anzeigen', 'All items', 'wptheme-ipa'),
            'view_item'          => _x('Dokuemnt anzeigen', 'View item', 'wptheme-ipa'),
            'add_new_item'       => _x('Dokuemnt hinzufügen', 'Add new item', 'wptheme-ipa'),
            'add_new'            => _x('Dokuemnt hinzufügen', 'Add new', 'wptheme-ipa'),
            'edit_item'          => _x('Dokuemnt bearbeiten', 'Edit item', 'wptheme-ipa'),
            'update_item'        => _x('Dokuemnt aktualisieren', 'Update item', 'wptheme-ipa'),
            'search_items'       => _x('Dokumente suchen', 'Search items', 'wptheme-ipa'),
            'not_found'          => _x('Keine Dokumente gefunden.', 'Not found', 'wptheme-ipa'),
            'not_found_in_trash' => _x('Keine Dokumente im Papierkorb gefunden.', 'Not found in trash', 'wptheme-ipa')
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
            'description'         => _x('Document items', 'Description', 'wptheme-ipa'),
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
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'post',
            'map_meta_cap'        => true,
            'rewrite'             => ['slug' => _x('document', 'Slug for posttype document', 'wptheme-ipa')],
            'menu_icon'           => 'dashicons-media-text',
        ];
    }
}