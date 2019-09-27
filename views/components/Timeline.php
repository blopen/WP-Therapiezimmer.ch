<?php
/**
 * Basic template for the presentation of a Timeline component
 * The title property and at least one timeline of this component
 * getting validated inside the component's isValid method and therefore
 * no more validation is needed here
 *
 * @author Steeve Jeannin <steeve@cubetech.ch>
 * @since 1.0.0
 */
?>
<div class="uk-container">
    <div class="ct-component ct-component-timeline uk-background-transparent uk-section<?php echo $this->index === 0 ? ' first-component' : ''; ?>">
        <header class="ct-component-header">
            <h2 class="ct-component-title"><?php echo $this->title; ?></h2>
        </header>
        
        <?php if ( !empty($this->leadtext)) : ?>
            <div class="ct-component-timeline-leadtext">
                <?php echo nl2br($this->leadtext); ?>
            </div>
        <?php endif; ?>
        
        <div class="uk-align-center ct-component-timeline-start uk-position-relative">
            <div class="uk-width-1-1">
                <div class="uk-overlay uk-position-center uk-border-circle circle-1"></div>
                <div class="uk-overlay uk-position-center uk-border-circle circle-2"></div>
                <div class="uk-overlay uk-position-center uk-border-circle circle-3"></div>
                <div class="uk-overlay uk-position-center uk-padding-remove"><?php echo _x('Heute', 'Today', 'wptheme-mediapulse'); ?></div>
            </div>
        </div>
        <div class="uk-grid ct-component-content uk-child-width-1-2@l uk-grid-divider" data-uk-grid>
            <div class='uk-margin-remove-vertical uk-visible@l'></div>
            <?php foreach ($this->cards as $card) : ?>
                <div class='uk-margin-remove-vertical'>
                    <?php $card->render(); ?>
                </div>
            <?php endforeach; ?>
            <?php if (count($this->cards) % 2 === 0) : ?>
                <div class='uk-margin-remove-vertical uk-visible@l'></div>
            <?php endif; ?>
        </div>
        <div class="uk-align-center uk-margin-remove-vertical ct-component-timeline-end uk-border-circle"></div>
    </div>
</div>
