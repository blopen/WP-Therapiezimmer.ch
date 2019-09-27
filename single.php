<?php

use \Cubetech\Templates\SingleTemplate;

$template = new SingleTemplate();
$template->render();
var_dump(wp_head());
