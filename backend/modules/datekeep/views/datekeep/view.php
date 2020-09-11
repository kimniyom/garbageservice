<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Config;
$Config = new Config();
/* @var $this yii\web\View */
/* @var $model app\models\Datekeep */


$this->params['breadcrumbs'][] = ['label' => 'Datekeeps', 'url' => ['index','promiseid'=> $data['model']->promiseid]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="datekeep-view">

    <input type="hidden" id="dateId" value="<?php echo $data['model']['id'] ?> "/>

    <p>
        <?php //Html::a('Update', ['update', 'promiseid' => $data['model']->promiseid, 'datekeep' => $data['model']->datekeep], ['class' => 'btn btn-primary']) ?>
        <?php /*Html::a('ลบ', ['delete', 'promiseid' => $data['model']->promiseid, 'id' => $data['model']->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'ต้องการลบวันที่เข้าจัดเก็บ ?',
                'method' => 'post',
            ],
        ]) 
         */ ?>
         
    </p>

    <?= DetailView::widget([
        'model' => $data['model'],
         'attributes' => [
            [
                'label' => 'วันเข้าจัดเก็บ',
                'value' => $Config->dayInweekKeyFull($dayname)." ที่ ". $Config->thaidate($data['model']['datekeep']),
            ],
         ],
     ]) ?>

   
</div>
