<?php

namespace Cubetech\Templates;

use \Cubetech\Rendering\TemplatePart;

/**
 * Template class for the 404.php template
 *
 * @author Alex Scherer <alex.scherer@cubetech.ch>
 * @author Marc Mentha <marc@cubetech.ch>
 * @since 1.0.0
 * @version 1.0.0
 */
class NotFoundTemplate extends BaseTemplate
{
    
    /**
     * Initializes all needed elements for this template
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public function __construct()
    {
        parent::__construct('NotFound');
        $this->contentList->append(new TemplatePart('404'));
    }
}