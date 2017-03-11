<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'aliases' => [
        '@mdm/admin' => '@app/vendor/mdmsoft/yii2-admin',
        '@dektrium/user' => '@app/vendor/dektrium/yii2-user',

    ],
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],

    'modules' => [

        'user' => [
            'class' => 'dektrium\user\Module',
            'enableConfirmation' => false,
            'enableUnconfirmedLogin' => true,
        ],

        'gridview' => [
            'class' => 'kartik\grid\Module',
        ],

        'dynamicrelations' => [
            'class' => '\synatree\dynamicrelations\Module'
        ],

        'datecontrol' => [
            'class' => 'kartik\datecontrol\Module',

            'displaySettings' => [
                'date' => 'd-m-Y',
                'time' => 'H:i:s A',
                'datetime' => 'd-m-Y H:i:s A',
            ],

            'saveSettings' => [
                'date' => 'Y-m-d',
                'time' => 'H:i:s',
                'datetime' => 'Y-m-d H:i:s',
            ],

            'autoWidget' => true,

        ],
        'admin' => [
            'class' => 'mdm\admin\Module',
            'layout' => 'left-menu',

            'controllerMap' => [
                'assignment' => [
                    'class' => 'mdm\admin\controllers\AssignmentController',
                    'userClassName' => 'dektrium\user\models\User',
                    'idField' => 'id'
                ]
            ],
            'menus' => [
                'assignment' => [
                    'label' => 'Acceso Total'
                ],
                /* 'route' => null,*/ // disable menu
            ],
        ]
    ],
    'components' => [
        'user' => [
            'identityClass' => 'dektrium\user\models\User',
            'enableAutoLogin' => true,
        ],
        'request' => [
            'cookieValidationKey' => 'Dt_AgaSjnjntEh9PM2MiB6S36L4-JaMc',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],

        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
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
        'assetManager' => [
            'linkAssets' => true,
            'bundles' => [
                'dmstr\web\AdminLteAsset' => [
                    'skin' => 'skin-red-light',
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),

        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],

        'urlManager' => [
            'showScriptName' => false,
            'enablePrettyUrl' => true,
            'enableStrictParsing' => false,
            'rules' => [

                /** Sesion **/
                ['pattern' => '/sesion', 'route' => '/user/security/login', 'suffix' => '.php'],

                /** Usuario **/
                ['pattern' => '/actualizar/<id:\d+>', 'route' => '/usuario/update'],



            ],
        ],

    ],

    'as beforeRequest' => [

        'class' => 'yii\filters\AccessControl',

        'rules' => [
            [
                'allow' => true,
                'actions' => ['login', 'forgot'],
            ],
            [
                'allow' => true,
                'roles' => ['@'],
            ],
        ],
        'denyCallback' => function () {
            return Yii::$app->response->redirect(['user/security/login']);
        },
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['*', '172.17.4.97']
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['*'],
        'generators' => [
            'kartikgii-crud' => ['class' => 'warrence\kartikgii\crud\Generator'],
            'sintret' => [
                'class' => 'sintret\gii\generators\crud\Generator',
            ],
            'sintretModel' => [
                'class' => 'sintret\gii\generators\model\Generator'
            ]
        ]
    ];
}

return $config;
