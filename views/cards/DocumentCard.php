<?php
use \Cubetech\Helpers\Helper;
if (!$this->title || empty($this->title)) {
    return;
}
?>
<article class="uk-card uk-card-hover uk-transition-toggle ct-card-song uk-padding">
    <a href="<?php echo $this->url; ?>">
        <header class="ct-card-header">
            <h3 class="ct-card-title"><?php echo $this->title; ?></h3>
        </header>

        <div class="ct-card-content">
            <?php if (!empty($this->url)) : ?>
                <div class="uk-card">

                    <figure class="ct-card-song-image-wrapper">
                        <img class="ct-card-song-image" src="#" data-src="<?php echo $this->imageURL; ?>" data-uk-img alt="<?php echo $this->title; ?>" />
                    </figure>

                    <div class="uk-position-bottom-right uk-transition-slide-bottom ct-card-song-icons-wrapper">
                        <?php if (!empty($this->email)) : ?>
                            <a href="mailto:<?php echo $this->email; ?>" class="ct-card-song-icons-image" data-uk-icon="icon: mail; ratio: 1.2;"></a>
                        <?php endif; ?>
                        <?php if (!empty($this->phone)) : ?>
                            <a href="<?php echo Helper::getTelUrl($this->phone); ?>" class="ct-card-song-icons-image" data-uk-icon="icon: receiver; ratio: 1.2;"></a>
                        <?php endif; ?>
                    </div>

                </div>
    </a>
<?php endif; ?>
<?php if (!empty($this->function)) : ?>
    <div class="ct-card-song-function">
        <?php echo $this->function; ?>
    </div>
<?php endif; ?>
<?php if (!empty($this->email)) : ?>
    <div class="ct-card-song-email">
        <a href="mailto:<?php echo $this->email; ?>"><?php echo $this->email; ?></a>
    </div>
<?php endif; ?>
<?php if (!empty($this->phone)) : ?>
    <div class="ct-card-song-phone">
        <a href="<?php echo Helper::getTelUrl($this->phone); ?>"><?php echo $this->phone; ?></a>
    </div>
<?php endif; ?>

<?php if (is_array($this->socialMediaAccounts) && count($this->socialMediaAccounts) > 0) : ?>
    <div class="uk-position-bottom-right ct-card-song-socialmedia-wrapper">
        <?php foreach ($this->socialMediaAccounts as $socialMediaAccount) : ?>
            <?php echo Helper::getSocialMediaIconUrl($socialMediaAccount->social_media_link); ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
</div>

</article>