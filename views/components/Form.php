<?php
/**
 * Template for displaying a gravity form inside the pagebuilder
 * 
 * @author Alex Scherer <alex.scherer@cubetech.ch>
 * @since 1.0.0
 * @version 1.0.0
 */
?>
<div class="ct-component ct-component-form uk-background-transparent uk-section<?php echo $this->index === 0 ? ' uk-padding-remove-top' : ''; ?><?php echo $this->index === 0 ? ' first-component' : ''; ?>">
	   <div class="ct-component-content">
         <div class="<?php echo $this->containerClass; ?>">
               <?php echo do_shortcode('[gravityform id='.$this->formId.']'); ?>
          </div>
	   </div>
</div>
