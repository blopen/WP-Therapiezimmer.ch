<?php

namespace Cubetech\Helpers;

use \Cubetech\Theme;
use \Cubetech\Base\CubetechPost;
use \Cubetech\Base\Options;

/**
 * Class to save restricted content.
 * Acts based on user role and cant be reused without
 * changes to the isUserAllowed function
 *
 * Best practise is to name the return values of the backend fields
 * after the role that is allowed to view that content.
 * Use a checkbox for this purpose and name the field restrictions
 *
 * Every function needs to be static
 *
 * Editor and Administrator wont get restricted in any way
 *
 * @author Marc Mentha <marc@cubetech.ch>
 * @since 1.0.0
 * @version 2.0.0
 */
class RestrictionHandler
{
    /**
     * Initializes a Cubetechpost -> used to retrieve the restriction field
     * Checks if content is restricted over all ore the user has the role "Administrator" or "Editor"
     *
     * Checks if the current user has the neede role to view the content
     * Redirects to login page if either no user is logged in or
     * the user missing the required role
     *
     * Redirect defaults to Homepage if Backend option  "login_page" is not set
     *
     * @param integer $postId
     * @return void
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.0.0
     * @version 2.0.0
     */
    public static function handleRestriction(int $postId)
    {
        
        if (is_404() || is_search() || is_home()) {
            return;
        }
        if (is_numeric($postId) && $postId > 0) {
            $post = new CubetechPost($postId);
            $user = wp_get_current_user();
        }
        else {
            
            wp_die('Something went wrong with the restriction handler. Contact support@cubetech.ch for help!');
        }
        if (self::isNonCapedUser($user)) {
            return;
        }
        if (self::isContentRestricted($post)) {
            $restrictions = $post->getField('restrictions');
            if (self::hasUserCapabilities($user) && self::isUserAllowed($restrictions, $user)) {
                return;
            }
            else {
                self::redirectToLoginPage();
            }
        }
    }
    
    /**
     * Hides the Adminbar from users with the no_backend role
     *
     * If the user tries to get access to the WordPress backend
     * this method will redirect him to the login- or frontpage
     * This method must been called inside functions.ph e.g Theme.php!
     *
     * @return void
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.1.0
     * @version 1.0.0
     */
    public static function hideAdminBarForNoBackendUser()
    {
        if (self::hasUserRole(wp_get_current_user(), 'no_backend')) {
            add_filter('show_admin_bar', '__return_false');
            if (is_admin()) {
                self::redirectToLoginPage();
            }
        }
    }
    
    /**
     * Checks if the user has the required role to view the content
     *
     * @param array $restrictions
     * @param WP_USER $user
     * @return bool
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.0.0
     * @version 1.1.0
     */
    public static function isUserAllowed($restrictions, $user)
    {
        if (self::isNonCapedUser($user)) {
            return true;
        }
        $userIsAllowed = false;
        
        if (is_array($restrictions)) {
            foreach ($restrictions as $restriction) {
                if (self::hasUserRole($user, $restriction)) {
                    $userIsAllowed = true;
                }
            }
        }
        else {
            if (self::hasUserRole($user, $restrictions)) {
                $userIsAllowed = true;
            }
        }
        return $userIsAllowed;
    }
    
    /**
     * Checks if the post or page has restrictions set
     *
     * @param CubetechPost $post
     * @return boolean
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.0.0
     * @version 2.0.0
     */
    public static function isContentRestricted($post)
    {
        if ( !empty($post->getField('restrictions'))) {
            return true;
        }
        return false;
    }
    
    /**
     * Checks if $user has capabilities over all
     * to prevent php warnings
     *
     * @param WP_User $user
     * @return boolean
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.0.0
     * @version 2.0.0
     */
    public static function hasUserCapabilities($user)
    {
        if (isset($user->caps) && count($user->caps) > 0) {
            return true;
        }
        return false;
    }
    
    /**
     * Checks if the given user is Administrator or Editor
     *
     * @param WP_User $user
     * @return boolean
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public static function isNonCapedUser($user)
    {
        if ( !self::hasUserCapabilities($user)) {
            return false;
        }
        if (array_key_exists('administrator', $user->caps) || array_key_exists('editor', $user->caps)) {
            return true;
        }
        return false;
    }
    
    /**
     * Checks if the given user has the given role
     *
     * @param WP_User $user
     * @param string $role
     * @return boolean
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 2.0.0
     * @version 1.0.0
     */
    public static function hasUserRole($user, $role)
    {
        if (array_key_exists($role, $user->caps) && $user->caps[$role]) {
            return true;
        }
        return false;
    }
    
