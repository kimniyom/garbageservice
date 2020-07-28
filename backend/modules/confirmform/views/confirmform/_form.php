<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\depdrop\DepDrop;
use kartik\date\DatePicker;
use kartik\time\TimePicker;
use app\models\ConfirmformMethodpayment;
use app\models\ConfirmformPayment;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Confirmform */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="confirmform-form">
    <div class="row">
        <div class="col-md-6 col-lg-8">
            <div class="box box-success">
                <div class="box-header">การเข้าจัดเก็บ</div>
                <div class="box-body"  id="box-right" style=" position: relative; overflow: auto;">
                    <div class="well">
                        <?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_VERTICAL]);?>   
                        <div class="row">
                            <div class="col-sm-5">
                                <label>รอบวันเข้าจัดเก็บ</label>
                                <?= $form->field($model, 'roundkeep_sunday')->checkbox() ?>
                                <?= $form->field($model, 'roundkeep_monday')->checkbox() ?>
                                <?= $form->field($model, 'roundkeep_tueday')->checkbox() ?>
                                <?= $form->field($model, 'roundkeep_wednesday')->checkbox() ?>
                                <?= $form->field($model, 'roundkeep_thursday')->checkbox() ?>
                                <?= $form->field($model, 'roundkeep_friday')->checkbox() ?>
                                <?= $form->field($model, 'roundkeep_saturday')->checkbox() ?>
                                <?= $form->field($model, 'roundkeep_day')->widget(DatePicker::classname(), ['language' => 'th', 'type' => DatePicker::TYPE_INPUT, 'pluginOptions' => [
                                        'autoclose' => true,
                                        'format' => 'yyyy-mm-dd',
                                        'todayHighlight' => true,
                                    ],
                                    'options' => ['class' => 'form-control', 'autocomplete' => 'off']]); ?>

                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                                <label>วันที่เข้าจัดเก็บ</label>
                                <?= $form->field($model, 'timeperiod_morning')->checkbox() ?>
                                <?= $form->field($model, 'timeperiod_affternoon')->checkbox() ?>
                                <?= $form->field($model, 'timeperiod_time')->widget(TimePicker::classname(), [
                                    'pluginOptions' => [
                                        'showMeridian' => false,
                                        'autoclose' => true,
                                        'minuteStep' => 1,
                                        'secondStep' => 5,
                                        'defaultTime'=>false
                                    ],
                                    'options' => [
                                        'readonly' => false
                                ],]);?>
                                <?= $form->field($model, 'amount')->textInput() ?>
                            </div>
                        </div>
                       
                       
                    </div>
                </div>

                <div class="box-header">เอกสารที่ต้องนำไปพร้อมพนักงานจัดเก็บขยะ</div>
                <div class="box-body"  id="box-right" style=" position: relative; overflow: auto;">
                    <div class="well">
                        <div class="row">
                            <div class="col-sm-8">
                                <label>1.เอกสารวางบิล</label>
                                <?= $form->field($model, 'billdoc_originalinvoice')->checkbox() ?>
                                <?= $form->field($model, 'billdoc_copyofinvoice')->checkbox() ?>
                                <?= $form->field($model, 'billdoc_originalreceipt')->checkbox() ?>
                                <?= $form->field($model, 'billdoc_copyofreceipt')->checkbox() ?>
                                <?= $form->field($model, 'billdoc_copyofbank')->checkbox() ?>
                                <?= $form->field($model, 'billdoc_etc')->checkbox() ?>
                                <?= $form->field($model, 'billdoc_etctext')->textarea(['rows' => 2]) ?>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-8">
                              
                                <?= $form->field($model, 'cyclekeepmoney')->widget(DatePicker::classname(), ['language' => 'th', 'type' => DatePicker::TYPE_INPUT, 'pluginOptions' => [
                                        'autoclose' => true,
                                        'format' => 'yyyy-mm-dd',
                                        'todayHighlight' => true,
                                    ],
                                    'options' => ['class' => 'form-control', 'autocomplete' => 'off']]); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-8">
                                <?php $listPayment = ArrayHelper::map(ConfirmformPayment::find()->all(), 'id', 'payment'); ?>
                                <?= $form->field($model, 'paymentschedule')->widget(Select2::classname(), [
                                    'data' => $listPayment,
                                    'language' => 'th',
                                    'options' => [
                                    ],
                                    'pluginOptions' => [
                                        'allowClear' => true,
                                    ],
                                      
                                ]);
                                ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-8">
                                <?php $listMethodpayment = ArrayHelper::map(ConfirmformMethodpayment::find()->all(), 'id', 'method'); ?>
                                <?= $form->field($model, 'methodpeyment')->widget(Select2::classname(), [
                                    'data' => $listMethodpayment,
                                    'language' => 'th',
                                    'options' => [
                                    ],
                                    'pluginOptions' => [
                                        'allowClear' => true,
                                    ],
                                        //'onchange' => 'getrecivetype(this.value)',
                                ]);
                                ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-8">
                                <label>การส่งเอกสาร</label>
                                <?= $form->field($model, 'senddoc_finance')->checkbox() ?>
                                <?= $form->field($model, 'senddoc_customer')->checkbox() ?>
                                <?= $form->field($model, 'department')->textInput() ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-8">
                                <div id="btn-save" >
                                    <?= Html::submitButton('บันทึกข้อมูลสัญญา', ['class' => 'btn btn-success']) ?>
                                </div>
                            </div>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

</div>
