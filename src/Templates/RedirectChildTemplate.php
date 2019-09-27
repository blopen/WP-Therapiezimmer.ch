<?php

namespace Cubetech\Templates;

use Cubetech\Controller\NavigationController;

/**
 * Template class for the redirect child template
 *
 * @author Steeve Jeannin <steeve@cubetech.ch>
 * @since Version 1.0
 */
class RedirectChildTemplate extends BaseTemplate
{
    
    public function __construct()
    {
        $navigation = NavigationController::getNavigation('primary');
        foreach ($navigation->menuItems as $menu) {
            if ($menu->objectId === get_the_id() && $menu->hasChildren) {
                if ( !empty($menu->children[0]->url)) {
                    wp_redirect($menu->children[0]->url);
                    exit;
                }
            }
        }
        
        // No children found: 404 !
        global $wp_query;
        $wp_query->set_404();
        status_header(404);
        get_template_part(404);
        exit();
    }
}