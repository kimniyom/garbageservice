<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\customer\models\Customer */

$this->title = $model->CUSTOMERNAME;
$this->params['breadcrumbs'][] = ['label' => 'Customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="customer-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ID], [
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
            'CUSTOMERNAME',
            'ADDRESS',
            'OWNER',
            'MOBILE',
            'OFFICETEL',
            'EMAIL:email',
            'STATUS',
            'APPROVE',
            'CHANGWAT',
            'AMPUR',
            'TAMBON',
            'ZIPCODE',
            'CREATE_DATE',
            'UPDATE_DATE',
            'DATE_APPROVE',
        ],
    ]) ?>

</div>
