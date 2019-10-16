<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Bookbank */

$this->title = 'เพิ่มบัญชีธนาคาร';
$this->params['breadcrumbs'][] = ['label' => 'Bookbanks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bookbank-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
