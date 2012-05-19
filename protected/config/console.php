<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.extensions.*',
    ),
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'My Console Application',
    // application components
    'components' => array(
        'db' => require_once('database.php'),
    ),
);