<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\useremp\models\User */

$this->title = 'แก้ไขผู้ใช้งาน(เจ้าหน้าที่)';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <hr/>
    <div class="row">
        <div class="col-md-5 col-lg-5">
            <label>ชื่อ - สกุล *</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $model['name'] ?>"/>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5 col-lg-45">
            <label>โทรศัพท์ *</label>
            <input type="text" class="form-control" id="tel" name="tel" value="<?php echo $model['tel'] ?>"/>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5 col-lg-5">
            <label>แผนก / ฝ่าย *</label>
            <?php echo $model['department'] ?>
            <select id="department" class="form-control">
                <?php foreach ($department as $dp): ?>
                    <option value="<?php echo $dp['id'] ?>" <?php echo($dp['id'] == $model['department']) ? "selected" : ""; ?>><?php echo $dp['department'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5 col-lg-5">
            <label>Email *</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $model['email'] ?>"/>
        </div>
    </div>

</div>
<hr/>
<div class="row">
    <div class="col-md-5 col-lg-4">
        <button type="button" class="btn btn-success" onclick="save()">แก้ไขข้อมูล</button>
    </div>
</div>

<script type="text/javascript">
    function save() {
        var name = $("#name").val();
        var tel = $("#tel").val();
        var email = $("#email").val();
        var department = $("#department").val();

        if (name == "" || tel == "" || email == "" || department == "") {
            alert("กรอกข่อมูลไม่ครบ ...!");
            return false;
        }

        var data = {
            name: name,
            tel: tel,
            email: email,
            department: department
        };

        var url = "<?php echo Yii::$app->urlManager->createUrl(['useremp/user/saveupdate']) ?>";
        var urlRedir = "<?php echo Yii::$app->urlManager->createUrl(['useremp/user/index']) ?>";
        $.post(url, data, function(res) {
            if (res > 0) {
                alert("มีคนใช้ชื่อ Username นี้แล้ว...!");
                return false;
            } else {
                window.location = urlRedir;
            }
        });
    }
</script>