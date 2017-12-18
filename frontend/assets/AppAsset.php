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
        'css/site.css',
        'css/fonts.css',
        'css/bootstrap.css',
    ];
    public $js = 
        [
            'https://maps.googleapis.com/maps/api/js?key=AIzaSyArBQOuYHVIZ0ZIJIXJ4n0GW4FtjAUwInk&callback=initMap',
            'js/RouteBoxer.js',
            'js/RouteBoxer_packed.js',
            
        ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
