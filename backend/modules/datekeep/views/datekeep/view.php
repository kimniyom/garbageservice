<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Config;

$Config = new Config();
/* @var $this yii\web\View */
/* @var $model app\models\Datekeep */


$this->params['breadcrumbs'][] = ['label' => 'Datekeeps', 'url' => ['index', 'promiseid' => $data['model']->promiseid]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="datekeep-view">

    <input type="hidden" id="dateId" value="<?php echo $data['model']['id'] ?> "/>
    <input type="hidden" id="walkIn" value="<?php echo $walkIn['datekeep'] ?>"/>

    <?=
    DetailView::widget([
        'model' => $data['model'],
        'attributes' => [
            [
                'label' => 'วันเข้าจัดเก็บ',
                'value' => $Config->dayInweekKeyFull($dayname) . " ที่ " . $Config->thaidate($data['model']['datekeep']),
            ],
        ],
    ])
    ?>

    <?php
    if ($walkIn['datekeep']) {
        echo "จำนวนขยะ: " . $walkIn['amount'] . " กิโลกรัม<br/>";
        echo "เวลาเข้า - ออก: " . $walkIn['timekeepin'] . " - " . $walkIn['timekeepout'] . "<br/>";
        echo "ทะเบียนรถ: " . $walkIn['car'];
    }
    ?>
</div>


