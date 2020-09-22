<style type="text/css">
    #calendar{
        background: #FFFFFF;
    }
    #ca{
        padding: 10px; background: #FFFFFF;
    }

    h2{
        font-size: 18px;
        text-align: center;
        padding-top: 15px;
    }

</style>
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
            'style' => 'width:100%;background-color:#ffffff;',
            'language' => 'th',
            'eventLimit' => false,
            //'theme' => true,
            'weekNumbers' => false,
            'selectable' => true,
            //'defaultView' => '',
            'fixedWeekCount' => false,
            'dayClick' => new \yii\web\JsExpression('
              function(date, jsEvent, view) {
                  //setDatekeep(date.format());
              }
              '),
            'eventClick' => new \yii\web\JsExpression('
                    function(calEvent, jsEvent, view)
                    {
                        getDetail(calEvent.id,calEvent.start.format());
                    }
                ')
        ],
        'ajaxEvents' => Url::to(['/roundgarbage/roundgarbage/jsoncalendar'])
    ]);
    ?>

</div>

<div class="modal fade bs-example-modal-sm" id="detail" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
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
            </div>
        </div>
    </div>
</div>


<script>

    function setDatekeep(datekeep)
    {
        alert(datekeep);
    }

    function getDetail(id, datekeep) {
        var url = "<?php echo Yii::$app->urlManager->createUrl(['roundgarbage/roundgarbage/getevent']) ?>";
        var data = {datekeep: datekeep};
        $.post(url, data, function(res) {
            $("#detail").modal();
            $("#viewdata").html(res);
        });
    }

</script>