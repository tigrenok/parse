<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Parse',
    'language' => 'ru',
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.modules.user.models.*',
        'application.modules.user.components.*',
        'application.vendors.*',
        'application.modules.srbac.controllers.SBaseController'
    ),
    'modules' => array(
        'srbac' => array(
            'userclass' => 'User',
            'userid' => 'id',
            'username' => 'username',
            'debug' => false,
            'delimeter'=>"@",
            'pageSize' => 15,
            'superUser' => 'Administrator',
            'css' => 'srbac.css',
            'layout' => 'application.views.layouts.main',
            'notAuthorizedView' => 'srbac.views.authitem.unauthorized',
            'alwaysAllowed'=>array(),
           // 'userActions' => array('show', 'View', 'List'),
            'listBoxNumberOfLines' => 15,
            'imagesPath' => 'srbac.images',
            'imagesPack' => 'tango',
            'iconText' => false,
            'header' => 'srbac.views.authitem.header',
            'footer' => 'srbac.views.authitem.footer',
            'showHeader' => true,
            'showFooter' => true,
            //'alwaysAllowedPath' => 'srbac.components',
        ),
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => '123',),
        'user',
    ),
    // application components
    'components' => array(
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
            'loginUrl' => array('/user/login'),
        ),
        'authManager' => array(
            'class' => 'srbac.components.SDbAuthManager',
            'connectionID' => 'db',
            'itemTable' => 'items',
            'assignmentTable' => 'assignments',
            'itemChildTable' => 'itemchildren',
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
        'mailer' => array(
            'class' => 'application.extensions.mailer.EMailer',
            'pathViews' => 'application.views.email',
        //  'pathLayouts' => 'application.views.email.layouts'
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
        'upload_server' => 'http://parse.yii',
        'adminEmail' => 'webmaster@example.com',
    ),
);