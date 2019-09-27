<?php

namespace Cubetech\Templates;

use \Cubetech\Base\BaseHeader;
use \Cubetech\Base\CubetechPost;
use \Cubetech\Cards\SearchCard;
use \Cubetech\Rendering\TemplatePart;
use \Cubetech\Helpers\RestrictionHandler;
use Cubetech\TemplateLogic\HeaderLogic;

/**
 * Template class for the default page template
 *
 * @author Marc Mentha <marc@cubetech.ch>
 * @since 1.0.0
 * @version 1.0.0
 */
class SearchTemplate extends BaseTemplate
{
    
    public function __construct()
    {
        parent::__construct('Search');
        
        $header = new TemplatePart('headers/search-header', new HeaderLogic());
        $this->headerList->append($header);
        
        $this->contentList->append(new TemplatePart('search-results'));
    }
    
    
    public static function createSearchResults()
    {
        if ( !have_posts()) {
            return false;
        }
        
        $results = [];
        $user = wp_get_current_user();
        while (have_posts()) {
            the_post();
            $ctPost = new CubetechPost(get_post());
        }
        return $results;
    }
}
