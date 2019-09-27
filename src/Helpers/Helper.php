<?php

namespace Cubetech\Helpers;

class Helper
{
    /**
     * Return a formatted phone number, for a valid link "tel:"
     *
     * @param string number
     * @return string
     *
     * @author Steeve Jeannin <steeve@cubetech.ch>
     * @author Reference: project 'justitia'
     * @version 1.0.0
     * @since 1.0.0
     */
    public static function getTelUrl($number)
    {
        $nationalPrefix = "+41";
        $protocol = "tel:";
        
        $formattedNumber = $number;
        if ($formattedNumber !== "") {
            // Add National-Prefix to the given number if it's not already set
            if (strpos($formattedNumber, "00") !== 0 && strpos($formattedNumber, "0800") !== 0 && strpos($formattedNumber, "+") !== 0) {
                $formattedNumber = preg_replace("/^0/", $nationalPrefix, $formattedNumber);
            }
            
            // Suppress the "(0)", not needed for example when "+41 (0)31 511 51 51"
            $formattedNumber = str_replace("(0)", "", $formattedNumber);
            
            // Remove all chars they are not digits (spaces, slashes, parenthesis, etc...)
            $formattedNumber = preg_replace("~[^0-9\+]~", "", $formattedNumber);
        }
        
        // Return the formatted number, inclusive the protocol
        return $protocol . $formattedNumber;
    }
    
    private static function testSocialMediaUrl($urlToTest, $urlRef)
    {
        if (substr($urlRef, -2) === ".*") {
            // Remove the top-domain (for example: country or .com)
            $urlToTest = substr($urlToTest, 0, strrpos($urlToTest, "."));
            $urlRef = substr($urlRef, 0, strrpos($urlRef, "."));
        }
        if (stripos($urlToTest, $urlRef) === strlen($urlToTest) - strlen($urlRef)) {
            // "urlToTest" ends with "urlRef"
            return true;
        }
        return false;
        
    }
    
    public static function hasShortcode($content, $printShortcode = false)
    {
        global $shortcode_tags;
        
        foreach ($shortcode_tags as $shortcode_tag => $tag) {
            if (has_shortcode($content, $shortcode_tag)) {
                if ($printShortcode) {
                    return do_shortcode($content);
                }
                else {
                    return true;
                }
            }
        }
        return false;
    }
    
    /**
     * Return an HTML string containing the social-media's link, with the corresponding icon
     *
     * @param string inUrl
     * @return string (empty if inUrl not valid)
     *
     * @author Steeve Jeannin <steeve@cubetech.ch>
     * @version 1.0.0
     * @since 1.0.0
     *
     * @link for some URL parser: https://github.com/lorey/social-media-profiles-regexs
     */
    public static function getSocialMediaIconUrl($inUrl)
    {
        if ( !filter_var($inUrl, FILTER_VALIDATE_URL)) {
            return "";
        }
        
        $arrayUrl = parse_url($inUrl);
        if ( !is_array($arrayUrl) || strlen($arrayUrl["path"]) === 0) {
            return "";
        }
        
        $urlHost = $arrayUrl["host"];
        $uikitIcon = "link";
        
        if (self::testSocialMediaUrl($urlHost, "facebook.com")) {
            $uikitIcon = "facebook";
        }
        else if (self::testSocialMediaUrl($urlHost, "flickr.com") || self::testSocialMediaUrl($urlHost, "flicker.com")) {
            $uikitIcon = "flickr";
        }
        else if (self::testSocialMediaUrl($urlHost, "github.com")) {
            $uikitIcon = "github";
        }
        else if (self::testSocialMediaUrl($urlHost, "instagram.com")) {
            $uikitIcon = "instagram";
        }
        else if (self::testSocialMediaUrl($urlHost, "linkedin.com")) {
            $uikitIcon = "linkedin";
        }
        else if (self::testSocialMediaUrl($urlHost, "pinterest.*")) {
            $uikitIcon = "pinterest";
        }
        else if (self::testSocialMediaUrl($urlHost, "plus.google.com")) {
            $uikitIcon = "google-plus";
        }
        else if (self::testSocialMediaUrl($urlHost, "reddit.com")) {
            $uikitIcon = "reddit";
        }
        else if (self::testSocialMediaUrl($urlHost, "tumblr.com")) {
            $uikitIcon = "tumblr";
        }
        else if (self::testSocialMediaUrl($urlHost, "twitter.com")) {
            $uikitIcon = "twitter";
        }
        else if (self::testSocialMediaUrl($urlHost, "vimeo.com")) {
            $uikitIcon = "vimeo";
        }
        else if (self::testSocialMediaUrl($urlHost, "wa.me") || self::testSocialMediaUrl($urlHost, "api.whatsapp.com")) {
            $uikitIcon = "whatsapp";
        }
        else if (self::testSocialMediaUrl($urlHost, "wordpress.com")) {
            $uikitIcon = "wordpress";
        }
        else if (self::testSocialMediaUrl($urlHost, "xing.*")) {
            $uikitIcon = "xing";
        }
        else if (self::testSocialMediaUrl($urlHost, "youtube.com") || self::testSocialMediaUrl($urlHost, "youtu.be")) {
            $uikitIcon = "youtube";
        }
        
        $uikitLink = "<a href='" . $inUrl . "' data-uk-icon=" . $uikitIcon . " target='_blank'></a>";
        return $uikitLink;
    }
}
