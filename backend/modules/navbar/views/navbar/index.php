<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\navbar\models\NavbarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Navbars';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="navbar-index">

    <h1><?= Html::encode($this->title) ?></h1>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
      <li><a href="#">หน้าแรก</a></li>
      <li><a href="#">ข่าวสาร</a></li>
      <?php foreach($nav as $rs): ?>
      <?php if($rs['submenu'] == "0"){ ?>
        <li><a href="<?php echo Yii::$app->urlManager->createUrl(['navbar/navbar/view','id' => $rs['id']]) ?>"><?php echo $rs['navbar'] ?></a></li>
      <?php } else { ?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $rs['navbar'] ?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
          <?php 
            $sql = "select * from subnavbar where navbar = '".$rs['id']."' ";
            $submenu = Yii::$app->db->createCommand($sql)->queryAll();
          foreach($submenu as $sub): ?>
            <li><a href="<?php echo Yii::$app->urlManager->createUrl(['navbar/navbar/viewsubmenu','id' => $sub['id']]) ?>"><?php echo $sub['subnavbar'] ?></a></li>
          <?php endforeach; ?>
            <li role="separator" class="divider"></li>
            <li><a href="<?php echo Yii::$app->urlManager->createUrl(['navbar/navbar/formsubmenu','id' => $rs['id']]) ?>"><i class="fa fa-plus"></i> เพิ่ม</a></li>
            <li><a href="javascript:popupmenuupdate('<?php echo $rs['id']?>','<?php echo $rs['navbar'] ?>')"><i class="fa fa-pencil"></i> แก้ไขเมนูหลัก</a></li>
            <li><a href="javascript:deletenavbar('<?php echo $rs['id']?>')"><i class="fa fa-trash"></i> ลบ</a></li>
          </ul>
        </li>
      <?php } ?>
        <?php endforeach; ?>
        <li><a href="javascript:popupmenu()" style="color:green;"><i class="fa fa-plus"></i> เพิ่มเมนู</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="popupmenu" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">เพิ่มเมนูเว็บไซต์</h4>
      </div>
      <div class="modal-body">
        หัวข้อ
        <input type="text" class="form-control" id="navbar"/>
        หัวข้อย่อย
        <select id="submenu" class="form-control">
            <option value="0">ไม่มีเมนูย่อย</option>
            <option value="1">มีเมนูย่อย</option>
        </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="save()">Save</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- Modal Update -->

<div class="modal fade" tabindex="-1" role="dialog" id="popupmenuupdate" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">แก้ไขเมนูเว็บไซต์</h4>
      </div>
      <div class="modal-body">
        หัวข้อ
        <input type="text" class="form-control" id="_navbar"/>
        <input type="hidden" class="form-control" id="_id"/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="update()">Save</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
    function popupmenu(){
        $("#popupmenu").modal();
    }

    function popupmenuupdate(id,navbar){
      $("#_navbar").val(navbar);
      $("#_id").val(id);
      $("#popupmenuupdate").modal();
    }

    function save(){
      var url = "<?php echo Yii::$app->urlManager->createUrl(['navbar/navbar/save']) ?>";
      var navbar = $("#navbar").val();
      var submenu = $("#submenu").val();
      var data = {
        navbar: navbar,
        submenu: submenu
      };
      if(navbar == ""){
        $("#navbar").focus();
        return false;
      }
      $.post(url,data,function(datas){
  
        if(datas <= 0){
          window.location.reload();
        } else {
          var id = datas;
          var urlFade = "<?php echo Yii::$app->urlManager->createUrl(['navbar/navbar/formnav']) ?>" + "&id=" + id;
          window.location=urlFade;
        }
      
      });
    }

    function update(){
      var url = "<?php echo Yii::$app->urlManager->createUrl(['navbar/navbar/updatenavbar']) ?>";
      var navbar = $("#_navbar").val();
      var id = $("#_id").val();
      var data = {
        navbar: navbar,
        id: id
      };
      if(navbar == ""){
        $("#_navbar").focus();
        return false;
      }
      $.post(url,data,function(datas){
          window.location.reload();
      });
    }

    function deletenavbar(id){
      var r = confirm("Are you sure...");
      if(r == true){
        var url = "<?php echo Yii::$app->urlManager->createUrl(['navbar/navbar/deletenavbar']) ?>";
        var data = {id: id};
        $.post(url,data,function(datas){
          window.location.reload();
        })
      }
    }
</script>