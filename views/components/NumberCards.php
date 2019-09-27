<?php
/**
 * Basic template for the presentation of a Team component
 * The title property and at least one team of this component
 * getting validated inside the component's isValid method and therefore
 * no more validation is needed here
 *
 * @author Steeve Jeannin <steeve@cubetech.ch>
 * @since 1.0.0
 */
?>
<div class="ct-component ct-component-numbercards uk-background-transparent uk-section<?php echo $this->index === 0 ? ' first-component' : ''; ?>">
    <div class="<?php echo $this->containerClass; ?>">
        <div class="ct-grid-container">
            <div class="uk-grid uk-grid-small uk-flex-center uk-child-width-1-3@m" data-uk-grid data-uk-height-match="target: .ct-card-numbers">
                <?php foreach ($this->cards as $card) : ?>
                    <?php $card->render(); ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>