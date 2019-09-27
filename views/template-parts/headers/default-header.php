<header class="ct-header uk-section">
    <div class="uk-container">
        <h1 class="ct-page-title"><?php echo $this->pageTitle; ?></h1>
        <?php if ($this->isFieldValid('lead')) : ?>
            <p class="uk-text-lead ct-page-lead">
                <?php echo nl2br($this->lead); ?>
            </p>
        <?php endif; ?>
    </div>
</header>