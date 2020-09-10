<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Config;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DatekeepSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$Config = new Config();
?>
<div class="datekeep-index">


    <p>
<?= Html::a('เพิ่มวันเข้าจัดเก็บ', ['create', 'promiseid' => $data['promiseid']], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <?=
    yii2fullcalendar\yii2fullcalendar::widget([
        'id' => 'calendar',
        'clientOptions' => [
            'language' => 'th',
            'eventLimit' => TRUE,
//                'theme'=>true,
            'fixedWeekCount' => false,
            'dayClick' => new \yii\web\JsExpression('
                    function(date, jsEvent, view) {

                        getDatekeep(' . $data['promiseid'] . ', date.format());
                    }
                ')
        ],
        'ajaxEvents' => Url::to(['/datekeep/datekeep/jsoncalendar', 'promiseid' => $data['promiseid']])
    ]);
    ?>

</div>


<script>
    function getDatekeep(promiseid, datekeep)
    {
        var data = {promiseid: promiseid, datekeep: datekeep};
        var url = "<?php echo Yii::$app->urlManager->createUrl(['datekeep/datekeep/getdatekeep']) ?>";
        $.post(url, data, function(result) {
            console.log(result);
            if (result != 0) {
                var url = "<?php echo Yii::$app->urlManager->createUrl(['datekeep/datekeep/view']) ?>";
                location.href = url + '&promiseid=' + result.promiseid + "&datekeep=" + result.datekeep;
            }
        }, 'json');
    }
</script>