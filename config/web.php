<?php
use Symfony\Component\Dotenv\Dotenv;
$dotenv = new Dotenv();
if file_exists('../.env') {
    $dotenv->load('../.env');    
}
$_ENV = array_merge(getenv(), $_ENV);

$params = require __DIR__ . '/params.php';

$config = [
    'id' => $_ENV['APP_ID'],
    'name' => $_ENV['APP_NAME'],
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'modules' => [
        'admin' => [
            'layout' => 'left-menu',
            'mainLayout' => '@app/views/layouts/main.php',
            'class' => 'mdm\admin\Module',
            'controllerMap' => [
                'assignment' => [
                    'class' => 'mdm\admin\controllers\AssignmentController',
                    'userClassName' => 'app\models\User',
                    'idField' => 'id',
                    'usernameField' => 'username',
                    'extraColumns' => [
                        'email',
                        'created_date',
                    ],
                    'searchClass' => 'app\models\UserSearch'
                ],
            ],
            'menus' => [
                'user' => null,
                'User' => [
                    'label' => 'User',
                    'url' => ['/user/index'],
                ],
            ],
        ],
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            // '*',
            'site/*',
            // 'admin/*',
            // 'some-controller/some-action',
            // The actions listed here will be allowed to everyone including guests.
            // So, 'admin/*' should not appear here in the production, of course.
            // But in the earlier stages of your development, you may probably want to
            // add a lot of actions here until you finally completed setting up rbac,
            // otherwise you may not even take a first step.
        ],
    ],
    'components' => [
        'helpers' => [
            'class' => 'app\components\Helpers',
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '9DYHBCWrOtQbyJIiNH0HKKcSQvOsFE4i',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'db' => 'dbUser',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => $_ENV['DB_SPK_CONNECTION'] . ':host=' . $_ENV['DB_SPK_HOST'] . ';port=' . $_ENV['DB_SPK_PORT'] . ';dbname=' . $_ENV ['DB_SPK_NAME'],
            'username' => $_ENV['DB_SPK_USER'],
            'password' => $_ENV['DB_SPK_PASSWORD'],
            'charset' => 'utf8',
            'tablePrefix' => $_ENV['DB_SPK_PREFIX'],
        ],
        'dbUser' => [
            'class' => 'yii\db\Connection',
            'dsn' => $_ENV['DB_USER_CONNECTION'] . ':host=' . $_ENV['DB_USER_HOST'] . ';port=' . $_ENV['DB_USER_PORT'] . ';dbname=' . $_ENV ['DB_USER_NAME'],
            'username' => $_ENV['DB_USER_USER'],
            'password' => $_ENV['DB_USER_PASSWORD'],
            'charset' => 'utf8',
            'tablePrefix' => $_ENV['DB_USER_PREFIX'],
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            // Disable index.php
            'showScriptName' => false,
            // Disable r= routes
            'enablePrettyUrl' => true,
            'rules' => [
                // '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ],
        ],
    ],
    'params' => $params,
];
if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
        'allowedIPs' => ['*'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        // 'allowedIPs' => ['127.0.0.1', '::1'],
        'allowedIPs' => ['*'],
    ];
}

return $config;
