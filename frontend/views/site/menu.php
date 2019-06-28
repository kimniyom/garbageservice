<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = $menu['navbar'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h3><?= Html::encode($this->title) ?></h3>

    <?php echo $menu['detail'] ?>
</div>
