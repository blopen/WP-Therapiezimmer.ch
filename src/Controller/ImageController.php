<?php

namespace Cubetech\Controller;

/**
 * Adds imagesizes to wordpress core
 *
 * @author Lars Berg <lars.berg@cubetech.ch>
 * @author Marc Mentha <marc@cubetech.ch>
 * @author Jethro Christen <jethro@cubetech.ch> 
 * 
 * @since 1.0.0
 * @version 2.0.0
 */
class ImageController extends ABaseController
{
    /**
     * Define the image sizes for this theme
     *
     * @var array
     */
    private const IMAGE_SIZES = [
        'logo' => [
            "large" => ['size' => ["100px", "100px"], 'crop' => false],
        ],
        'full' => [
            "large" => ['size' => [1, 1], 'crop' => false],
        ],
        'half' => [
            "large"     => ['size' => [0.5, 0.5],   'crop' => true],
            "medium"    => ['size' => [1, 1],       'crop' => true],
            "small"     => ['size' => [1, 1],       'crop' => true],
        ],
    ];

    /**
     * Window width definition
     *
     * @var int
     */
    private const DESKTOP_WIDTH = 1920;
    private const TABLET_WIDTH = 1200;
    private const MOBILE_WIDTH = 768;

    /**
     * Abstraction from ABaseController
     *
     * @return void
     *
     * @static
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @author Jethro Christen <jethro@cubetech.ch>
     * 
     * @since 1.0.0
     * @version 2.0.0
     */
    public static function addActions()
    {
        foreach (self::IMAGE_SIZES as $imageName => $imageSizeDatas) {
            if (key_exists("large", $imageSizeDatas)) {
                foreach ($imageSizeDatas as $size => $imageSizeData) {
                    self::addSize($imageName . "-" . $size, $imageSizeData);
                }
                if (!key_exists("medium", $imageSizeDatas)) {
                    self::addSize($imageName . "-medium", $imageSizeDatas["large"]);
                }
                if (!key_exists("small", $imageSizeDatas)) {
                    self::addSize($imageName . "-small", $imageSizeDatas["large"]);
                }
            } else {
                echo "<h4 class='uk-text-danger'>image size type large require</h4>";
            }
        }
    }

    /**
     * Calculates the required image size
     * and adds it to the theme
     *
     * @return void
     *
     * @static
     *
     * @author Lars Berg <lars.berg@cubetech.ch>
     * @author Marc Mentha <marc@cubetech.ch>
     * @author Jethro Christen <jethro@cubetech.ch>
     * 
     * @since 1.0.0
     * @version 3.0.0
     */
    private static function addSize($name, $sizeData)
    {
        $windowSize = ImageController::getWindowSize($name);
        $width = ImageController::getSize($sizeData["size"][0], $windowSize);
        $heigth =  ImageController::getSize($sizeData["size"][1], $windowSize);
        add_image_size($name, $width, $heigth, $sizeData['crop']);
    }

    /**
     * Get the image size by name
     * 
     * @param string name
     * @return int size
     * 
     * @static
     * 
     * @author Jethro Christen <jethro@cubetech.ch>
     * 
     * @since 2.0.0
     * @version 1.0.0
     */
    private static function getWindowSize($name)
    {
        if (preg_match('/-large$/', $name)) {
            return ImageController::DESKTOP_WIDTH;
        } elseif (preg_match('/-medium$/', $name)) {
            return ImageController::TABLET_WIDTH;
        } elseif (preg_match('/-small$/', $name)) {
            return ImageController::MOBILE_WIDTH;
        }
    }

    /**
     * Calculates the size
     * 
     * @param string size
     * @param string windowSize
     * @return int size
     * 
     * @static
     * 
     * @author Jethro Christen <jethro@cubetech.ch>
     * 
     * @since 2.0.0
     * @version 1.0.0
     */
    private static function getSize($size, $windowSize)
    {
        if (is_string($size) && strpos($size, "px")) {
            return (int) substr($size, 0, -2);
        } elseif (is_numeric($size)) {
            return intval($windowSize * $size);
        }
        return $windowSize;
    }
}
