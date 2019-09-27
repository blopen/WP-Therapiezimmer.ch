<article class="uk-card uk-transition-toggle ct-card-timeline">
    <header class="ct-card-header">
        <h3 class="uk-text-bold ct-card-timeline-year"><?php echo $this->year; ?></h3>
        <?php if ($this->title) : ?>
            <div class="uk-text-bold ct-card-timeline-title"><?php echo $this->title; ?></div>
        <?php endif; ?>
    </header>
    
    <?php if ($this->description) : ?>
        <div class="ct-card-timeline-description"><?php echo wpautop($this->description); ?></div>
    <?php endif; ?>
</article>