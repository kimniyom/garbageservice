<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Config;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\models\DatekeepSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$Config = new Config();
?>
<div class="datekeep-index">

    
    <p>
        <?= Html::a('เพิ่มวันเข้าจัดเก็บ', ['create','promiseid'=>$data['promiseid']], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    


    <?= yii2fullcalendar\yii2fullcalendar::widget(array(
        'ajaxEvents' => Url::to(['/datekeep/datekeep/jsoncalendar', 'promiseid'=>$data['promiseid']])
        ));
    ?>
</div>
