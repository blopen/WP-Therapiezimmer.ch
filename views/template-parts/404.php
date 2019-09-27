<main class="ct-template-404">
    <section class="uk-section">
        <header class="ct-header">
            <div class="uk-text-center">
                <h1 class="ct-page-title">Error: 404</h1>
            </div>
        </header>
        <div class="content-404">
            <div class="uk-container uk-text-center">
                <h3 class="error-404-msg"><?php echo _x("Hier können wir leider nichts finden.", "Error message on 404 page.", "wptheme-basetheme"); ?></h3>
                
                <p class="error-404-msg">
                    <?php echo _x('Sie werden in', '404 redirect message (before second indicator)', 'wptheme-basetheme'); ?>
                    <span data-no-found-counter-index>10</span>
                    <?php echo _x('Sekunden weitergeleitet.', '404 redirect message (after second indicator)', 'wptheme-basetheme'); ?>
                </p>
                <a class="uk-button uk-button-primary" href="<?php echo get_site_url(); ?>">
                    <?php echo _x('Zur Startseite', 'Back to homepage button-text', 'wptheme-basetheme'); ?>
                </a>
            </div>
        </div>
    </section>
</main>