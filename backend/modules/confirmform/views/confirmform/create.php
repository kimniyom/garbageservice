<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Confirmform */

$this->title = 'Create Confirmform';
$this->params['breadcrumbs'][] = ['label' => 'Confirmforms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="confirmform-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
