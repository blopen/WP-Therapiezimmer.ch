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
<div class="ct-component ct-component-team uk-background-transparent uk-section<?php echo $this->index === 0 ? ' first-component' : ''; ?>">
    <header class="ct-component-header <?php echo $this->containerClass; ?>">
        <h2 class="ct-component-title"><?php echo $this->title; ?></h2>
    </header>
    <div class="<?php echo $this->containerClass; ?>">
        <div class="uk-grid ct-component-content uk-child-width-1-2@l" data-uk-grid>
            <?php foreach ($this->cards as $card) : ?>
                <div>
                    <?php $card->render(); ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
