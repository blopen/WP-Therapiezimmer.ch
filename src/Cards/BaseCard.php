<?php

namespace Cubetech\Cards;

use \Cubetech\Rendering\IRenderable;
use Cubetech\Rendering\RenderableTrait;

/**
 * Abstract BaseCard describes the bare minimum any
 * Card component must provide and includes a final
 * render method for unified rendering
 *
 * @author Marc Mentha <marc@cubetech.ch>
 * @since 0.0.1
 * @version 1.0.0
 */
abstract class BaseCard implements IRenderable
{
    /**
     * This implements all needed functionality to satisfy IRenderable
     * and to automate the inclusion of the correct view file
     */
    use RenderableTrait;

    /**
     * postvariable
     *
     * @var CubetechPost
     */
    public $post;
    public $url;

    /**
     * Array containing all categories set to this post
     *
     * @var array
     */
    private $categories;

    /**
     * Initializes class properties
     *
     * @param string $name
     * @param CubetechPost $post
     * @return void
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @version 1.0.0
     * @since 1.0.0
     */
    public function __construct($name, $postId)
    {
        $this->initializeRenderable('cards', get_class($this), $name);
        $this->post = new \Cubetech\Base\CubetechPost($postId);
        $this->categories = $this->extractCategories();
        $this->viewDirectory = get_template_directory() . '/views/cards/';
    }

    /**
     * Checks if the optional card title is set
     * Defaults to the post tile if empty
     *
     * @return string
     * @version 1.0.0
     * @since 1.0.0
     * @author Marc Mentha <marc@cubetech.ch>
     */
    protected function extractTitle()
    {
        if ($this->post->isFieldValid('card_title')) {
            return $this->post->getField('card_title');
        }
        return $this->post->getTitle();
    }

    /**
     * Checks if the optional card lead is set
     * Defaults to the post leadtext if empty
     *
     * @return string
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @version 1.0.0
     * @since 1.0.0
     */
    protected function extractLead()
    {
        if ($this->post->isFieldValid('card_lead')) {
            return $this->post->getField('card_lead');
        }
        return $this->post->getField('leadtext');
    }

    /**
     * Checks if categories are set
     *
     * @return boolean
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public function hasCategories()
    {
        if (is_array($this->categories) || is_object($this->categories)) {
            $mountOfCategories = count($this->categories) > 0;
        } else {
            $mountOfCategories = false;
        }

        return $mountOfCategories;
    }

    /**
     * Gets the categories set to this post
     *
     * @return array Wp_term
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    private function extractCategories()
    {
        $categoryIds = wp_get_post_categories($this->post->getId(), ['taxonomy' => 'category']);
        if (count($categoryIds) > 0) {
            $categories = [];
            foreach ($categoryIds as $id) {
                $term = get_term($id);
                $categories[] = $term;
            }
            return $categories;
        }
        return false;
    }

    /**
     * get a string with a delimiter of all categories names set to this post
     *
     * @param string $delimiter
     * @return string
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public function getCategoryNamesAsString($delimiter = ',')
    {
        if ($this->categories) {
            $string = '';
            foreach ($this->categories as $index => $category) {
                $string .= $category->name;
                if ($index + 1 < count($this->categories)) {
                    $string .= $delimiter . ' ';
                }
            }
            return $string;
        }
        return false;
    }

    /**
     * get a string with a delimiter of all categories slugs set to this post
     *
     * @param string $delimiter
     * @return string
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public function getCategorySlugsAsString($delimiter = ',')
    {
        if ($this->categories) {
            $string = '';
            foreach ($this->categories as $index => $category) {
                $string .= $category->slug;
                if ($index + 1 < count($this->categories)) {
                    $string .= $delimiter . ' ';
                }
            }
            return $string;
        }
        return null;
    }

    /**
     * Get a list of names of the categories set to this post
     *
     * @return array
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public function getCategoryNames()
    {
        if ($this->categories) {
            $categories = [];
            foreach ($this->categories as $category) {
                $categories[] = $category->name;
            }
            return $categories;
        }
        return false;
    }

    /**
     * Get a list of slug of the categories set to this post
     *
     * @return array
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public function getCategorySlugs()
    {
        if ($this->categories) {
            $slugs = [];
            foreach ($this->categories as $index => $category) {
                $slugs[] = $category->slug;
            }
            return $slugs;
        }
        return false;
    }

    /**
     * Checks if values in a property is set and not empty
     *
     * @param string $key
     * @return boolean
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @version 1.0.0
     * @since 1.0.0
     */
    public function isFieldValid(string $key)
    {
        return !empty($this->$key);
    }

    /**
     * Render method for _every_ card. This is so each card is
     * checked for its validity before it is rendered.
     * Debug BEGIN/END markers are printed anyways to facilitate
     * finding invalid cards
     *
     * @return void
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @version 1.0.0
     * @since 1.0.0
     * @final
     */
    final public function render()
    {
        if (defined('WP_DEBUG') && WP_DEBUG) {
            echo '<!-- BEGIN Card ' . $this->name . ' -->';
        }
        include $this->viewDirectory . $this->name . '.php';
        if (defined('WP_DEBUG') && WP_DEBUG) {
            echo '<!-- END Card ' . $this->name . ' -->';
        }
    }
}
