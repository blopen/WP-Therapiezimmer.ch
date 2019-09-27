<?php

namespace Cubetech\PageBuilder\Components;

use \Cubetech\Base\Media;

/**
 * Video component class for pagebuilder
 *
 * @author Marc Mentha <marc@cubetech.ch>
 * @author Alex Scherer <alex.scherer@cubetech.ch>
 * @version 1.0.0
 * @since 1.0.0
 */
class VideoComponent extends BaseComponent
{
    
    /**
     * Text of this component
     * Generated from ACF WYSIWYG field
     *
     * @var string
     */
    protected $video;
    
    /**
     * Constructor method for this component
     * Initializes the video
     *
     * @param int $postId
     * @param int $index
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.0.0
     */
    public function __construct($postId, $index, $containerClass)
    {
        parent::__construct('Video', $postId, $index, $containerClass);
        $videoId = $this->getComponentField('video');
        $this->video = $videoId ? new Media((int)$videoId) : false;
        $overlayId = $this->getComponentField('overlay_image');
        $this->overlay = $overlayId ? new Media((int)$overlayId) : false;
        $this->videoId = uniqid();
    }
    
    /**
     * Validates the component for this particular component
     * only the video property is needed
     *
     * @return boolean
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.0.0
     */
    public function isValid()
    {
        return !empty($this->video);
    }
}