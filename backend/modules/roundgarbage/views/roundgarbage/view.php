<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\customer\models\Customers;
use app\modules\promise\models\Promise;

/* @var $this yii\web\View */
/* @var $model app\modules\roundgarbage\models\Roundgarbage */
$promisModel = Promise::findOne(['id' => $model->promiseid]);
$this->title = $promisModel['promisenumber'];
$this->params['breadcrumbs'][] = ['label' => 'Roundgarbages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="roundgarbage-view">

    <!-- <h1><?php //Html::encode($this->title) ?></h1> -->
<?php if($model->status == 0){ ?>
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
        <?php } ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            
            'datekeep',
            'round',
            'amount',
            //'keepby',
            [  
                'label' => 'สถานะการจัดเก็บ',
                'value' => $model->status==1?'จัดเก็บแล้ว':'ยังไม่ได้จัดเก็บ',
            ],
            
        ],
    ]) ?>

</div>
