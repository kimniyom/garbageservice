<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Config;
use yii\helpers\Url;
use app\models\Datekeep;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DatekeepSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$Config = new Config();
$this->title = "";
?>

<div class="datekeep-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <?=
    yii2fullcalendar\yii2fullcalendar::widget([
        'id' => 'calendar',
        'header' => [
            'left' => 'prev,next,today',
            'center' => 'title',
            'right' => 'month', //agendaWeek,agendaDay
        ],
        'clientOptions' => [
            'language' => 'th',
            'eventLimit' => false,
//             'theme'=>true,
            'weekNumbers' => false,
            'selectable' => true,
            //'defaultView' => '',
            'fixedWeekCount' => false,
            'dayClick' => new \yii\web\JsExpression('
                function(date, jsEvent, view) {
                    checkData(date.format());
                    /*
                    if(confirm("บันทึกวันที่เข้าจัดเก็บ "+date.format("DD-MM-YYYY"))){
                        setDatekeep(date.format());
                    }
                    */
                }
                '),
            'eventClick' => new \yii\web\JsExpression('
                    function(calEvent, jsEvent, view) 
                    {
                        //location.href = url+"&id="+calEvent.id;
                        getDetail(calEvent.id);
                    }
                ')
        ],
        'ajaxEvents' => Url::to(['/datekeep/datekeep/jsoncalendar', 'promiseid' => $data['promiseid']])
    ]);
    ?>

</div>

<div class="modal fade bs-example-modal-sm" id="detail" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">วันที่เข้าจัดเก็บ</h4>
            </div>
            <div class="modal-body">
                <div id="viewdata"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                <button type="button" class="btn btn-danger" onclick="deleteEvent()" id="delDate">นำออก</button>
            </div>
        </div>
    </div>
</div>


<script>
    function checkData(datekeep) {
        var promiseid = '<?php echo $data['promiseid'] ?>';
        var data = {promiseid: promiseid, datekeep: datekeep};
        var url = "<?php echo Yii::$app->urlManager->createUrl(['datekeep/datekeep/checkdata']) ?>";

        $.post(url, data, function (result) {
            if (result > 0) {
                alert("ไม่สามารถลงวันที่เข้าจัดเก็บซ้ำได้...!");
                return false;
            } else {
                setDatekeep(datekeep);
            }
        });
    }

    function setDatekeep(datekeep)
    {
        var r = confirm("คุณต้องการเพิ่มวันที่เข้าจัดเก็บ " + datekeep + " ใช่หรือไม่..?");
        if (r == true) {
            var promiseid = '<?php echo $data['promiseid'] ?>';
            var data = {promiseid: promiseid, datekeep: datekeep};
            var url = "<?php echo Yii::$app->urlManager->createUrl(['datekeep/datekeep/setdatekeep']) ?>";

            $.post(url, data, function (result) {
                //console.log(result);
                if (result == 1) {
                    //alert("เพิ่มวันที่เข้าจัดเก็บสำเร็จ");
                    location.href = "<?php echo Yii::$app->urlManager->createUrl(['datekeep/datekeep/index', 'promiseid' => $data['promiseid']]) ?>";
                }
            }, 'json');
        }

    }

    function getDetail(id) {
        var url = "<?php echo Yii::$app->urlManager->createUrl(['datekeep/datekeep/view']) ?>";
        var promiseId = "<?php echo $data['promiseid'] ?>";
        var data = {id: id, promiseId: promiseId};
        $.post(url, data, function (res) {
            $("#detail").modal();
            $("#viewdata").html(res);
            var walkIn = $("#walkIn").val();
            if(walkIn){
                $("#delDate").hide();
            } else {
                $("#delDate").show();
            }
        });
    }

    function deleteEvent() {
        var r = confirm("Are you sure...?");
        if (r == true) {
            var url = "<?php echo Yii::$app->urlManager->createUrl(['datekeep/datekeep/delete']) ?>";
            var id = $("#dateId").val();
            var data = {id: id};
            $.post(url, data, function (res) {
                window.location.reload();
            });
        }
    }

</script>