<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\garbagecontainer\models\Garbagecontainer */

$this->title = $model->garbagecontainer;
$this->params['breadcrumbs'][] = ['label' => 'สินค้าแนะนำ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="garbagecontainer-view">

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

    <p>
        <?= $modelImg?Html::img('@web/../uploads/containner/gallerry/'.$modelImg->image,['class'=>'img-thumbnail','width'=>'30%']):""?>        
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            //'code',
            'garbagecontainer',
            'size',
            'brand',
            'contain',
            'color',
            //'detail',
            [
                'format'=>'html',
                'label' => 'detail',
                'value' => $model->detail
            ],
            'price',
        ],
    ]) ?>

</div>
