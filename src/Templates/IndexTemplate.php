<?php

namespace Cubetech\Templates;

use \Cubetech\Base\BaseHeader;
use \Cubetech\Rendering\TemplatePart;
use Cubetech\TemplateLogic\HeaderLogic;
use Cubetech\TemplateLogic\PostListLogic;

/**
 * Template class for the index.php template
 *
 * @author Alex Scherer <alex.scherer@cubetech.ch>
 * @since 1.0.0
 * @version 1.0.0
 */
class IndexTemplate extends BaseTemplate
{
    public function __construct()
    {
        parent::__construct('Index');
        $content = new TemplatePart('post-list', new PostListLogic());
        
        $this->primaryPostId = get_option('page_for_posts');
        $this->contentList->append($content);
    }
}