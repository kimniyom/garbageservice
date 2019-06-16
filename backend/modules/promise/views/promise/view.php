<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\promise\models\Promise */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Promises', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="promise-view">

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
            'place',
            'license',
            'promisedatebegin',
            'promisedateend',
            'recivetype',
            'rate',
            'ratetext',
            'levy',
            'employer',
            'payperyear',
            'payperyeartext',
            'homenumber',
            'tambon',
            'ampur',
            'changwat',
            'createat',
            'contactname',
            'contactphone',
        ],
    ]) ?>

</div>