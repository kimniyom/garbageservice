<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Config;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DatekeepSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$Config = new Config();
$this->title = "";
?>

<div class="datekeep-index">

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
            //'theme' => true,
            'weekNumbers' => false,
            'selectable' => true,
            //'defaultView' => '',
            'fixedWeekCount' => false,
            'dayClick' => new \yii\web\JsExpression('
              function(date, jsEvent, view) {
                  setDatekeep(date.format());
              }
              '),
            'eventClick' => new \yii\web\JsExpression('
                    function(calEvent, jsEvent, view)
                    {
                        getDetail(calEvent.id);
                    }
                ')
        ],
        'ajaxEvents' => Url::to(['/roundgarbage/roundgarbage/jsoncalendar'])
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

    function setDatekeep(datekeep)
    {
        alert(datekeep);
    }

    function getDetail(id) {
        var url = "<?php echo Yii::$app->urlManager->createUrl(['datekeep/datekeep/view']) ?>";
        var data = {id: id};
        $.post(url, data, function(res) {
            $("#detail").modal();
            $("#viewdata").html(res);
            var walkIn = $("#walkIn").val();
            if (walkIn) {
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
            $.post(url, data, function(res) {
                window.location.reload();
            });
        }
    }

</script>