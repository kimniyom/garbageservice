<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Customers;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use yii\helpers\Url;
use kartik\depdrop\DepDrop;


/* @var $this yii\web\View */
/* @var $model app\modules\promise\models\Promise */
/* @var $form yii\widgets\ActiveForm */

$this->title = "เลือกลูกค้า";
$this->params['breadcrumbs'][] = ['label' => 'สัญญา', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="promise-form">
    <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <div class="col-md-12 col-lg-6">
                <?php
                    $customer = Customers::find()->where(['flag'=>1,'approve'=>'Y'])->all();
                    echo $form->field($model, 'customerid')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map($customer, "id", "company"),
                        'language' => 'th',
                        'options' => [
                            'placeholder' => 'Select a customer ...',
                            'id'=>'customerselect'
                            
                        ],
                        'pluginOptions' => [
                            'allowClear' => true,
                        ],
                        'pluginEvents' => [
                            "change" => 'function() { 
                                var customerid = $(this).val();
                                $.ajax({ 
                                    url: "'.Url::to(['/promise/promise/iscustomerexpired']).'", 
                                    type: "post", 
                                    data: {customerid:customerid}, 
                                    success: function(data) { 
                                        if(data == 1)
                                        {
                                            alert("ลูกค้าท่านนี้ยังมีสัญญากับบริษัทอยู่");
                                            $("#customerselect").val(null).trigger("change");
                                        } 
                                        else if(data == -1){
                                            window.location.href = "'.Url::to(['/promise/promise/create']).'&customerid="+customerid;
                                        }
                                    }, 
                                }); 
                            }',
                        ],
                    
                    ]);
                ?>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
</div>
