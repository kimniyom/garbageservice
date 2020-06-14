<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\customer\models\Customerneed */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Customerneeds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="customerneed-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'customername',
            'customrttype',
            'address',
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
            'd_update',
        ],
    ]) ?>

</div>
