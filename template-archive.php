<?php
/**
 * Template Name: Archivseite
 */

use \Cubetech\Templates\ArchiveTemplate;

$template = new ArchiveTemplate();
$template->render();
var_dump(wp_head());