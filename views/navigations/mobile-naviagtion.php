<?php
use \Cubetech\Base\ViewController;
?>
<nav class="uk-navbar uk-navbar-container uk-hidden@m ct-mobile-navigation">

    <a class="uk-navbar-item uk-logo" href="<?php echo get_home_url(); ?>">
        <?php if ($this->logo) : ?>
            <figure class="ct-logo-wrap">
                <img class="ct-logo" src="<?php echo $this->logo->getImageUrl('logo'); ?>" alt="<?php echo $this->logo->alt; ?>">
            </figure>
        <?php endif; ?>
    </a>

    <button class="uk-navbar-toggle ct-modal-open uk-margin-auto-left" data-uk-navbar-toggle-icon data-uk-toggle="target: #mobile-navigation"></button>
    <button class="uk-modal-close ct-modal-close uk-position-top-right" type="button" data-uk-close data-uk-toggle="target: #mobile-navigation"></button>
    <button class="uk-modal-close ct-modal-close-premium uk-position-top-right" type="button" data-uk-close data-uk-toggle="target: #mobile-premium-navigation"></button>
    <div id="mobile-navigation" class="mobile-navigation-modal" data-uk-modal>

        <?php if ($this->count > 0) : ?>
            <ul class="uk-nav-primary uk-nav-parent-icon" data-uk-nav="multiple: true">
                <?php foreach ($this->menuItems as $menuItem) : ?>
                    <?php if ($menuItem->hasChildren && !$menuItem->getField('products_element')) : ?>
                        <li class="ct-accordion-item uk-parent <?php echo join($menuItem->classes, ' '); ?> <?php echo in_array('active-parent', $menuItem->classes) ? 'uk-open' : ''; ?>">
                            <a class="ct-accordion-link" href="#"><?php echo $menuItem->title; ?></a>
                            <ul class="uk-nav-sub mobile-sub-accordion ct-accordion-sub-menu">
                                <?php foreach ($menuItem->children as $subMenuItem) : ?>
                                    <?php if ($subMenuItem->hasChildren) : ?>
                                        <li class="ct-accordion-item uk-parent <?php echo join($menuItem->classes, ' '); ?> <?php echo in_array('active-parent', $menuItem->classes) ? 'uk-open' : ''; ?>">
                                            <ul data-uk-accordion>
                                                <li class="ct-accordion-item product-accordion">
                                                    <a class="uk-accordion-title ct-accordion-sub-link" href="#"><span><?php echo $menuItem->title; ?></span><span class="accordion-arrow" data-uk-icon="icon: chevron-down; ratio: 1"></span></a>
                                                    <div class="uk-accordion-content">
                                                        <ul class="ct-accordion-sub-menu">
                                                            <?php foreach($subMenuItem->children as $subPage) : ?>
                                                                <li class="ct-accordion-item ct-accordion-sub-item <?php echo join($subPage->classes, ' '); ?> <?php echo in_array('active-parent', $subPage->classes) ? 'uk-open' : ''; ?>">
                                                                   <a class="ct-accordion-link ct-accordion-sub-link" href="<?php echo $subPage->url; ?>"><span><?php echo $subPage->title; ?></span><span class="" data-uk-icon="icon: arrow-right; ratio: 1.5"></span></a>
                                                               </li>
                                                            <?php endforeach; ?>
                                                        </ul>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                    <?php else : ?>
                                        <li class="ct-accordion-item ct-accordion-sub-item <?php echo join($subMenuItem->classes, ' '); ?>">
                                            <a class="ct-accordion-link ct-accordion-sub-link" href="<?php echo $subMenuItem->url; ?>"><span><?php echo $subMenuItem->title; ?></span><span class="uk-text-primary" data-uk-icon="icon: arrow-right; ratio: 1.5"></span></a>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                    <?php elseif ($menuItem->getField('products_element')) : ?>
                        <li class="ct-accordion-item uk-parent <?php echo join($menuItem->classes, ' '); ?> <?php echo in_array('active-parent', $menuItem->classes) ? 'uk-open' : ''; ?>">
                            <a class="ct-accordion-link" href="#"><span><?php echo $menuItem->title; ?></span></a>
                            <ul data-uk-accordion>
                                <?php foreach ($this->productNavigation as $productItem) : ?>
                                    <li class="ct-accordion-item product-accordion product-category-<?php echo $productItem->color; ?>">
                                        <a class="uk-accordion-title ct-accordion-sub-link" href="#"><span><?php echo $productItem->title; ?></span><span class="accordion-arrow" data-uk-icon="icon: chevron-down; ratio: 1"></span></a>
                                        <div class="uk-accordion-content">
                                             <ul class="ct-accordion-sub-menu">
                                                <?php foreach ($productItem->posts as $sensor) : ?>                    
                                                    <li class="ct-accordion-item ct-accordion-sub-item">
                                                        <a class="ct-accordion-link ct-accordion-sub-link" href="<?php echo $sensor->getLink(); ?>"><span><?php echo $sensor->getTitle(); ?></span><span class="" data-uk-icon="icon: arrow-right; ratio: 1.5"></span></a>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                    <?php elseif ($menuItem->getField('home_element') || !$menuItem->hasChildren) : ?>
                        <li class="ct-accordion-item <?php echo join($menuItem->classes, ' '); ?>">
                            <a class="ct-accordion-link" href="<?php echo $menuItem->url; ?>"><span><?php echo $menuItem->title; ?></span><span data-uk-icon="icon: arrow-right; ratio: 1.5"></span></a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <ul class="uk-navbar-nav uk-flex-center">
            <?php include ViewController::getViewPath('navigations/language-switcher'); ?>
        </ul>
        <div class="uk-text-center ct-mobile-menu-item">
            <a class="ct-menu-link ct-search-item" href="#search-modal" data-uk-toggle><span class="uk-margin-right" data-uk-search-icon></span><?php echo _x('Suche...', 'Placeholdertext mobile navigation item', 'wptheme-sensortec'); ?></a>
        </div>
    </div>
</nav>