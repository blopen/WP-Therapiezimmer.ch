<?php

namespace Cubetech\Cards;

/**
 * Class for an Cong card handling
 *
 * @author Steeve Jeannin <steeve@cubetech.ch>
 * @since 0.0.1
 * @version 1.0.0
 */
class SongCard extends BaseCard
{
    /**
     * Initializes class properties
     *
     * @param CubetechPost $post
     * @return void
     *
     * @author Steeve Jeannin <steeve@cubetech.ch>
     * @version 1.0.0
     * @since 1.0.0
     */

    public function __construct($postId)
    {
        parent::__construct("SongCard", $postId);
        $post = new \Cubetech\Base\CubetechPost($postId);
        $this->title = $this->extractTitle();
        $this->imageId = intval($this->extractImage());
        $this->imageURL = $this->imageId ? wp_get_attachment_url($this->imageId) : "";
        $this->function = $this->extractSimpleString("title");
        $this->email = $this->extractSimpleString("email");
        $this->phone = $this->extractSimpleString("phone");
        $this->url = $post->getLink();
        $this->socialMediaAccounts = $this->post->getRepeaterField("social_medias", ["social_media_link"]);
    }
    
    /**
     * Checks if the optional image is set
     * Defaults to false if empty
     *
     * @return string|false
     * @version 1.0.0
     * @since 1.0.0
     * @author Steeve Jeannin <steeve@cubetech.ch>
     */
    private function extractImage()
    {
        if ($this->post->isFieldValid('image')) {
            return $this->post->getField('image');
        }
        return false;
    }
    
    /**
     * Checks if any optional string field (simpleline, email, url, ...) is set
     * Defaults to empty if empty
     *
     * @return string
     * @version 1.0.0
     * @since 1.0.0
     * @author Steeve Jeannin <steeve@cubetech.ch>
     */
    private function extractSimpleString($elementId)
    {
        if ($this->post->isFieldValid($elementId)) {
            return $this->post->getField($elementId);
        }
        return "";
    }
}
