# Posttypes

This directory is for the custom post types.

## Eample code

```php
<?php

namespace Cubetech\PostTypes;

use \Cubetech\Base\CubetechPost;

/**
 * Registers a custom posttype to WordPress' backend
 *
 * In preparation of possible exports to plugins this template
 * provides filters to modify lables and arguments via filters
 * Labels and arguments are editable through filters:
 * - cubetech/posttype/POSTTYPE_NAME/arguments
 * - cubetech/posttype/POSTTYPE_NAME/labels
 *
 * @author Marc mentha <marc@cubetech.ch>
 * @since 1.0.0
 * @version 1.0.0
 */
class #REPLACE#PostType
{
    const POSTTYPE_NAME = '#REPLACE#';

    /**
     * Initializes the custom posttype if not exists
     *
     * @return void
     *
     * @uses post_type_exists from WordPress core
     * @uses add_action from WordPress core
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public function initialize()
    {
        if (!post_type_exists(self::POSTTYPE_NAME)) {
            add_action('init', [$this,'registerPostType']);
        } else {
            if (defined('WP_DEBUG') && WP_DEBUG || defined('WP_DEBUG_LOG') && WP_DEBUG_LOG ) {
                error_log('posttype ' self:POSTTYPE_NAME .' has already been registered');
            }
        }
    }

    /**
     * registers the custom posttype
     *
     * @return void
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since version 1.0
     * @uses register_post_type from WordPress core
     */
    public function registerPostType()
    {
        $arguments = $this->getArguments();
        register_post_type(self::POSTTYPE_NAME, $arguments);
    }

    /**
     * Returns the arguments for registering the posttype
     *
     * @return mixed arguments
     *
     * @uses apply_filters from WordPress core
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    private function getArguments()
    {
        return apply_filters('cubetech/posttype/'.self::POSTTYPE_NAME.'/arguments',
            [
                'labels'              => $this->getLabels(),
                'description'         => _x('Glossar', 'Description', 'wptheme-basetheme'),
                'supports'            => ['title'],
                'hierarchical'        => false,
                'public'              => true,
                'show_ui'             => true,
                'show_in_menu'        => true,
                'show_in_nav_menus'   => false,
                'show_in_admin_bar'   => true,
                'can_export'          => true,
                'has_archive'         => true,
                'exclude_from_search' => true,
                'publicly_queryable'  => false,
                'capability_type'     => 'post',
                'map_meta_cap'        => true,
                'rewrite'             => ['slug' => _x('glossary', 'Slug for posttype glossary', 'wptheme-basetheme')],
                'menu_icon'           => 'dashicons-book',
        ]);
    }

    /**
     * Returns the labels for registering the custom posttype
     *
     * @return mixed labels
     *
     * @uses apply_filters from WordPress core
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    private function getLabels()
    {
        return apply_filters('cubetech/posttype/'.self::POSTTYPE_NAME.'/labels',
            [
                'name'               => _x('Glossar', 'General name', 'wptheme-basetheme'),
                'singular_name'      => _x('Glossareintrag', 'Singular name', 'wptheme-basetheme'),
                'menu_name'          => _x('Glossar', 'Menu name', 'wptheme-basetheme'),
                'parent_item_colon'  => _x('Übergeordneter Glossareintrag', 'Parent item with colon', 'wptheme-basetheme'),
                'all_items'          => _x('Alle Glossareinträge anzeigen', 'All items', 'wptheme-basetheme'),
                'view_item'          => _x('Glossareintrag anzeigen', 'View item', 'wptheme-basetheme'),
                'add_new_item'       => _x('Neuer Glossareintrag', 'Add new item', 'wptheme-basetheme'),
                'add_new'            => _x('Neuer Glossareintrag', 'Add new', 'wptheme-basetheme'),
                'edit_item'          => _x('Glossareintrag bearbeiten', 'Edit item', 'wptheme-basetheme'),
                'update_item'        => _x('Glossareintrag aktualisieren', 'Update item', 'wptheme-basetheme'),
                'search_items'       => _x('Glossareintrag suchen', 'Search items', 'wptheme-basetheme'),
                'not_found'          => _x('Kein Glossareintrag gefunden.', 'Not found', 'wptheme-basetheme'),
                'not_found_in_trash' => _x('Kein Glossareintrag im Papierkorb gefunden.', 'Not found in trash', 'wptheme-basetheme'),
        ]);
    }
}
```