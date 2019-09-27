<div class="uk-container">
    <div data-uk-filter="target: .archive-post-list">
        <?php if ($this->filters) : ?>
            <ul class="uk-subnav uk-subnav-pill">

                <li class="<?php echo $this->activeFilter === '*' ? 'uk-active' : ''; ?>" data-uk-filter-control>
                    <a class="ct-filter" href="#"><?php echo _x('Alle', 'All filter button text', 'wptheme-basetheme'); ?></a>
                </li>

                <?php foreach ($this->filters as $filter) : ?>
                    <li class="<?php echo $this->activeFilter === $filter->slug ? 'uk-active' : ''; ?>" data-uk-filter-control="[data-term*='<?php echo $filter->slug; ?>']">
                        <a class="ct-filter" href="#"><?php echo $filter->name; ?></a>
                    </li>
                <?php endforeach; ?>

            </ul>
        <?php endif; ?>

        <?php if ($this->cards) : ?>
            <ul class="archive-post-list uk-grid uk-margin-large-top uk-flex-center">

                <?php foreach ($this->cards as $card) : ?>
                    <li class="uk-margin-bottom <?php echo $this->childWidth; ?>" <?php echo $card->hasCategories() ? 'data-term="' . $card->getCategorySlugsAsString('') . '"' : ''; ?>>
                        <?php $card->render(); ?>
                    </li>
                <?php endforeach; ?>

            </ul>
        <?php else : ?>
            <p class="uk-text-center"><?php echo _x('Keine Inhalte gefunden', 'Empty state message on archive pages', 'wptheme-basetheme'); ?></p>
        <?php endif; ?>
    </div>
</div>
