<?php
/**
 * Basic template for the presentation of a Download component
 * Both the title property and at least one download of this component
 * getting validated inside the component's isValid method and therefore
 * no more validation is needed here
 *
 * @author Steeve Jeannin <steeve@cubetech.ch>
 * @since 1.0.0
 */
?>
<div class="ct-component ct-component-download uk-background-transparent uk-section<?php echo $this->index === 0 ? ' first-component' : ''; ?>">
    <header class="ct-component-header uk-margin-bottom">
        <div class="<?php echo $this->containerClass; ?>">
            <h2 class="ct-component-title"><?php echo $this->title; ?></h2>
        </div>
    </header>
    
    <div class="ct-component-content">
        <div class="<?php echo $this->containerClass; ?>">
            <?php foreach ($this->cards as $card) : ?>
                <?php $card->render(); ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>
