<?php
/**
 * Basic template for the presentation of a Map component
 *
 * @author Nelson Lopez <Nelson.lopez@cubetech.ch>
 * @version 1.0.0
 * @since 1.0.0
 */
?>
<div class="ct-component ct-component-map uk-background-transparent uk-section<?php echo $this->index === 0 ? ' uk-padding-remove-top first-component' : ''; ?>">
    <?php if ($this->isFieldValid('title')) : ?>
        <header class="ct-component-header">
            <div class="<?php echo $this->containerClass; ?> uk-margin-bottom">
                <h2 class="ct-component-title"><?php echo $this->title; ?></h2>
            </div>
        </header>
    <?php endif; ?>
    <div class="ct-component-content <?php echo $this->containerClass; ?>">
        <div class="uk-grid ct-component-content <?php echo($this->isTwoColumn ? 'uk-child-width-1-2@l' : 'uk-child-width-1-1@l'); ?>"
             data-uk-grid>
            <?php if ($this->mapAlignment) : ?>
                <div>
                    <div style="min-height: 1px" id="map-<?php echo $this->mapId; ?>" data-map
                         data-map-lon="<?php echo $this->longitude; ?>"
                         data-map-lat="<?php echo $this->latitude; ?>"></div>
                </div>
                <div>
                    <p><?php echo wpautop($this->mapText); ?></p>
                </div>
            <?php else: ?>
                <?php if ($this->isTwoColumn) : ?>
                    <div>
                        <?php if (isset($this->mapAlignment)) : ?>
                            <?php echo wpautop($this->mapText); ?>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                <div>
                    <div style="min-height: 1px" id="map-<?php echo $this->mapId; ?>" data-map
                         data-map-lon="<?php echo $this->longitude; ?>"
                         data-map-lat="<?php echo $this->latitude; ?>"></div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
