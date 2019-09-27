<?php

namespace Cubetech\Cards;

/**
 * Class for displaying an Event
 *
 * @author Marc Mentha <marc@cubetech.ch>
 * @since 0.0.1
 * @version 1.0.0
 */
class EventCard extends BaseCard
{
    
    /**
     * Initializes class properties
     *
     * @param CubetechPost $post
     * @return void
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @version 1.0.0
     * @since Version 1.0.0
     */
    public function __construct($postId)
    {
        parent::__construct("EventCard", $postId);
        $this->title = $this->extractTitle();
        $this->description = $this->post->getField('page_lead');
        $this->start = date_i18n('d. F Y', $this->post->getField('start_date_timestamp'));
        $this->end = strtotime($this->post->getField('end_date_timestamp'));
        $this->location = $this->post->getField('location');
        $this->link = $this->post->getLink();
        $this->daysBeforeStart = $this->calculateDaysBeforeStart();
    }
    
    private function calculateDaysBeforeStart()
    {
        $now = current_time('dmY');
        $eventDay = date('dmY', $this->post->getField('start_date_timestamp'));
        if ($now === $eventDay) {
            return _x('Heute', 'Event tag if starting today', 'wptheme-basetheme');
        }
        
        $now = current_time('timestamp');
        $difference = intval($this->post->getField('start_date_timestamp')) - $now;
        $days = intval($difference / \DAY_IN_SECONDS);
        if ($days === 0 || $days === 1) {
            return _x('Morgen', 'Event tag if starting tomorrow', 'wptheme-basetheme');
        }
        
        return printf(_x('In %s Tagen', 'Event starts in ... days on event cards', 'wptheme-basetheme'), $days);
    }
}