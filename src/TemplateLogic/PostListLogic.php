<?php

namespace Cubetech\TemplateLogic;

use Cubetech\Theme;
use Cubetech\Cards\StandardCard;

/**
 * Logic Module for TemplateParts acting as a Header
 *
 * @author Alex Scherer <alex.scherer@cubetech.ch>
 * @since 1.1.0
 */
class PostListLogic extends ABaseLogic
{
    
    public $cards;
    
    /**
     * Initializes this HeaderLogic with post-specific data using the post's $id
     *
     * @return void
     *
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @since 1.1.0
     */
    public function initialize(int $id)
    {
        $posts = Theme::getPosts(['post_type' => 'post', 'numberposts' => -1]);
        $this->cards = [];
        foreach ($posts as $post) {
            $this->cards[] = new StandardCard($post->getId());
        }
    }
}