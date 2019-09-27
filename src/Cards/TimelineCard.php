<?php

namespace Cubetech\Cards;

/**
 * Class for a History card handling
 *
 * @author Steeve Jeannin <steeve@cubetech.ch>
 * @since 1.0.0
 * @version 1.0.0
 */
class TimelineCard extends BaseCard
{
    /**
     * Initializes class properties
     *
     * @param CubetechPost $post
     * @return void
     *
     * @author Steeve Jeannin <steeve@cubetech.ch>
     * @version 1.0.0
     * @since Version 1.0.0
     */
    public function __construct($postId, $timeline)
    {
        parent::__construct("TimelineCard", $postId);
        $this->year = $timeline->timeline_year;
        $this->title = $timeline->timeline_title;
        $this->description = $timeline->timeline_description;
    }
}