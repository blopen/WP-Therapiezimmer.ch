<?php

// Setup composer autoload
if ( !file_exists(__DIR__ . '/vendor/autoload.php')) {
    die('This theme requires composer. Advanced Custom Fields PRO and GravityForms PRO need to be installed manually');
}
require __DIR__ . '/vendor/autoload.php';

$theme = new Cubetech\Theme();
$theme->initialize();


