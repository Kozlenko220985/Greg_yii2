<?php

namespace backend\assets;
use yii\web\AssetBundle;

class AuditColumnAssetBundle extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $js = [
        'js/audit.helper.js'
    ];
    public $depends = [
        'yii\bootstrap\BootstrapPluginAsset'
    ];
}