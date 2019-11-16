<?php

namespace Cubetech\Templates;

use \Cubetech\Base\BaseHeader;
use \Cubetech\Base\CubetechPost;
use \Cubetech\Rendering\TemplatePart;
use Cubetech\TemplateLogic\HeaderLogic;

/**
 * Template class for the default page template
 *
 * @author Marc Mentha <marc@cubetech.ch>
 * @since 1.0.0
 * @version 1.0.0
 */
class PageTemplate extends BaseTemplate
{
    
    public function __construct()
    {
        parent::__construct('Page');
        $header = new TemplatePart('headers/default-header', new HeaderLogic());
        $this->headerList->append($header);
        $this->contentList->append(new TemplatePart('default-page-content'));
        //
        var_dump(99);
        die();
    }
}