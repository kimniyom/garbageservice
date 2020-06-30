<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Confirmform */

$this->title = 'แบบยืนยันลูกค้าเพื่อเข้าเก็บขยะติดเชื้อ';
$this->params['breadcrumbs'][] = ['label' => 'Confirmforms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="confirmform-create">
 

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
