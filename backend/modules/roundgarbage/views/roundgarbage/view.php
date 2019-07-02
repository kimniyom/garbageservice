<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\roundgarbage\models\Roundgarbage */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Roundgarbages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="roundgarbage-view">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

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
            'customerid',
            'id',
            'datekeep',
            'round',
            'amount',
            'keepby',
            [  
                'label' => 'สถานะการจัดเก็บ',
                'value' => $model->status==1?'จัดเก็บแล้ว':'ยังไม่ได้จัดเก็บ',
            ],
            
        ],
    ]) ?>

</div>
