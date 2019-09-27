<div class="ct-component ct-component-image uk-background-transparent<?php echo $this->hasPadding ? ' uk-section' : ''; ?><?php echo $this->index === 0 ? ' first-component' : ''; ?>">
    <div class="<?php echo $this->containerClass; ?>">
        <figure class="image-wrap">
        <?php echo $this->image->getUikitImage('full'); ?>
            <?php if ($this->isFieldValid('caption')) : ?>
                <figcaption class="image-caption uk-text-small"><?php echo $this->caption; ?></figcaption>
            <?php endif; ?>
        </figure>
    </div>
</div>