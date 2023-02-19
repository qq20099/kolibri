<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'baseUrl' => '',
        ],
        /*'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],*/
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        /*'mcache' => [
            'class' => 'yii\caching\MemCache',
            'servers' => [
                [
                    'host' => 'server1',
                    'port' => 11211,
                    'weight' => 100,
                ],
                [
                    'host' => 'server2',
                    'port' => 11211,
                    'weight' => 50,
                ],
            ],
        ],*/
        /*'cache' => [
            'class' => 'yii\caching\MemCache',
            'useMemcached' => true,
            'servers' => [
                [
                    'host' => 'localhost',
                    'port' => 11211
                ],
            ],
        ],*/
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            /*'normalizer' => [
                'class' => 'yii\web\UrlNormalizer',
                'action' => \yii\web\UrlNormalizer::ACTION_REDIRECT_TEMPORARY, // используем временный редирект вместо постоянного
            ],*/
            'rules' => [
                '' => 'site/index',
                'api' => 'site/api',
                //'parser' => 'site/parser',
                'add-order' => 'site/add-order',
                //'page' => 'site/page',
                //'defaultRoute' => 'site/page',
                'tours' => 'tours/index',
                'tours/nights' => 'tours/nights',
                'tours/get-prices' => 'tours/prices',
                'tours/specification' => 'tours/specification',
                'tours/<id:[\d]+>' => 'tours/view',
                'hotel/<id:[\d]+>' => 'hotel/view',
                /*[
                    'pattern' => 'posts',
                    'route' => 'post/index',
                    'suffix' => '/',
                    'normalizer' => false, // отключаем нормализатор для этого правила
                ],*/
                '<url:[A-Za-z0-9 -_.]+>' => 'site/page',
            ],
        ],
        'config' => [
            'class' => 'common\components\Config',
        ],
    ],
    'modules' => [
        'user' => [
            // following line will restrict access to admin controller from frontend application
            'as frontend' => 'dektrium\user\filters\FrontendFilter',
        ],
    ],
    'on beforeRequest' => function () {
        Yii::$app->params['siteSettings'] = \frontend\models\SiteSettings::findOne(1)->value;
        if (Yii::$app->params['siteSettings']->in_maintenance == 1) {
            Yii::$app->catchAll = [
              'site/maintenance',
              //'message' => Yii::$app->params['siteSettings']->maintenance_message
            ];
        }
    },
    /*'on beforeRequest' => function () {
        $pathInfo = Yii::$app->request->pathInfo;
        $query = Yii::$app->request->queryString;
        if (!empty($pathInfo) && substr($pathInfo, -1) === '/') {
            $url = '/' . substr($pathInfo, 0, -1);
            if ($query) {
                $url .= '?' . $query;
            }
            Yii::$app->response->redirect($url, 301)->send();
        }
    },*/
    'params' => $params,
];
