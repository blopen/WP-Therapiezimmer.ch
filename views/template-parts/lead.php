<?php if ($this->isFieldValid('page_lead')) : ?>
    <div class="uk-container<?php echo is_single() ? ' uk-container-small' : ''; ?> uk-margin-large-bottom">
        <div class="uk-text-lead"><?php echo wpautop($this->getField('page_lead')); ?></div>
    </div>
<?php endif; ?>