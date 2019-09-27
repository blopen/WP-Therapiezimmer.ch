<?php

namespace Cubetech\PageBuilder\Components;

use \Cubetech\Base\Media;

/**
 * Image component class for pagebuilder
 *
 * @author Marc Mentha <marc@cubetech.ch>
 * @author Alex Scherer <alex.scherer@cubetech.ch>
 * @version 1.0.0
 * @since 1.0.0
 */
class ImageComponent extends BaseComponent
{
    
    /**
     * Text of this component
     * Generated from ACF WYSIWYG field
     *
     * @var string
     */
    protected $image;
    
    protected $caption;
    
    protected $optionalAltText;
    
    protected $hasPadding;
    
    /**
     * Constructor method for this component
     * Initializes the image
     *
     * @param int $postId
     * @param int $index
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.0.0
     */
    public function __construct($postId, $index, $containerClass)
    {
        parent::__construct('Image', $postId, $index, $containerClass);
        $imageId = $this->getComponentField('image');
        $this->image = $imageId ? new Media((int)$imageId) : false;
        
        $this->caption = $this->getComponentField('image_description');
        $this->optionalAltText = $this->getComponentField('alt_text_optional');
        $this->hasPadding = $this->getComponentField('offset');
    }
    
    /**
     * Validates the component for this particular component
     * only the image property is needed
     *
     * @return boolean
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.0.0
     */
    public function isValid()
    {
        return !empty($this->image);
    }
}