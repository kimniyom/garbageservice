
<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Ic Quality System';
//$this->params['breadcrumbs'][] = $this->title;
?>
<?php
$this->registerJs('
        $(document).ready(function(){;
            $(".banner").show();
            $("#mainbody").show();
        })');
?>