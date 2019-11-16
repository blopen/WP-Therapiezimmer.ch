<?php

namespace Cubetech\Templates;

use \Cubetech\Base\CubetechPost;
use \Cubetech\Rendering\TemplatePart;
use \Cubetech\PageBuilder\PageBuilder;
use Cubetech\TemplateLogic\HeaderLogic;

/**
 * Template class for the SinglePage template
 *
 * @author Steeve Jeannin <steeve@cubetech.ch>
 * @since 1.0.0
 * @version 1.0.0
 */
class SingleTemplate extends BaseTemplate
{
    /**
     * Constructor method is special for this template
     *
     * if the post has a pagebuidler, it will be rendered
     * if not, then the default content will be rendered
     */
    public function __construct()
    {
        $post = new CubetechPost(get_the_id());
        $header = new TemplatePart('headers/default-header', new HeaderLogic());
        $posttype = $post->getPosttype();

        
        if ($post->getField('pagebuilder')) {
            parent::__construct('PageBuilder');
        }
        else if ($posttype != "post") {
            
            var_dump(parent::__construct(ucfirst($posttype)));
         //   var_dump($this);
        }
        else {
            parent::__construct('Page');

        }
        
        $this->headerList->append($header);
        
        if ($post->getField('pagebuilder')) {
            $this->contentList->append(new PageBuilder($this->primaryPostId));

        }
        else if ($post->getPosttype() != "post") {
            
            $this->contentList->append(new TemplatePart($posttype.'-page-content'));
        }
        else {
            $this->contentList->append(new TemplatePart('default-page-content'));

        }
    }
}