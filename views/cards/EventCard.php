<article class="uk-card ct-card-event uk-text-left">
    <span class="uk-badge ct-event-badge uk-position-relative"><?php echo $this->daysBeforeStart; ?></span>
    <header class="ct-card-header">
        <h3 class="ct-card-title"><?php echo $this->title; ?></h3>
    </header>
    
    <div class="uk-grid ct-card-content">
        <div class="uk-width-3-5@m ct-card-event-lead uk-text-small uk-margin-bottom">
            <?php echo $this->isFieldValid('description') ? $this->description : ""; ?>
        </div>
        <div class="uk-width-2-5@m">
            <?php if ($this->isFieldValid('start')) : ?>
                <div class="ct-card-event-date uk-text-small">
                    <p>
                        <span class="uk-margin-small-right" data-uk-icon="icon: calendar; ratio: 1;"></span><span><?php echo $this->start; ?></span>
                    </p>
                </div>
            <?php endif; ?>
            <?php if ($this->isFieldValid('location')) : ?>
                <div class="ct-card-event-location uk-text-small">
                    <p>
                        <span class="uk-margin-small-right" data-uk-icon="icon: location; ratio: 1;"></span><span><?php echo $this->location; ?></span>
                    </p>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <span class="arrow uk-position-top-right uk-margin-right uk-text-primary ct-hide-for-print" data-uk-icon="icon: arrow-right; ratio: 1.5;"></span>
    <a href="<?php echo $this->link; ?>" class="uk-position-cover"></a>
</article>