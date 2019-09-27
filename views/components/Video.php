<div class="ct-component ct-component-video uk-background-transparent uk-section<?php echo $this->index === 0 ? ' first-component' : ''; ?>">
    <div class="<?php echo $this->containerClass; ?>">
        <div class="uk-position-relative">
            
            <video class="ct-video uk-width-1-1" controls data-video-id="<?php echo $this->videoId; ?>" data-uk-video="autoplay: <?php if ($this->overlay): echo "false"; else: echo "inview"; endif; ?>">
                <source src="<?php echo $this->video->src; ?>" type="video/mp4">
            </video>
            
            <?php if ($this->overlay) : ?>
                <img src="#" data-src="<?php echo $this->overlay->getImageUrl('half'); ?>" alt="<?php echo $this->overlay->alt; ?>" class="video-overlay-image uk-position-cover" data-uk-img/>
                <div class="ct-video-overlay-wrap uk-padding-small uk-position-cover" data-play-video="<?php echo $this->videoId; ?>">
                    <div class="uk-position-cover ct-transparent-overlay">
                        <span class="ct-play-button uk-icon uk-position-center uk-text-primary" data-uk-icon="icon: play-circle; ratio: 5"></span>
                    </div>
                </div>
            <?php endif; ?>
        
        </div>
    </div>
</div>