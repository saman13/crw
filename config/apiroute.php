<?php

return [
    ['pattern' => 'sitemap', 'route' => 'sitemap/default/index', 'suffix' => '.xml'],
    [
        'class' => 'yii\rest\UrlRule',
        'controller' => 'v1/user',
        'pluralize'=>false,
        'prefix' => 'api',
        'extraPatterns' => [

        ],
    ],
    [
        'class' => 'yii\rest\UrlRule',
        'controller' => 'v1/news',
        'pluralize'=>true,
        'prefix' => 'api',
        'extraPatterns' => [
            'GET category/{id}' => 'category'
        ],
    ],
];