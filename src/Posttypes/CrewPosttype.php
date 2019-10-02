<?php

namespace Cubetech\Posttypes;

/**
 * Adds the custom posttype "Crew" to WordPress
 *
 * @author Marc Mentha <marc@cubetech.ch>
 * @since 1.0.0
 * @version 1.0.0
 */
class CrewPosttype extends APosttype
{
    /**
     * Adds all actions for this posttype
     *
     * @return void
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public static function initialize()
    {
        add_action('init', __CLASS__ . '::registerPostType');
    }
    
    /**
     * Adds all actions for this posttype
     *
     * @return void
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public static function getType()
    {
        return 'Crew';
    }
    
    /**
     * Adds all labels
     *
     * @return void
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public static function getLabels()
    {
        return [
            'name'               => _x('Crew', 'General name', 'wptheme-basetheme'),
            'singular_name'      => _x('Crewmitglied', 'Singular name', 'wptheme-basetheme'),
            'menu_name'          => _x('Crew', 'Menu name', 'wptheme-basetheme'),
            'parent_item_colon'  => _x('Übergeordnetes Crewmitglied', 'Parent item with colon', 'wptheme-basetheme'),
            'all_items'          => _x('Alle Crewmitglieder anzeigen', 'All items', 'wptheme-basetheme'),
            'view_item'          => _x('Crewmitglied anzeigen', 'View item', 'wptheme-basetheme'),
            'add_new_item'       => _x('Crewmitglied hinzufügen', 'Add new item', 'wptheme-basetheme'),
            'add_new'            => _x('mitglied hinzufügen', 'Add new', 'wptheme-basetheme'),
            'edit_item'          => _x('Crewmitglied bearbeiten', 'Edit item', 'wptheme-basetheme'),
            'update_item'        => _x('Crewmitglied aktualisieren', 'Update item', 'wptheme-basetheme'),
            'search_items'       => _x('Crewmitglied suchen', 'Search items', 'wptheme-basetheme'),
            'not_found'          => _x('Keine Crewmitglied gefunden.', 'Not found', 'wptheme-basetheme'),
            'not_found_in_trash' => _x('Keine Crewmitglied im Papierkorb gefunden.', 'Not found in trash', 'wptheme-basetheme'),
        ];
    }
    
    /**
     * Adds all arguments
     *
     * @return void
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public static function getArguments()
    {
        return [
            'labels'              => self::getLabels(),
            'description'         => _x('Crewmitglieder Informationen', 'Description', 'wptheme-basetheme'),
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
            'publicly_queryable'  => false,
            'capability_type'     => 'post',
            'map_meta_cap'        => true,
            'rewrite'             => ['slug' => _x('mitarbeiter', 'Slug for posttype mitarbeiter', 'wptheme-basetheme')],
            'menu_icon'           => 'dashicons-groups',
        ];
    }
}