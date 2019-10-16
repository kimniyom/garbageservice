<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Bank;
/* @var $this yii\web\View */
/* @var $model app\models\Bookbank */

$this->title = $model->bookbanknumber;
$this->params['breadcrumbs'][] = ['label' => 'Bookbanks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="bookbank-view">

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
            // 'id',
            'bookbanknumber',
            'bookbankname',
            [
              'format'=>'html',
              'label' => 'ธนาคาร',
              'value' => Bank::findOne(['id' => $model->bank])['bankname']
          ],
            'branch',

        ],
    ]) ?>

</div>
