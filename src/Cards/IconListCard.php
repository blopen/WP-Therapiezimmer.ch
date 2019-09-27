<?php

namespace Cubetech\Cards;

/**
 * Class for an IconList card handling
 *
 * @author Steeve Jeannin <steeve@cubetech.ch>
 * @since 1.0.0
 * @version 1.0.0
 */
class IconListCard extends BaseCard
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
    public function __construct($postId, $iconlist)
    {
        parent::__construct("IconListCard", $postId);
        $this->icon_title = $iconlist->icon_title;
        $this->icon_content = $iconlist->icon_content;
        $this->icon_icon = $iconlist->icon_icon;
        $this->icon_link = $iconlist->icon_link;
    }
}
