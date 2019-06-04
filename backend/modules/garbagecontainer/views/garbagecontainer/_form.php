<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\modules\garbagecontainer\models\Garbagecontainer */
/* @var $form yii\widgets\ActiveForm */
?>
<script type="text/javascript" src="<?php echo Url::to('@web/web//ckeditor/ckeditor.js') ?>"></script>
<script type="text/javascript" src="<?php echo Url::to('@web/web/ckeditor/ckfinder/ckfinder.js') ?>"></script>
<div class="garbagecontainer-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'garbagecontainer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'size')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'brand')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contain')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'color')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'detail')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($modelImg, 'image')->fileInput(['files'=>'C:\Users\lph\Downloads\72746.jpg'])?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
    //Modify By Kimniyom
    CKEDITOR.replace('garbagecontainer-detail', {
        language: 'th',
        uiColor: '#FFFFFF',
        toolbarGroups: [
            //{name: 'clipboard', groups: ['clipboard', 'undo']},
            //{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ] },
            {name: 'links'},
            {name: 'insert'},
            //{ name: 'forms' },
            {name: 'tools'},
            //{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
            //{ name: 'others' },
            '/',
            {name: 'basicstyles', groups: ['basicstyles', 'cleanup']},
            {name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'bidi']},
            {name: 'styles'},
            {name: 'colors'},
                    //{ name: 'about' }
        ],
        removeButtons: 'Strike,Subscript,Superscript,Anchor,Styles,Specialchar,Language,Flash',
        image_removeLinkByEmptyURL: true,
        filebrowserBrowseUrl: "<?php echo Url::to('@web/web/ckeditor/ckfinder/ckfinder.html') ?>",
        filebrowserImageBrowseUrl: "<?php echo Url::to('@web/web/ckeditor/ckfinder/ckfinder.html?Type=Images') ?>",
        filebrowserFlashBrowseUrl: "<?php echo Url::to('@web/web/ckeditor/ckfinder/ckfinder.html?Type=Flash') ?>",
        filebrowserUploadUrl: "<?php echo Url::to('@web/web/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') ?>",
        filebrowserImageUploadUrl: "<?php echo Url::to('@web/web/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') ?>",
        filebrowserFlashUploadUrl: "<?php echo Url::to('@web/web/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') ?>"
    });

</script>
