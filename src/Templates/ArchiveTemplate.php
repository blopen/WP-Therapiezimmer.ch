<?php

namespace Cubetech\Templates;

use \Cubetech\Base\BaseHeader;
use \Cubetech\Base\CubetechPost;
use \Cubetech\Sidebars\ArchiveSidebar;
use \Cubetech\Partials\FilterablePostList;
use Cubetech\Rendering\TemplatePart;
use Cubetech\TemplateLogic\HeaderLogic;

/**
 * Template class for the index.php template
 *
 * @author Alex Scherer <alex.scherer@cubetech.ch>
 * @since Version 1.0
 */
class ArchiveTemplate extends BaseTemplate
{
    
    private $post;
    
    public function __construct()
    {
        parent::__construct('Archive');
        $this->post = new CubetechPost(get_the_id());
        
        $header = new TemplatePart('headers/default-header', new HeaderLogic());
        $this->headerList->append($header);
        
        if ($this->post->isFieldValid('posttype')) {
            $posttype = $this->post->getField('posttype');
        }
        else {
            $posttype = 'post';
        }
        $filterableList = new FilterablePostList($posttype);
        $this->contentList->append($filterableList);
    }
}
