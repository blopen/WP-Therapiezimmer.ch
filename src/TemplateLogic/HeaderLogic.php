<?php

namespace Cubetech\TemplateLogic;

use Cubetech\Base\CubetechPost;

/**
 * Logic Module for TemplateParts acting as a Header
 *
 * @author Alex Scherer <alex.scherer@cubetech.ch>
 * @since 1.1.0
 */
class HeaderLogic extends ABaseLogic
{
    /**
     * ID of the attached post
     *
     * @var integer
     */
    protected $id;
    
    /**
     * Attached Post
     *
     * @var CubetechPost
     */
    public $post;


    /**
     * The lead text for this header
     *
     * @var string
     */
    public $lead;
    
    /**
     * The page title of this header
     *
     * @var string
     */
    public $pageTitle;
    
    /**
     * Initializes this HeaderLogic with post-specific data using the post's $id
     *
     * @param integer $id
     * @return void
     *
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @since 1.1.0
     */
    public function initialize(int $id)
    {
        $this->post = new CubetechPost($id);
        $this->id = $id;
        $this->lead = $this->post->getField('page_lead');
        $this->extractPageTitle();
    }
    
    /**
     * Checks if an optional page title isset
     * and either sets the pageTitle property this value
     * or the post_title
     *
     * @return void
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public function extractPageTitle()
    {
        if ($this->post->isFieldValid('optional_page_title')) {
            $this->pageTitle = $this->post->getField('optional_page_title');
        }
        else {
            $this->pageTitle = get_the_title($this->post->getId());
        }
    }
}