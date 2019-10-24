<?php

namespace Cubetech\Templates;

use \Cubetech\Rendering\TemplatePart;
use \Cubetech\PageBuilder\PageBuilder;
use Cubetech\TemplateLogic\SidebarLogic;
use Cubetech\TemplateLogic\HeaderLogic;

/**
 * Template class for the page builder template
 *
 * @author Alex Scherer <alex.scherer@cubetech.ch>
 * @since 1.0.0
 * @version 1.0.0
 */
class PageBuilderTemplate extends BaseTemplate
{
    
    private $post;
    
    public function __construct()
    {
        parent::__construct('PageBuilder');
        $header = new TemplatePart('headers/default-header', new HeaderLogic());
        $this->headerList->append($header);
        
        if ($this->hasSidebar) {
            $sidebar = new TemplatePart('sidebars/default-sidebar', new SidebarLogic($this->menuItems));
            $this->sidebarList->append($sidebar);
        }
        
        $this->contentList->append(new TemplatePart('lead'));
        $this->contentList->append(new PageBuilder($this->primaryPostId));
    }
}