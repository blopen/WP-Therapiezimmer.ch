<?php

use \Cubetech\Helpers\Helper;

if ( !$this->title || empty($this->title)) {
    return;
}
?>
<article class="uk-card uk-transition-toggle ct-card-team">
    <header class="ct-card-header">
        <h3 class="ct-card-title"><?php echo $this->title; ?></h3>
    </header>
    
    <div class="ct-card-content">
        <?php if ( !empty($this->imageURL)) : ?>
            <div class="uk-card">
                <figure class="ct-card-team-image-wrapper">
                    <img class="ct-card-team-image" src="#" data-src="<?php echo $this->imageURL; ?>" data-uk-img alt="<?php echo $this->title; ?>"/>
                </figure>
                
                <div class="uk-position-bottom-right uk-transition-slide-bottom ct-card-team-icons-wrapper">
                    <?php if ( !empty($this->email)) : ?>
                        <a href="mailto:<?php echo $this->email; ?>" class="ct-card-team-icons-image" data-uk-icon="icon: mail; ratio: 1.2;"></a>
                    <?php endif; ?>
                    <?php if ( !empty($this->phone)) : ?>
                        <a href="<?php echo Helper::getTelUrl($this->phone); ?>" class="ct-card-team-icons-image" data-uk-icon="icon: receiver; ratio: 1.2;"></a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
        <?php if ( !empty($this->function)) : ?>
            <div class="ct-card-team-function">
                <?php echo $this->function; ?>
            </div>
        <?php endif; ?>
        <?php if ( !empty($this->email)) : ?>
            <div class="ct-card-team-email">
                <a href="mailto:<?php echo $this->email; ?>"><?php echo $this->email; ?></a>
            </div>
        <?php endif; ?>
        <?php if ( !empty($this->phone)) : ?>
            <div class="ct-card-team-phone">
                <a href="<?php echo Helper::getTelUrl($this->phone); ?>"><?php echo $this->phone; ?></a>
            </div>
        <?php endif; ?>
        
        <?php if (is_array($this->socialMediaAccounts) && count($this->socialMediaAccounts) > 0) : ?>
            <div class="uk-position-bottom-right ct-card-team-socialmedia-wrapper">
                <?php foreach ($this->socialMediaAccounts as $socialMediaAccount) : ?>
                    <?php echo Helper::getSocialMediaIconUrl($socialMediaAccount->social_media_link); ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</article>
