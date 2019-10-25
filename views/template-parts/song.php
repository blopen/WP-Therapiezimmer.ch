
<?php
$overviewURL = get_option('options_archive_job');
$mail = get_option("options_mail_job");
?>
<?php if (!empty($mail) || !empty($overviewURL)) : ?>
<div class="uk-container job_footer">
    <div class="job_footer_left">
        <?php if (!empty($overviewURL)) : ?>
            <a class="uk-button back control" href="<?php echo get_page_link($overviewURL); ?>"><?php echo _x('Zur Stellenübersicht', 'to job overview', 'wptheme-ditzler'); ?></a>
        <?php endif; ?>
    </div>
    <div class="job_footer_right">
        <?php if (!empty($mail)) : ?>
            <a class="standard control job_footer_apply uk-button" href="mailto:<?php echo $mail; ?>"><?php echo _x('Auf diese Stelle bewerben', 'to job overview', 'wptheme-ditzler'); ?></a>
        <?php endif; ?>
    </div>
</div>
<?php endif; ?>