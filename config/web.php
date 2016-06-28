<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '1',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
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
        'db' => require(__DIR__ . '/db.php'),

        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => require(__DIR__ . '/apiroute.php')
        ],

    ],
    'params' => $params,

    'modules' => [
        'v1' => [
            'class' => 'app\module\rest\v1\Module',
            'basePath'  => '@app/module/rest/v1'
        ],

        'sitemap' => [
            'class' => 'himiklab\sitemap\Sitemap',
            'models' => [
                // your models
                'app\models\News',
                // or configuration for creating a behavior
//                [
//                    'class' => 'app\models\News',
//                    'behaviors' => [
//                        'sitemap' => [
//                            'dataClosure' => function ($model) {
//                                /** @var self $model */
//                                return [
////                                    'loc' => Url::to($model->id, true),
////                                    'lastmod' => strtotime($model->id),
////                                    'changefreq' => SitemapBehavior::CHANGEFREQ_DAILY,
////                                    'priority' => 0.8
////
//                                    'loc' => 'aaaa',
//                                    'lastmod' => 'aaaa',
//                                    'changefreq' => 'aaaa',
//                                    'priority' => 0.8
//                                ];
//                            }
//                        ],
//                    ],
//                ],
            ],
            'enableGzip' => true, // default is false
            'cacheExpire' => 1, // 1 second. Default is 24 hours
        ],
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
