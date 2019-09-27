<?php if ($this->isFieldValid('title') && $this->isFieldValid('subtitle')) : ?>
    <div>
        <article class="uk-card uk-card-body uk-text-center uk-card-default ct-card-numbers">
            <header class="ct-card-header">
                <h3 class="ct-card-numbers-title ct-hyphenate"><?php echo $this->title; ?></h3>
            </header>
            <div class="ct-card-numbers-divider">
                - <span class="inner-divider">-</span> -
            </div>
            <div class="ct-card-numbers-subtitle uk-text-small">
                <?php echo $this->subtitle; ?>
            </div>
        </article>
    </div>
<?php endif; ?>