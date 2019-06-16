<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\roundgarbage\models\Roundgarbage */

$this->title = 'Create Roundgarbage';
$this->params['breadcrumbs'][] = ['label' => 'Roundgarbages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="roundgarbage-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
