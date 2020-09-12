<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\useremp\models\User */

$this->title = 'เพิ่มผู้ใช้งาน(เจ้าหน้าที่)';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <hr/>
    <div class="row">
        <div class="col-md-5 col-lg-5">
            <label>ชื่อ - สกุล *</label>
            <input type="text" class="form-control" id="name" name="name" />
        </div>
    </div>
    <div class="row">
        <div class="col-md-5 col-lg-45">
            <label>โทรศัพท์ *</label>
            <input type="text" class="form-control" id="tel" name="tel" />
        </div>
    </div>
    <div class="row">
        <div class="col-md-5 col-lg-5">
            <label>แผนก / ฝ่าย *</label>
            <select id="department" class="form-control">
                <option value="">== เลือก ==</option>
                <?php foreach ($department as $dp): ?>
                    <option value="<?php echo $dp['id'] ?>"><?php echo $dp['department'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5 col-lg-5">
            <label>Email *</label>
            <input type="email" class="form-control" id="email" name="email" />
        </div>
    </div>
    <br/><br/>
    <div class="row">
        <div class="col-md-5 col-lg-4">
            <label>Username *</label>
            <input type="text" class="form-control" id="username" name="username" />
        </div>
    </div>
    <div class="row">
        <div class="col-md-5 col-lg-4">
            <label>Password *</label>
            <input type="password" class="form-control" id="password" name="password" />
        </div>
    </div>
</div>
<hr/>
<div class="row">
    <div class="col-md-5 col-lg-4">
        <button type="button" class="btn btn-success" onclick="save()">บันทึกข้อมูล</button>
    </div>
</div>

<script type="text/javascript">
    function save() {
        var name = $("#name").val();
        var tel = $("#tel").val();
        var email = $("#email").val();
        var department = $("#department").val();
        var username = $("#username").val();
        var password = $("#password").val();

        if (name == "" || tel == "" || email == "" || department == "" || username == "" || password == "") {
            alert("กรอกข่อมูลไม่ครบ ...!");
            return false;
        }

        var checkEmail = /^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*\@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.([a-zA-Z]){2,4})$/
        if (!email.match(checkEmail)) {
            alert("ท่านใส่อีเมล์ไม่ถูกต้อง");
            return false;
        }

        var data = {
            username: username,
            password: password,
            name: name,
            tel: tel,
            email: email,
            department: department
        };

        var url = "<?php echo Yii::$app->urlManager->createUrl(['useremp/user/save']) ?>";
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