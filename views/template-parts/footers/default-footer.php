<footer class="ct-footer uk-section uk-margin-auto-top">
    <div class="uk-container">
        <div class="uk-grid uk-child-width-1-3 uk-flex uk-flex-between">
            <?php if ($this->logic->hasFooterAddress()): ?>
                <div>
                    <?php echo wpautop($this->logic->getFooterAddress()); ?>
                </div>
            <?php endif; ?>
            
            <?php if ($this->logic->hasSidebars()) : ?>
                <?php foreach ($this->logic->getSidebars() as $sidebar): ?>
                    <div>
                        <?php dynamic_sidebar($sidebar); ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        
        </div>
    </div>
    <?php
    wp_footer();
    ?>
</footer>
</body>
</html>