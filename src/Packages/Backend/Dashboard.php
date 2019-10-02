<?php

namespace Cubetech\Packages\Backend;

use \Cubetech\Packages\IPackage;
use \Cubetech\Base\Options;

/**
 * Displays a welcome message in the Dashboard
 *
 * @todo This implementation is a poorly one and will get a revise
 * from Lars berg as of his IPA
 *
 * @author Alex Scherer <alex.scherer@cubetech.ch>
 * @author Christoph S. Ackermann <acki@cubetech.ch>
 * @version 1.0.0
 */
class Dashboard implements IPackage
{
    
    /**
     * Runs this Package and registers its methods
     *
     * @return void
     *
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @author Christoph S. Ackermann <acki@cubetech.ch>
     * @since 1.0.0
     */
    public function run()
    {
        add_action('welcome_panel', [$this, 'displayWelcomePanel']);
        add_filter('wpseo_metabox_prio', [$this, 'lowerYoastMetaboxPriority'], 10, 0);
    }
    
    /**
     * Displays the welcome panel in the admin dashboard
     *
     * @return void
     *
     * @author Alex Scherer <alex.scherer@cubetech.ch>
     * @author Christoph S. Ackermann <acki@cubetech.ch>
     * @since 1.0.0
     */
    public function displayWelcomePanel()
    {
        
        $tracker_api = '';
        $amount = 0;
        if ( !empty($tracker_api)) {
            $invoices = json_decode(file_get_contents($tracker_api));
            foreach ($invoices->invoices as $i) $amount = $amount + $i->amount;
        }
        
        ?>
			<script type="text/javascript">
          // Hide default welcome message
          jQuery(document).ready(function ($) {
              $('div.welcome-panel-content').hide();
          });
			</script>

			<style type="text/css">
				div.welcome-panel .ct-welcome-panel-content .welcome-panel-column {
					width: 25%;
				}
			</style>

			<div class="ct-welcome-panel-content" style="margin-left: 13px; max-width: 1500px;">
				<h2>Willkommen zu Deiner Website von Therapiezimmer!</h2>
				<p class="about-description">Nachfolgend findest Du einige Informationen zum loslegen sowie
																		 Supportinformationen.</p>
				<div class="welcome-panel-column-container">
					<div class="welcome-panel-column">
						<h3>Ursprung</h3>
						<p>
							cubetech GmbH<br>
							Lagerhausweg 30<br>
							3018 Bern (Schweiz)<br><br>
						<h3>Support</h3>
							Mail: <a href="mailto:support@cubetech.ch">nelson@lopez-be.ch</a><br>
							Telefon: <a href="tel:+41315115151">+0791025955</a>
						</p>
						<a class="button button-primary button-hero" href="https://nelson.lopez-be.ch" target="_blank">Besuche meine Lehrlingsseite
																																																				Website</a><br><br>
					</div><!-- .welcome-panel-column -->
					<div class="welcome-panel-column">
						<h3>Erste Schritte</h3>
						<ul>
                <?php if ('page' === get_option('show_on_front')) : ?>
									<li><?php printf('<a href="%s" class="welcome-icon welcome-edit-page">Bearbeite Deine Startseite</a>', get_edit_post_link(get_option('page_on_front'))); ?></li>
									<li><?php printf('<a href="%s" class="welcome-icon welcome-add-page">Füge eine weitere Seite hinzu</a>', admin_url('post-new.php?post_type=page')); ?></li>
                <?php endif;
                if (get_option('page_for_posts')) : ?>
									<li><?php printf('<a href="%s" class="welcome-icon welcome-write-blog">Erfasse einen Newsbeitrag</a>', admin_url('post-new.php')); ?></li>
                <?php endif; ?>
							<li><?php printf('<a href="%s" class="welcome-icon welcome-view-site">Besuche Deine Website</a>', home_url('/')); ?></li>
						</ul>
						<h3>Weitere Möglichkeiten</h3>
						<ul>
							<li><?php printf('<div class="welcome-icon welcome-widgets-menus">' . __('Manage <a href="%1$s">widgets</a> or <a href="%2$s">menus</a>') . '</div>', admin_url('widgets.php'), admin_url('nav-menus.php')); ?></li>
						</ul>
					</div><!-- .welcome-panel-column -->
					<div class="welcome-panel-column">
						<h3>Deine Ansprechperson</h3>
						<p><img src="https://nelson.lopez-be.ch/dist/img/Nelson_Lopez_CT.png" style="width: 120px;"><br>
							<strong>Nelson V. Lopez (Nelson)</strong><br>
							Handy: +41 79 102 59 55 (keine Supportanfragen)<br>
							Mail: <a href="mailto:christoph.ackermann@cubetech.ch">nelson.lopez@cubetech.ch</a><br><br>
							<a class="button" href="https://www.cubetech.ch/cubetech/team/nelson-lopez/" target="_blank">Nelson
																																																									 auf
																																																									 der
																																																									 Website
																																																									 besuchen</a><br>
					</div><!-- .welcome-panel-column welcome-panel-last -->
					<div class="welcome-panel-column">
						<h3>Deine Postypes</h3>
						<p><strong>Umgesetze  Posttypes (in arbeit)</strong><br>
							<!--Nächste Verlängerung: -<br>
							<br>
							<strong>Service Level Agreement (inaktiv)</strong><br>
							Nächste Verlängerung: -<br>
							Reaktionszeit: 8h 5x8<br>-->
							Anzhal Post: <?php echo count(get_posts()); ?><br>
						</p>
               <!--<?php //if (!empty($tracker_api)) :; ?>-->
						<!--<h3>Offene Rechnungen</h3>
						<p><strong>Total
											 CHF <?php //echo number_format($amount, 2, '.', ' '); ?> <?php //if ($amount > 0) echo '😧'; else echo '😎'; ?></strong><br>
               <?php// endif; ?>-->
					</div><!-- .welcome-panel-column welcome-panel-last -->
				</div><!-- .welcome-panel-column-container -->
			</div><!-- .custom-welcome-panel-content -->
        
        <?php
    }
    
    /**
     * Lowers the YOAST Metabox priority, thus it wont be on the upper part of the editor.
     *
     * @return String   Priority of the YOAS Metabox
     *
     * @author Marc Mentha <marc@cubetech.ch>
     * @since 1.0.0
     * @version 1.0.0
     */
    public function lowerYoastMetaboxPriority()
    {
        return 'low';
    }
    
}