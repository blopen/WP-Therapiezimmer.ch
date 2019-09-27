<div class="standardcard uk-margin">
<article class="uk-card uk-card-default uk-card-body">
    <header class="ct-card-header">
        <h3 class="ct-card-title"><?php echo $this->title; ?></h3>
    </header>
    
    <?php if ($this->isFieldValid('lead')) : ?>
        <div class="ct-card-content">
            <?php echo $this->lead; ?>
        </div>
    <?php endif; ?>
    
    <a href="<?php echo $this->link; ?>" class="uk-position-cover"></a>
</article>
</div>