<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.extensions.*',
        'application.vendors.*',
    ),
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'My Console Application',
    // application components
    'components' => array(
        'db' => require_once('database.php'),
    ),
    'params' => array(
        'upload_dir_save' => str_replace('/protected/config', '',dirname(__FILE__) . DIRECTORY_SEPARATOR).'uploads',
        'upload_dir' => 'uploads',
   //     'upload_server' => 'http://parse.yii',
        'pageSize' => '30',
        'upload_server' => '',
        'adminEmail' => 'webmaster@example.com',
    ),
);