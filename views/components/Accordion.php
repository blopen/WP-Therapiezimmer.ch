<?php
/**
 * Basic template for the presentation of a Accordion component
 * The accordion text of this component getting
 * validated inside the components isValid method and therefore
 * no more validation is needed
 *
 * @author Jurij Kamolov <jurij@cubetech.ch>
 * @since 1.0.0
 */

use Cubetech\Helpers\Helper;

?>
<div class="ct-component ct-component-accordion uk-background-transparent uk-section<?php echo $this->index === 0 ? ' uk-padding-remove-top first-component' : ''; ?>">
    <?php if ($this->isFieldValid('title')) : ?>
        <header class="ct-component-header">
            <div class="<?php echo $this->containerClass; ?>">
                <h2 class="ct-component-title"><?php echo $this->title; ?></h2>
            </div>
        </header>
    <?php endif; ?>
    
    <div class="<?php echo $this->containerClass; ?>">
        <ul data-uk-accordion>
            <?php foreach ($this->accordions as $accordion) : ?>
                <li>
                    <a class="uk-accordion-title" href="#"><?php echo $accordion->accordion_title; ?></a>
                    <div class="uk-accordion-content">
                        <?php if (Helper::hasShortcode($accordion->accordion_content)):
                            echo do_shortcode($accordion->accordion_content);
                        else:
                            echo wpautop($accordion->accordion_content);
                        endif; ?>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>