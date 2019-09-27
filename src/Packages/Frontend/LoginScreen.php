<?php

namespace Cubetech\Packages\Frontend;

use \Cubetech\Packages\IPackage;

class LoginScreen implements IPackage
{
    
    public function run()
    {
        add_action('customize_register', [
            $this,
            'registerCustomizerOptions',
        ]);
        add_action('login_enqueue_scripts', [
            $this,
            'customizeLoginScreen',
        ]);
    }
    
    public function registerCustomizerOptions($wp_customize)
    {
        
        $wp_customize->add_section('ct-login-screen', [
            'title'    => __('Login Screen', 'wptheme-basetheme'),
            'priority' => 30,
        ]);
        
        
        $wp_customize->add_setting('body_background_color', [
            'default'   => '#ffffff',
            'transport' => 'refresh',
        ]);
        $wp_customize->add_control(new \WP_Customize_Color_Control($wp_customize, 'body_background_color', [
            'label'    => __('Body Backgroundcolor', 'wptheme-basetheme'),
            'section'  => 'ct-login-screen',
            'settings' => 'body_background_color',
        ]));
        
        
        $wp_customize->add_setting('link_color', [
            'default'   => '#000000',
            'transport' => 'refresh',
        ]);
        $wp_customize->add_control(new \WP_Customize_Color_Control($wp_customize, 'link_color', [
            'label'    => __('Link Color', 'wptheme-basetheme'),
            'section'  => 'ct-login-screen',
            'settings' => 'link_color',
        ]));
        
        
        $wp_customize->add_setting('button_background_color', [
            'default'   => '#33cc66',
            'transport' => 'refresh',
        ]);
        $wp_customize->add_control(new \WP_Customize_Color_Control($wp_customize, 'button_background_color', [
            'label'    => __('Button background color', 'wptheme-basetheme'),
            'section'  => 'ct-login-screen',
            'settings' => 'button_background_color',
        ]));
        
        $wp_customize->add_setting('button_color', [
            'default'   => '#ffffff',
            'transport' => 'refresh',
        ]);
        $wp_customize->add_control(new \WP_Customize_Color_Control($wp_customize, 'button_color', [
            'label'    => __('Button color', 'wptheme-basetheme'),
            'section'  => 'ct-login-screen',
            'settings' => 'button_color',
        ]));
        
        $wp_customize->add_setting('brand_logo', [
            'default'   => '',
            'transport' => 'refresh',
        ]);
        $wp_customize->add_control(new \WP_Customize_Upload_Control($wp_customize, 'brand_logo', [
            'label'    => __('Brand Logo', 'wptheme-basetheme'),
            'section'  => 'ct-login-screen',
            'settings' => 'brand_logo',
        ]));
    }
    
    public function customizeLoginScreen()
    {
        
        
        $bodyBackgroudColor = get_theme_mod('body_background_color', '#ffffff');
        $linkColor = get_theme_mod('link_color', '#000000');
        $buttonBackgroundColor = get_theme_mod('button_background_color', '#33cc66');
        $buttonColor = get_theme_mod('button_color', '#ffffff');
        $brandLogo = get_theme_mod('brand_logo', '');
        ?>
        <style type="text/css">
            .login {
                background-color: <?php echo $bodyBackgroudColor; ?>;
            }
            
            #login h1 a, .login h1 a {
            <?php if ($brandLogo) : ?> background-image: url(<?php echo $brandLogo ?>);
            <?php endif; ?> width: 100%;
                background-size: contain;
                background-repeat: no-repeat;
                padding-bottom: 30px;
            }
            
            #wp-submit {
                border-radius: 0;
                background-color: <?php echo $buttonBackgroundColor; ?>;
                color: <?php echo $buttonColor; ?>;
                border: none;
                text-shadow: none;
                box-shadow: none;
                transition: background 0.4s ease;
            }
            
            #wp-submit:hover {
                background-color: <?php echo $this->darkenColor($buttonBackgroundColor); ?>;
            }
            
            #loginform {
                box-shadow: 0 3px 10px #e2e2e2;
            }
            
            #loginform input:focus {
                border-color: <?php echo $buttonBackgroundColor ?>;
                box-shadow: 0 0 2px<?php echo $buttonBackgroundColor ?>;
            }
            
            #login #nav a, #login #backtoblog a {
                color: <?php echo $linkColor ?>;
            }
            
            #login #nav a:hover, #login #backtoblog a:hover {
                border-bottom: 1px solid<?php echo $this->darkenColor($linkColor); ?>;
            }
        </style>
        <?php
    }
    
    private function darkenColor($rgb)
    {
        $hash = (strpos($rgb, '#') !== false) ? '#' : '';
        $rgb = (strlen($rgb) === 7) ? str_replace('#', '', $rgb) : ((strlen($rgb) === 6) ? $rgb : false);
        if (strlen($rgb) !== 6) return $hash . '000000';
        $darker = 1.5;
        list($R16, $G16, $B16) = str_split($rgb, 2);
        $R = sprintf("%02X", floor(hexdec($R16) / $darker));
        $G = sprintf("%02X", floor(hexdec($G16) / $darker));
        $B = sprintf("%02X", floor(hexdec($B16) / $darker));
        return $hash . $R . $G . $B;
    }
    
}