    /**
     * Returns only restricted Post for the given user
     * Excludes non restricted posts aswell
     *
     * @param array $arguments
     * @param WP_User $user
     * @return array of CubetechPosts
     */
    public static function getRestrictedPosts($arguments = false, $user)
    {
        if (isset($arguments['post_type'])) {
            $posttype = $arguments['post_type'];
        }
        else {
            $posttype = 'post';
        }
        if (isset($arguments['posts_per_page'])) {
            $postsPerPage = $arguments['posts_per_page'];
        }
        else {
            $postsPerPage = 3;
        }
        if ( !self::hasUserCapabilities($user)) {
            return self::getUnrestrictedPosts($arguments);
        }
        if (self::isNonCapedUser($user)) {
            Theme::getPosts($arguments);
        }
        $userCapabilities = $user->caps;
        $metaQuery = ['relation' => 'OR'];
        foreach ($userCapabilities as $capabilityName => $isTrue) {
            if ($isTrue) {
                $metaQuery[] = [
                    'key'     => 'restrictions',
                    'value'   => $capabilityName,
                    'compare' => 'LIKE',
                ];
            }
        }
        $arguments = [
            'post_type'      => $arguments['post_type'],
            'posts_per_page' => $arguments['posts_per_page'],
            'meta_query'     => $metaQuery,
        ];
        
        $posts = get_posts($arguments);
        if (count($posts) > 0) {
            $result = [];
            foreach ($posts as $post) {
                $result[] = new CubetechPost($post);
            }
            return $result;
        }
        return false;
    }
    
    /**
     * Returns all the posts for the given user
     * including the public and the restricted ones
     *
     * @param array $arguments
     * @param WP_User $user
     * @return array of CubetechPosts
     */
    public static function getUserContent($arguments = false, $user)
    {
        if (isset($arguments['post_type'])) {
            $posttype = $arguments['post_type'];
        }
        else {
            $posttype = 'post';
        }
        if (isset($arguments['posts_per_page'])) {
            $postsPerPage = $arguments['posts_per_page'];
        }
        else {
            $postsPerPage = 3;
        }
        if ( !self::hasUserCapabilities($user)) {
            return self::getUnrestrictedPosts($arguments);
        }
        if (self::isNonCapedUser($user)) {
            Theme::getPosts($arguments);
        }
        $userCapabilities = $user->caps;
        $metaQuery = ['relation' => 'OR'];
        foreach ($userCapabilities as $capabilityName => $isTrue) {
            if ($isTrue) {
                $metaQuery[] = [
                    'key'     => 'restrictions',
                    'value'   => $capabilityName,
                    'compare' => 'LIKE',
                ];
            }
        }
        $metaQuery[] = [
            'key'     => 'restrictions',
            'value'   => '',
            'compare' => '=',
        ];
        $arguments = [
            'post_type'      => $arguments['post_type'],
            'posts_per_page' => $arguments['posts_per_page'],
            'meta_query'     => $metaQuery,
        ];
        
        $posts = get_posts($arguments);
        if (count($posts) > 0) {
            $result = [];
            foreach ($posts as $post) {
                $result[] = new CubetechPost($post);
            }
            return $result;
        }
        return false;
    }
    
    /**
     * This function returns only posts which arent restricted in any way
     *
     * @param boolean $arguments
     * @return array
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 2.0.0
     * @version 1.0.0
     */
    public static function getUnrestrictedPosts($arguments = false)
    {
        if (isset($arguments['post_type'])) {
            $posttype = $arguments['post_type'];
        }
        else {
            $posttype = 'post';
        }
        if (isset($arguments['posts_per_page'])) {
            $postsPerPage = $arguments['posts_per_page'];
        }
        else {
            $postsPerPage = 3;
        }
        
        $arguments = [
            'post_type'      => $posttype,
            'posts_per_page' => $postsPerPage,
            'order'          => 'ASC',
            'meta_query'     => [
                [
                    'key'     => 'restrictions',
                    'value'   => '',
                    'compare' => '=',
                ],
            ],
        ];
        $posts = get_posts($arguments);
        if (count($posts) > 0) {
            $results = [];
            foreach ($posts as $post) {
                $results[] = new CubetechPost($post);
            }
            return $results;
        }
        return false;
    }
    
    /**
     * Redirects user without required perission to the loginpage
     * Defaults to the homepage if Backend option "login_page" is not set
     *
     * @return void
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.0.0
     * @version 2.0.0
     */
    public static function redirectToLoginPage()
    {
        
        $loginPage = Options::getThemeOption('login_page');
        if ($loginPage !== '') {
            $loginPage = new CubetechPost($loginPage);
            wp_redirect($loginPage->getLink(), 301);
            exit;
            
        }
        else {
            
            wp_redirect('/', 301);
            exit;
        }
    }
}
