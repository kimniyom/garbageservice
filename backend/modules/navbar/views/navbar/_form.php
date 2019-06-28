<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\navbar\models\Navbar */
/* @var $form yii\widgets\ActiveForm */
?>
<script type="text/javascript" src="<?php echo Url::to('@web/web/ckeditor/ckeditor.js') ?>"></script>
<script type="text/javascript" src="<?php echo Url::to('@web/web/ckeditor/ckfinder/ckfinder.js') ?>"></script>

<div class="navbar-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <?= $form->field($model, 'navbar')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <?= $form->field($model, 'detail')->textarea(['rows' => 6]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col col-md-4 col-lg-4">
            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>

<script>
    //Modify By Kimniyom
    CKEDITOR.replace('navbar-detail', {
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
