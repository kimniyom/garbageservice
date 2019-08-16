<style type="text/css">
    .row{
        margin-bottom: 10px;
    }
</style>
<?php 
    use kartik\select2\Select2;
    use yii\helpers\ArrayHelper;
    use yii\helpers\Html;

    $this->title = "ใบวางบิล / ใบแจ้งยอด";
    $this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-4 col-lg-4">
    <a href="<?php echo Yii::$app->urlManager->createUrl(['service/default/createbill','type' => 1]) ?>">
        <button type="button" class="btn btn-default btn-block btn-lg">
            ออกใบวางบิลรอบเดือน
        </button></a>
    </div>
</div>

<div class="row">
    <div class="col-md-4 col-lg-4">
    <a href="<?php echo Yii::$app->urlManager->createUrl(['service/default/createbill','type' => 2]) ?>">
        <button type="button" class="btn btn-info btn-block btn-lg">
            ออกใบวางบิลค่ามัดจำ
        </button></a>
    </div>
</div>

<div class="row">
    <div class="col-md-4 col-lg-4">
    <a href="<?php echo Yii::$app->urlManager->createUrl(['service/default/createbill','type' => 3]) ?>">
        <button type="button" class="btn btn-success btn-block btn-lg">
            ออกใบวางบิลเหมาจ่ายรายปี
        </button></a>
    </div>
</div>