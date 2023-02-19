<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        /*'cache' => [
            'class' => 'yii\caching\FileCache',
        ],*/
        'api' => [
            'class' => 'common\components\Api',
            'baseUrl' => 'https://product.coraltravel.lv/EEService.svc/json/ProcessMessage',
            'login' => 'info@kolibritravel.lv',
            'password' => 'zCExW45UeNTfX3d',
        ],
        'formatter'=>[
            'class'=>\yii\i18n\Formatter::className(),
            'dateFormat' => 'long',
            'currencyCode' => 'EUR',
            'decimalSeparator' => '.',
            'thousandSeparator' => ' ',
            /*'numberFormatterOptions' => [
                NumberFormatter::DECIMAL_SEPARATOR_SYMBOL => '.',
                NumberFormatter::MAX_FRACTION_DIGITS => 0,
                NumberFormatter::FRACTION_DIGITS => 0,
            ],*/
            'nullDisplay' => '',
            'timeZone' => 'Europe/Riga',
        ],
    ],
];
