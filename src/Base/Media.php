<?php

namespace Cubetech\Base;

class Media
{
    public $id;
    public $src;
    public $alt;

    /**
     * Uikit breakpoint definition
     *
     * @var int
     */
    private const SMALL = 640;
    private const MEDIUM = 960;
    private const LARGE = 1200;

    public function __construct(int $id)
    {
        $this->id = $id;
        $image = get_post($id);
        $this->src = $image->guid;
        $this->alt = get_post_meta($this->id, '_wp_attachment_image_alt', true) ? get_post_meta($this->id, '_wp_attachment_image_alt', true) : $image->post_title;
    }

    /**
     * Print all images sizes
     * 
     * @return void
     * 
     * @author Lars Berg <lars.berg@cubetech.ch>
     * @author Jethro Christen <jethro@cubetech.ch>   
     * @since 1.0.0
     * @version 1.0.1
     */
    private static function printImageSizeMessage()
    {
        echo "<h4 class='uk-text-danger'>no size given, choose from: ";
        foreach (get_intermediate_image_sizes() as $size) {
            echo " " . $size . " /";
        }
        echo "<br>or add one in ImageController.php</h4>";
    }

    /**
     * Returns an image url, when the size is set
     *
     * @param string the required image size
     * @return string image url
     *
     * @author Lars Berg <lars.berg@cubetech.ch>
     * @author Jethro Christen <jethro@cubetech.ch>    
     * @since 1.0.0
     * @version 1.1.0
     */
    public function getImageUrl($size = null)
    {
        if ($size === null) {
            Media::printImageSizeMessage();
            return;
        }
        if (wp_is_mobile()) {
            $size .= "-large";
        } else {
            $size .= "-small";
        }
        return wp_get_attachment_image_url($this->id, $size, false);
    }

    /**
     * Return Uikit srcset image
     * 
     * @param string image size
     * @param string attr
     * @return string img
     * 
     * @author Jethro Christen <jethro@cubetech.ch> 
     * @since 1.0.0
     * @version 1.0.0   
     */
    public function getUikitImage($size = null, $attr = null)
    {
        if ($size === null) {
            Media::printImageSizeMessage();
            return;
        }
        $image = '<img ';
        $image .= $attr . ' ';
        $image .= 'data-src="' . $this->getImageUrl($size. "-large") . '" ';
        $image .= 'data-srcset="' . $this->getImageSrcset($size) . '" ';
        $image .= Media::getImageSrcsetSizes() . ' ';
        $image .= Media::getImageSize($size . "-large") . ' ';
        $image .= 'alt="' . $this->alt . '" ';
        $image .= 'data-uk-img>';

        return $image;
    }

    /**
     * Returns an image, when the size is set
     * The alt attribute is defaulting to the media alt text, but can be set by params (as well as other attrs)
     *
     * @param string the required image size
     * @return string image srcset value
     *
     * @author Lars Berg <lars.berg@cubetech.ch>
     * @author Jethro Christen <jethro@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public function getImageSrcset($size = null)
    {
        if ($size === null) {
            Media::printImageSizeMessage();
            return;
        }
        return  wp_get_attachment_image_url($this->id, $size . "-large") . " " . Media::LARGE . "w, " .
            wp_get_attachment_image_url($this->id, $size . "-medium") . " " . Media::MEDIUM . "w, " .
            wp_get_attachment_image_url($this->id, $size . "-small") . " " . Media::SMALL . "w";
    }

    /**
     * Return srcset sizes html
     * 
     * @return string srcset sizes html
     * 
     * @author Jethro Christen <jethro@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public static function getImageSrcsetSizes()
    {
        return 'sizes="(min-width: ' . Media::LARGE . 'px) ' . Media::LARGE . 'px, (min-width: ' . Media::MEDIUM . 'px) ' . Media::LARGE . 'px, 100vw"';
    }

    /**
     * 
     * @return string width and height in html format
     * 
     * @static
     * 
     * @author Jethro Christen <jethro@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public static function getImageSize($size)
    {
        global $_wp_additional_image_sizes;
        return 'width="' . $_wp_additional_image_sizes[$size]['width'] . '" height="' . $_wp_additional_image_sizes[$size]['height'] . '"';
    }
}
