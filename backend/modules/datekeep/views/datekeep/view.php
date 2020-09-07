<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Datekeep */


$this->params['breadcrumbs'][] = ['label' => 'Datekeeps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="datekeep-view">

    

    <p>
        <?= Html::a('Update', ['update', 'promiseid' => $data['model']->promiseid, 'datekeep' => $data['model']->datekeep], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'promiseid' => $data['model']->promiseid, 'datekeep' => $data['model']->datekeep], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'ต้องการลบวันที่เข้าจัดเก็บ ?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $data['model'],
        'attributes' => [
            //'promiseid',
            'datekeep',
            //'status',
        ],
    ]) ?>

</div>
