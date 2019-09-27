<?php

namespace Cubetech\Cards;

/**
 * Class for an unified card handling can
 * Cards can extend fro mthis class to apply this functionality
 *
 * @author Marc Mentha <marc@cubetech.ch>
 * @since 0.0.1
 * @version 1.0.0
 */
class StandardCard extends BaseCard
{
    /**
     * Initializes class properties
     *
     * @param CubetechPost $post
     * @return void
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @version 1.0.0
     * @since 1.0.0
     */
    public function __construct($postId)
    {
        parent::__construct("StandardCard", $postId);
        $this->title = $this->extractTitle();
        $this->lead = $this->extractLead();
        $this->link = $this->post->getLink();
    }
}