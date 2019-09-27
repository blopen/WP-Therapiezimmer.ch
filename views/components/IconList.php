<?php
/**
 * Basic template for the presentation of a IconList component
 * The title property and at least one iconlist of this component
 * getting validated inside the component's isValid method and therefore
 * no more validation is needed here
 *
 * @author Steeve Jeannin <steeve@cubetech.ch>
 * @since 1.0.0
 */
?>
<div class="ct-component ct-component-iconlist uk-background-transparent uk-section<?php echo $this->index === 0 ? ' first-component' : ''; ?>">
    <div class="<?php echo $this->containerClass; ?>">
        <header class="ct-component-header">
            <h2 class="ct-component-title"><?php echo $this->title; ?></h2>
        </header>
        
        <?php if ( !empty($this->leadtext)) : ?>
            <div class="ct-component-iconlist-leadtext">
                <?php echo nl2br($this->leadtext); ?>
            </div>
        <?php endif; ?>
        
        <div class="ct-grid-container">
            <div class="uk-grid uk-child-width-1-3@m" data-uk-grid data-uk-height-match="target: .ct-card-iconlist">
                <?php foreach ($this->cards as $card) : ?>
                    <?php $card->render(); ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
