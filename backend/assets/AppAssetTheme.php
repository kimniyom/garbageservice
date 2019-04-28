<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAssetTheme extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/web/theme';
    public $css = [
        'css/material-dashboard.css',
        'demo/demo.css',
    ];
    public $js = [
          'js/core/jquery.min.js',
          'js/core/popper.min.js',
          'js/core/bootstrap-material-design.min.js',
          'js/plugins/perfect-scrollbar.jquery.min.js',
          'js/plugins/moment.min.js',
            'js/plugins/sweetalert2.js',
          'js/plugins/jquery.validate.min.js',
          'js/plugins/jquery.bootstrap-wizard.js',
         'js/plugins/bootstrap-selectpicker.js',
          'js/plugins/bootstrap-datetimepicker.min.js',
          'js/plugins/jquery.dataTables.min.js',
         'js/plugins/bootstrap-tagsinput.js',
          'js/plugins/jasny-bootstrap.min.js',
          'js/plugins/fullcalendar.min.js',
          'js/plugins/jquery-jvectormap.js',
          'js/plugins/nouislider.min.js',
          'js/plugins/arrive.min.js',
         'js/plugins/chartist.min.js',
          'js/plugins/bootstrap-notify.js',
          'js/material-dashboard.js',
         'demo/demo.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
