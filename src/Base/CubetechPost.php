<?php

namespace Cubetech\Base;

/**
 * Wrapper class for posts with cubetech business logic implemented
 *
 * @author Marc Mentha <marc@cubetech.ch>
 * @since 0.0.1
 */
class CubetechPost extends ACFWrapper
{
    
    /**
     * The Post ID (WP_Post->ID)
     *
     * @var int
     */
    private $id;
    
    /**
     * The Post title (WP_Post->post_title)
     *
     * @var string
     */
    private $title;
    
    /**
     * The Post slug (WP_Post->post_name)
     *
     * @var string
     */
    private $slug;
    
    /**
     * The Post excerpt (WP_Post->post_excerpt)
     *
     * @var string
     */
    private $excerpt;
    
    /**
     * The Post content (WP_Post->post_content)
     * @var string
     */

    public $content;

    /**
     * The Posttype (WP_Post->post_type)
     * @var string
     */
    private $posttype;
    
    /**
     * The Posts Author's ID (WP_Post->post_author)
     * @var int
     */
    private $authorId;
    
    /**
     * The post's creation date (WP_Post->post_date)
     * as UNIX-Timestamp
     *
     * @var int
     */
    private $date;
    
    /**
     * The post's last modification date (WP_Post->post_modified)
     * as UNIX-Timestamp
     *
     * @var int
     */
    private $modified;
    
    /**
     * The post's permalink
     *
     * @var string
     */
    private $link;
    
    /**
     * Initializes the CubetechPost and fetches all needed property values
     * from the associated WP_Post
     *
     * @param int|CubetechPost|WP_Post $id
     * @return void
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public function __construct($id = false)
    {
        if ($id === false) {
            return;
        }
        
        if (is_numeric($id)) {
            $this->id = $id;
            $wpPost = get_post($this->id);
            
        }
        else if ($id instanceof \Cubetech\Base\CubetechPost) {
            $this->id = $id->id;
            $wpPost = get_post($this->id);
        }
        else if ($id instanceof \WP_Post) {
            $this->id = $id->ID;
            $wpPost = $id;
        }
        
        $this->title = $wpPost->post_title;
        $this->slug = $wpPost->post_name;
        $this->excerpt = $wpPost->post_excerpt;
        $this->content = $wpPost->post_content;
        $this->posttype = $wpPost->post_type;
        $this->authorId = intval($wpPost->post_author);
        $this->date = strtotime($wpPost->post_date);
        $this->modified = strtotime($wpPost->post_modified);
        $this->link = get_permalink($wpPost->ID);
    }
    
    
    /**
     * Gets the post id
     *
     * @return int
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Gets the post slug
     *
     * @return string
     *
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public function getSlug()
    {
        return $this->slug;
    }
    
    /**
     * Gets the post title
     *
     * @return string
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public function getTitle()
    {
        return $this->title;
    }
    
    /**
     * Gets the post excerpt
     *
     * @return string
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public function getExcerpt()
    {
        return $this->excerpt;
    }
    
    /**
     * Gets the post content
     *
     * @return string
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public function getContent()
    {
        return $this->content;
    }
    
    /**
     * Gets the posttype
     *
     * @return string
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public function getPosttype()
    {
        return $this->posttype;
    }
    
    /**
     * Gets the post categories
     *
     * @return array
     *
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public function getCategories()
    {
        return $this->getField('taxonomies');
    }
    
    /**
     * Gets the posts authors id
     *
     * @return int
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public function getAuthorId()
    {
        return $this->authorId;
    }
    
    /**
     * Gets the posts permalink
     *
     * @return string
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public function getLink()
    {
        return $this->link;
    }
    
    /**
     * Gets the posts creation date, optionally formatted with $format
     *
     * @param string $format
     * @return int|string
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public function getDate($format = false)
    {
        if ($format) {
            return date($format, $this->date);
        }
        return $this->date;
    }
    
    /**
     * Gets the posts modified date, optionally formatted with $format
     *
     * @param string $format
     * @return int|string
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public function getModified($format = false)
    {
        if ($format) {
            return date($format, $this->modified);
        }
        return $this->modified;
    }
    
    /**
     * Checks a field for its validity
     *
     * @param string $key
     * @return bool
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public function isFieldValid(string $key)
    {
        $value = $this->getField($key, true);
        return !empty($value);
    }
}