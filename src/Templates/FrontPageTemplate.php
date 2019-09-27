<?php

namespace Cubetech\Templates;

use \Cubetech\Rendering\TemplatePart;
use Cubetech\TemplateLogic\HeaderLogic;
use Cubetech\TemplateLogic\FrontPageLogic;

/**
 * Template class for the front page
 *
 * @author Marc Mentha <marc@cubetech.ch>
 * @since 1.0.0
 * @version 1.0.0
 */
class FrontPageTemplate extends BaseTemplate
{
    
    public function __construct()
    {
        parent::__construct('FrontPage');
        $header = new TemplatePart('headers/front-page-header', new HeaderLogic());
        $content = new TemplatePart('contents/front-page-content', new FrontPageLogic());
        

        $this->headerList->append($header);
        $this->contentList->append($content);
        
    }
    
}
