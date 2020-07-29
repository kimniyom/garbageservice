<?php
/* @var $this yii\web\View */
/* @var $model app\modules\promise\models\Promise */

$this->title = 'แก้ไขสัญญาเลขที่ ' . $model->promisenumber;
$this->params['breadcrumbs'][] = ['label' => 'สัญญา', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->promisenumber, 'url' => ['viewsubpromise', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="promise-update">
    <p class="text-danger">การแก้ไขข้อมูล สัญญาข้อมูลลูกข่ายจะถูกแก้ไขตามด้วย</p>
    <?=
    $this->render('_form_subpromise', [
        'model' => $model,
        'customer' => $customer,
        'error' => $error,
    ])
    ?>
</div>
