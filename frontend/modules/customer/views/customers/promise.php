<?php
use yii\helpers\Url;
use app\models\Config;
/* @var $this yii\web\View */
/* @var $model app\modules\customer\models\Customers */

$this->title = "สัญญา";
$this->params['breadcrumbs'][] = ['label' => 'จัดการข้อมูล', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

use yii\helpers\Html;
$urlMap = new Config();

?>

<?= \yii2assets\pdfjs\PdfJs::widget([
  'url'=> Url::base().'/../uploads/promise/test.pdf'
]); ?>