<?php
/**
 * Basic template for the presentation of a Gallery component
 * The accordion text of this component getting
 * validated inside the components isValid method and therefore
 * no more validation is needed
 *
 * @author Markus Langenegger <markus@cubetech.ch>
 * @since 1.0.0
 */

use \Cubetech\Base\Media;

?>
<div class="ct-component ct-component-gallery uk-background-transparent uk-section<?php echo $this->index === 0 ? ' uk-padding-remove-top first-component' : ''; ?>">
    <?php if ($this->isFieldValid('title')) : ?>
         <header class="ct-component-header">
              <div class="<?php echo $this->containerClass; ?>">
                    <h2 class="ct-component-title"><?php echo $this->title; ?></h2>
              </div>
         </header>
    <?php endif; ?>

    <div class="<?php if( !$this->hasFilter ) {echo $this->containerClass;} else {echo $this->customContainer; }?>">
        <ul class="<?php echo $this->gridGutter; ?> <?php echo $this->startViewImage; ?> <?php echo $this->gridChilds ?> uk-text-center"
            data-uk-grid<?php echo $this->gridGutterSpecial === 'masonry' ? '="masonry: true"' : ''; ?>
            <?php if ($this->withLightbox == 1 and !$this->hasImageLink) {
                echo 'data-uk-lightbox="animation: scale"';
            } ?> >
            <?php foreach ($this->gallery as $images) : ?>
                <?php $link = isset($images->link) ? $images->link : false; ?>
                <?php !$this->hasImageLink ? $image_id = $images : $image_id = $images->image; ?>
        
                <?php $images = new Media($image_id) ?>
        
                <li style="list-style-type:none;">
                    <?php if ( !empty($link['title']) and !empty($link['url'])): ?>
                    <div class="uk-inline-clip uk-transition-toggle uk-light" tabindex="0">
                        <div class="uk-transition-fade uk-position-cover uk-overlay <?php echo $this->overlayColor ?>"></div>
                        <?php endif; ?>
                
                        <?php if ($this->withLightbox and !$this->hasImageLink): ?>
                        <a href="<?php echo $images->getImageUrl('full') ?>" data-caption="<?php echo $images->alt ?>">
                            <div class="uk-inline-clip uk-transition-toggle" tabindex="0">
                                <?php endif; ?>
                        
                                <img data-src="<?php echo $images->getImageUrl('half') ?>" src="#" title="<?php echo $images->alt ?>" alt="<?php echo $images->alt ?>" data-uk-img>
                        
                                <?php if ($this->withLightbox and !$this->hasImageLink): ?>
                                <div class="uk-transition-fade uk-position-cover uk-overlay <?php echo $this->overlayColor ?> uk-flex uk-flex-center uk-flex-middle">
                                    <span class="uk-transition-fade" data-uk-icon="icon: plus; ratio: 1.5"></span>
                                </div>
                            </div>
                        </a>
                    <?php endif; ?>
                
                        <?php if ( !empty($link['title']) and !empty($link['url'])): ?>
                        <div class="uk-position-center">
                            <div class="uk-transition-slide-top-medium uk-text-primary">
                                <span data-uk-icon="icon: search; ratio: 1.5"></span></div>
                            <div class="uk-transition-slide-bottom-medium uk-text-primary">
                                <h4 class="uk-margin-remove"><?php echo $link['title']; ?></h4></div>
                        </div>
                        <a class="uk-position-cover" href="<?php echo $link['url']; ?>" <?php if ( !empty($link['target'])) { echo 'target="_blank"'; } ?>></a>
                    </div>
                <?php endif; ?>
                </li>
    
            <?php endforeach; ?>
          </ul>
     </div>
</div>