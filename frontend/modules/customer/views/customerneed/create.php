<style type="text/css">
    input[type='text']{
        font-size: 24px;
        color: #000000;
    }
    #customerneed-customrttype{
        font-size: 24px;
    }

    .myFont{
        font-size: 20px;
    }

    .select2-selection {
        height: 50px !important;
        padding: 10px;
        font-size: 24px;
    }

    .customerneed-create .btn{
        font-size: 24px;
    }

    .help-block{
        color: #cc0000;
    }

    #customerneed-contact,#customerneed-address,#customerneed-detail,#CHANGWAT,#AMPUR,#TAMBON{
        font-size: 24px;
        color: #000000;
    }


</style>
<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\customer\models\Customerneed */

$this->title = 'ขอใบเสนอราคา';
//$this->params['breadcrumbs'][] = ['label' => 'Customerneeds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customerneed-create" style=" font-family: Th; font-size: 24px;">
    <div class="card" style=" box-shadow: 0px 0px 20px 0px #cccccc; border: none;">
        <div class="card-body">
            <h1 style=" font-family: Th" class="card-title"><?= Html::encode($this->title) ?></h1>
            <p class="text-danger">*กรุณากรอกข้อมูลตามจริงเพื่อความรวดเร็วในการดำเนินการ</p>
            <hr/>
            <?=
            $this->render('_form', [
                'model' => $model,
            ])
            ?>
        </div>
    </div>
</div>
<?php
$this->registerJs('
$("#customerneed-customrttype,#customerneed-typebill,#CHANGWAT,#AMPUR,#TAMBON").select2({ height: "50px",width: "100%", dropdownCssClass: "myFont" });
 ');
?>
