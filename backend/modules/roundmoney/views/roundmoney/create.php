<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\roundmoney\models\Roundmoney */

$this->title = 'Create Roundmoney';
$this->params['breadcrumbs'][] = ['label' => 'Roundmoneys', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="roundmoney-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
