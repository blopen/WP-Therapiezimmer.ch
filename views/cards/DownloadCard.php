<article class="uk-card ct-card-download">
    <header class="ct-card-header">
        <h3 class="ct-card-title"><?php echo $this->title; ?></h3>
    </header>
    
    <div class="uk-grid ct-card-content">
        <div class="uk-width-expand ct-card-download-lead">
            <?php echo $this->isFieldValid('lead') ? $this->lead : ""; ?>
        </div>
        <div class="uk-width-auto ct-card-download-file">
            <?php $extFile = strtoupper(pathinfo($this->fileName)['extension']); ?>
            <div class="ct-card-download-extension" data-download-icon="<?php echo $extFile; ?>">
                <?php echo $extFile; ?>
            </div>
            <div class="ct-card-download-link">
                <span class="ct-card-download-link-icon" data-uk-icon="icon: download; ratio: 0.8;"></span>
                <?php echo _x("Herunterladen", "Download link", "wptheme-basetheme"); ?>
            </div>
        </div>
    </div>
    
    <a href="<?php echo $this->fileName; ?>" class="uk-position-cover"></a>
</article>