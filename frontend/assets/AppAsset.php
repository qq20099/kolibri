<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '//cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css',
        'css/site.css',
        'css/styles.css',
    ];
    public $js = [
        '//cdn.jsdelivr.net/npm/flatpickr',
        '//npmcdn.com/flatpickr/dist/l10n/lv.js',
        //'js/moment-with-locales.js',
        'js/functions.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
        '\webtoucher\cookie\AssetBundle',
        //'\conquer\momentjs\MomentjsAsset',
    ];
}
