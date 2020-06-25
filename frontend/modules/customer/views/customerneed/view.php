<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\typecustomer;

/* @var $this yii\web\View */
/* @var $model app\modules\customer\models\Customerneed */

$this->title = $model->title;
//$this->params['breadcrumbs'][] = ['label' => 'Customerneeds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="customerneed-view">
    <div style="text-align: center;">
        <h1 class="text-success"><i class="fa fa-check"></i><br/>ระบบได้รับคำขอของท่านแล้ว ทางบริษัทจะติดต่อกลับเมื่อทำใบเสนอราคาเสร็จทันที</h1>
    </div>
    <hr/>
    <h2><?= Html::encode($this->title) ?></h2>
    <!--
    <p>
        <?php //Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>
    -->
    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
            'customername',
            //'customrttype',
            [
                //'format'=>'html',
                'label' => 'ประเภทสถานพยาบาล',
                'value' => \app\models\Typecustomer::findOne(["id" => $model->customrttype])['typename']
            ],
            //'address',
            [
                'format' => 'html',
                'label' => 'ที่อยู่',
                'value' => $model->address . " ต." . common\models\Tambon::findOne(["tambon_id" => $model->tambon])['tambon_name']
                . " อ." . common\models\Ampur::findOne(["ampur_id" => $model->amphur])['ampur_name']
                . " จ." . common\models\Changwat::findOne(["changwat_id" => $model->changwat])['changwat_name']
                . " " . $model->zipcode
            ],
            'tel',
            'contact',
            'dayopen',
            'location',
            'roundofweek',
            'roundofmount',
            'priceofmount',
            'priceofyear',
            'typebill',
            'roundprice',
            'detail:ntext',
        //'d_update',
        ],
    ])
    ?>

</div>
