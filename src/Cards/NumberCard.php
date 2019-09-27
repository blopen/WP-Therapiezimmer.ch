<?php

namespace Cubetech\Cards;

/**
 * Class for handling NumberCards for the PageBuilder
 *
 * @author Alex Scherer <alex.scherer@cubetech.ch>
 * @since 1.0.0
 * @version 1.0.0
 */
class NumberCard extends BaseCard
{
    /**
     * Initializes class properties
     *
     * @param int $postId
     * @param string $title
     * @param string $subtitle
     * @return void
     *
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @version 1.0.0
     * @since Version 1.0.0
     */
    public function __construct($postId, $title, $subtitle)
    {
        parent::__construct("NumberCard", $postId);
        $this->title = $title;
        $this->subtitle = $subtitle;
    }
}