<?php

namespace Cubetech\Posttypes;

use \Cubetech\Theme;
use \Cubetech\Cards\EventCard;

/**
 * Adds the custom posttype "Event" to WordPress
 *
 * @author Marc Mentha <marc@cubetech.ch>
 * @since Version 1.0.0
 * @version 1.0.0
 */
class EventPosttype extends APosttype
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
        add_action('added_post_meta', __CLASS__ . '::saveDateAsTimestamp', 10, 4);     // called only on Create
        add_action('updated_post_meta', __CLASS__ . '::saveDateAsTimestamp', 10, 4);   // called only on Update
        
        /**
         * Comment in if needed
         *
         * add_action('init', [$this, 'registerTaxonomy']);
         */
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
        return 'event';
    }
    
    /**
     * Returnsall labels
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
            'name'               => _x('Termine', 'General name', 'wptheme-basetheme'),
            'singular_name'      => _x('Termin', 'Singular name', 'wptheme-basetheme'),
            'menu_name'          => _x('Termine', 'Menu name', 'wptheme-basetheme'),
            'parent_item_colon'  => _x('Übergeordneter Termin', 'Parent item with colon', 'wptheme-basetheme'),
            'all_items'          => _x('Alle Termine anzeigen', 'All items', 'wptheme-basetheme'),
            'view_item'          => _x('Termin anzeigen', 'View item', 'wptheme-basetheme'),
            'add_new_item'       => _x('Termin hinzufügen', 'Add new item', 'wptheme-basetheme'),
            'add_new'            => _x('Termin hinzufügen', 'Add new', 'wptheme-basetheme'),
            'edit_item'          => _x('Termin bearbeiten', 'Edit item', 'wptheme-basetheme'),
            'update_item'        => _x('Termin aktualisieren', 'Update item', 'wptheme-basetheme'),
            'search_items'       => _x('Termine suchen', 'Search items', 'wptheme-basetheme'),
            'not_found'          => _x('Keine Termine gefunden.', 'Not found', 'wptheme-basetheme'),
            'not_found_in_trash' => _x('Keine Termine im Papierkorb gefunden.', 'Not found in trash', 'wptheme-basetheme'),
        ];
    }
    
    /**
     * Returns all arguments
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
            'labels'              => self::getlabels(),
            'description'         => _x('Termin Informationen', 'Description', 'wptheme-basetheme'),
            'supports'            => ['title'],
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
            'rewrite'             => ['slug' => _x('termine', 'Slug for posttype events', 'wptheme-basetheme')],
            'menu_icon'           => 'dashicons-calendar-alt',
        ];
    }
    
    /**
     * Registers the taxonomy
     *
     * @return void
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public function registerTaxonomy()
    {
        $args = [
            'hierarchical'      => true,
            'labels'            => [
                'name'               => _x('Terminekategorie', 'General name', 'wptheme-basetheme'),
                'singular_name'      => _x('Terminekategorie', 'Singular name', 'wptheme-basetheme'),
                'menu_name'          => _x('Terminekategorien', 'Menu name', 'wptheme-basetheme'),
                'parent_item_colon'  => _x('Übergeordnete Terminekategorie', 'Parent item with colon', 'wptheme-basetheme'),
                'all_items'          => _x('Alle Terminekategorien', 'All items', 'wptheme-basetheme'),
                'view_item'          => _x('Terminekategorie ansehen', 'View item', 'wptheme-basetheme'),
                'add_new_item'       => _x('Terminekategorie hinzufügen', 'Add new item', 'wptheme-basetheme'),
                'add_new'            => _x('Terminekategorie hinzufügen', 'Add new', 'wptheme-basetheme'),
                'edit_item'          => _x('Terminekategorie bearbeiten', 'Edit item', 'wptheme-basetheme'),
                'update_item'        => _x('Terminekategorie aktualisieren', 'Update item', 'wptheme-basetheme'),
                'search_items'       => _x('Terminekategorie suchen', 'Search items', 'wptheme-basetheme'),
                'not_found'          => _x('Keine Terminekategorie gefunden.', 'Not found', 'wptheme-basetheme'),
                'not_found_in_trash' => _x('Keine Terminekategorie im Papierkorb gefunden.', 'Not found in trash', 'wptheme-basetheme'),
            ],
            'public'            => false,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => ['slug' => 'event-category'],
        ];
        register_taxonomy('event-category', ['event'], $args);
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
    public static function saveDateAsTimestamp($metaId, $postId, $metaKey, $metaValue)
    {
        if ($metaKey !== 'start_date' && $metaKey !== 'end_date') {
            return false;
        }
        if ($metaKey === 'start_date') {
            $startDateStamp = strtotime($metaValue);
            if ( !add_post_meta($postId, 'start_date_timestamp', $startDateStamp, true)) {
                update_post_meta($postId, 'start_date_timestamp', $startDateStamp);
            }
        }
        if ($metaKey === 'end_date') {
            $endDateStamp = strtotime($metaValue);
            if ( !add_post_meta($postId, 'end_date_timestamp', $endDateStamp, true)) {
                update_post_meta($postId, 'end_date_timestamp', $endDateStamp);
            }
        }
    }
    
    /**
     * Returns a list with upcoming events
     *
     * @return void
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public static function getUpcomingEvents(int $count)
    {
        $today = current_time('timestamp');
        $args = [
            'post_type'      => 'event',
            'posts_per_page' => $count,
            'meta_key'       => 'start_date_timestamp',
            'order'          => 'ASC',
            'orderby'        => 'meta_value',
            'meta_query'     => [
                'relation' => 'OR',
                ['key' => 'start_date_timestamp', 'value' => $today, 'compare' => '>=',],
                ['key' => 'end_date_timestamp', 'value' => $today, 'compare' => '>=',],
            ],
        ];
        $posts = Theme::getPosts($args);
        if ( !empty($posts)) {
            return $posts;
        }
        return false;
    }
    
    /**
     * Get upcoming events as cards
     *
     * @return void
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public static function getUpcomingEventCards(int $count)
    {
        $posts = self::getUpcomingEvents($count);
        if ($posts) {
            $results = [];
            foreach ($posts as $post) {
                $results[] = new EventCard($post->getId());
            }
            return $results;
        }
        return false;
    }
}