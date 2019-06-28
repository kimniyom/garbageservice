<?php

use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\modules\navbar\models\Navbar */

$this->title = 'Create Navbar';
$this->params['breadcrumbs'][] = ['label' => 'Navbars', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<script type="text/javascript" src="<?php echo Url::to('@web/web/ckeditor/ckeditor.js') ?>"></script>
<script type="text/javascript" src="<?php echo Url::to('@web/web/ckeditor/ckfinder/ckfinder.js') ?>"></script>

<div class="navbar-create">

   <h4>เมนู::<?php echo $detail['navbar'] ?></h4>
<textarea id="detail" name="detail" class="form-control" rows="10"></textarea>
<hr/>
<button type="button" class="btn btn-success" onclick="save()"><i class="fa fa-save"></i> บันทึก</button>
</div>

<script>
    //Modify By Kimniyom
    CKEDITOR.replace('detail', {
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

    function save(){
        var url = "<?php echo Yii::$app->urlManager->createUrl(['navbar/navbar/savepage']) ?>";
        var detail = CKEDITOR.instances.detail.getData();
        var id = "<?php echo $detail['id'] ?>";
        var data = {
            id: id,
            detail: detail
        };

        if(detail == ""){
            $("#detail").focus();
            return false;
        }
        $.post(url,data,function(datas){
            var urlFade = "<?php echo Yii::$app->urlManager->createUrl(['navbar/navbar/view']) ?>" + "&id=" + id;
            window.location=urlFade;
        });
    }
</script>
