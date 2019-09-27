<?php

namespace Cubetech;

use \Cubetech\Base\CubetechPost;
use \Cubetech\Helpers\RestrictionHandler;
use \Cubetech\Controller\ActionController;
use \Cubetech\Controller\StyleController;
use \Cubetech\Controller\ScriptController;
use \Cubetech\Controller\NavigationController;
use \Cubetech\Controller\ThemeController;
use \Cubetech\Controller\PosttypeController;
use \Cubetech\Controller\SidebarController;
use \Cubetech\Controller\PackageController;
use \Cubetech\Controller\ImageController;

/**
 * Base class for the Theme
 *
 * Sets up everything needed for the theme to function
 * i.e. views, components, navigations etc.
 *
 * @author Alex Scherer <alex.scherer@cubetech.ch>
 * @author Marc Mentha <marc@cubetech.ch>
 * @since Version 1.1.0
 */
class Theme
{
    /**
     * Calls every controllers addAction method
     *
     * @return void
     *
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.0.0
     * @version 2.0.0
     */
    public function initialize()
    {
        ThemeController::addActions();
        StyleController::addActions();
        ScriptController::addActions();
        PosttypeController::addActions();
        NavigationController::addActions();
        SidebarController::addActions();
        PackageController::addActions();
        ImageController::addActions();
        RestrictionHandler::hideAdminBarForNoBackendUser();
    }
    
    /**
     * Get Cubetech Posts from given arguments
     *
     * @param array $args
     * @return array <CubetechPost>
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public static function getPosts($args)
    {
        $posts = get_posts($args);
        $results = [];
        foreach ($posts as $post) {
            $results[] = new CubetechPost($post);
        }
        return $results;
    }
}
