<?php 
    use kartik\select2\Select2;
    use yii\helpers\ArrayHelper;
    use yii\helpers\Html;

    $this->title = "บันทึกการจัดเก็บ";
    $this->params['breadcrumbs'][] = $this->title;
?>

<div class="service-default-index">
    <div class="row">
        <div class="col-md-6 col-lg-6 col-sm-12">
        <label>เลือกเลขที่สัญญา</label>
        <?php
            $listPromise = ArrayHelper::map($promise, 'id', 'promisenumber');
            echo Select2::widget([
                'name' => 'promise',
                'value' => '',
                'data' => $listPromise,
                'options' => [
                    'multiple' => false, 
                    'placeholder' => 'Select Promise ...',
                    'onchange' => 'getRound(this.value)',
                ],
            ]);
        ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-lg-6 col-sm-12">
        <label>รอบจัดเก็บ</label>
        <div id="round"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function getRound(promise){
        var url = "<?php echo Yii::$app->urlManager->createUrl(['service/default/getround']) ?>";
        var data = {promiseid: promise};
        $.post(url,data,function(datas){
            $("#round").html(datas);
        });
    }
</script>
