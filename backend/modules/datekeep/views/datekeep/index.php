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
$this->title = "บันทึกการจัดเก็บ";
?>
<div class="datekeep-index">

    
   

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
                        var count = '.Datekeep::find()->where(['promiseid'=>$data['promiseid']])->count().';
                        if(count && parseInt(count)>10)
                        {
                            alert("เพิ่มได้ไม่เกิน 11 วัน");
                        }
                        else{
                            if(confirm("บันทึกวันที่เข้าจัดเก็บ "+date.format("DD-MM-YYYY")))
                            {
                                setDatekeep(date.format());
                            }
                        }
                        
                    }
                '),
                'eventClick' => new \yii\web\JsExpression('
                    function(calEvent, jsEvent, view) 
                    {
                        var url = "'.Yii::$app->urlManager->createUrl(['datekeep/datekeep/view','promiseid'=>$data['promiseid']]).'";
                        location.href = url+"&id="+calEvent.id;
                    }
                ')
        ],
        'ajaxEvents' => Url::to(['/datekeep/datekeep/jsoncalendar', 'promiseid' => $data['promiseid']])
    ]);
    ?>

</div>


<script>
function setDatekeep(datekeep)
{
    var promiseid = '<?php echo $data['promiseid']?>';
    var data = {promiseid: promiseid, datekeep:datekeep};
    var url = "<?php echo Yii::$app->urlManager->createUrl(['datekeep/datekeep/setdatekeep']) ?>";
    
    $.post(url, data, function(result) {
        console.log(result);
        if (result == 1) {
            
            location.href = "<?php echo Yii::$app->urlManager->createUrl(['datekeep/datekeep/index', 'promiseid'=>$data['promiseid']]) ?>";
        } 
    }, 'json');
    
}


</script>