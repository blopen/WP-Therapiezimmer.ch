<div class="template-part-post-list uk-padding">
    <header class="ct-header uk-section post-list-header">
        <div class="uk-container">
            <h1><?php echo _x('Beiträge Therapiezimmer', 'Title from index template', 'wptheme-basetheme'); ?></h1>
        </div>
    </header>
    <div class="uk-container ">
        <div class="uk-grid uk-child-width-1-3@m">
            <?php if ( !empty($this->logic->cards)) : ?>
                <?php foreach ($this->logic->cards as $card) : ?>
                    <?php $card->render(); ?>
                <?php endforeach; ?>
            <?php else : ?>
                <p class="uk-text-center"><?php echo _x('Keine Inhalte gefunden', 'Empty state message on archive pages', 'wptheme-basetheme'); ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>