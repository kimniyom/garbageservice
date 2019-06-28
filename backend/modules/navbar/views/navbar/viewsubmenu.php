<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\navbar\models\Navbar */

$this->title = $model['subnavbar'];
$this->params['breadcrumbs'][] = ['label' => 'Navbars', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="navbar-view">
    <p>
        <?= Html::a('Update', ['subnavbar/update', 'id' => $model['id']], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['subnavbar/delete', 'id' => $model['id']], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php echo $model['detail'] ?>

</div>
