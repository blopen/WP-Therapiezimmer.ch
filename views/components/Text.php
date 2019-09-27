<?php
/**
 * Basic template for the presentation of a Title/Text component
 * Both the title and text members of this component getting
 * validated inside the components isValid method and therefore
 * no more validation is needed
 *
 * @author Marc Mentha <marc@cubetech.ch>
 * @author Steeve Jeannin <steeve@cubetech.ch>
 * @since 1.0.0
 * @version 1.0.1
 */
?>
<div class="ct-component ct-component-text uk-background-transparent uk-section<?php echo $this->index === 0 ? ' uk-padding-remove-top first-component' : ''; ?>">
    <div class="ct-component-content">
        <div class="<?php echo $this->containerClass; ?>">
            <div <?php echo $this->text_2_columns === "1" ? "class='uk-grid uk-child-width-1-2@l'" : ""; ?>>
                <div <?php echo $this->text_2_columns === "1" ? "class='ct-component-text-2-columns'" : ""; ?>>
                    <?php echo wpautop($this->text); ?>
                </div>
                <?php if ($this->text_2_columns === "1") : ?>
                    <div <?php echo $this->text_2_columns === "1" ? "class='ct-component-text-2-columns'" : ""; ?>>
                        <?php echo wpautop($this->text2); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>