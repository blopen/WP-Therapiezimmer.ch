<?php if ($this->count > 0) : ?>
    <ul class="uk-nav">
        <?php foreach ($this->menuItems as $menuItem) : ?>
            <li class="ct-menu-item <?php echo join($menuItem->classes, ' '); ?>">
                <a class="ct-menu-link" href="<?php echo $menuItem->url; ?>"><?php echo $menuItem->title; ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>