<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Parse',
    'language' => 'ru',
    'defaultController' => 'law',
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.vendors.*',
    ),
    'modules' => array(
       
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => '123',)
    ),
    // application components
    'components' => array(
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
            'loginUrl' => array('/site/login'),
        ),
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules' => array(
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ),
        'db' => require('database.php'),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'sites/error',
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        'upload_dir' => 'uploads',
        'upload_dir_save'=>'uploads',
        'pageSize' => '30',
   //     'upload_server' => 'http://parse.yii',
        'upload_server' => '',
        'adminEmail' => 'webmaster@example.com',
    ),
);
