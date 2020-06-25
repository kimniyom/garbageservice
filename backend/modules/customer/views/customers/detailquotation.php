<?php

//use yii\grid\GridView;
use kartik\grid\GridView;
use app\modules\customer\models\Customers;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\customer\models\CustomerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ใบเสนอราคา';
$this->params['breadcrumbs'][] = $this->title;
?>
<button type="button" class="btn btn-default">
    <i class="fa fa-chevron-circle-left fa-2x"></i> <span style="font-size: 18px;">กลับ</span></button>
<table class="table">
    <tr>
        <td style="text-align: right; width: 200px;">เรื่อง</td>
        <td><?php echo $datas['title'] ?></td>
    </tr>
    <tr>
        <td style="text-align: right;">สถานบริการ / บริษัท</td>
        <td><?php echo $datas['customername'] ?></td>
    </tr>
    <tr>
        <td style="text-align: right;">ประเภทสถานบริการ</td>
        <td><?php echo $datas['typename'] ?></td>
    </tr>
    <tr>
        <td style="text-align: right;">ชื่อผู้ติดต่อ</td>
        <td><?php echo $datas['contact'] ?></td>
    </tr>
    <tr>
        <td style="text-align: right;">โทรศัพท์</td>
        <td><?php echo $datas['tel'] ?></td>
    </tr>
    <tr>
        <td style="text-align: right;">ที่อยู่</td>
        <td>
            <?php echo $datas['address'] ?>&nbsp;
            ต.<?php echo $datas['tambon_name'] ?>&nbsp;
            อ.<?php echo $datas['ampur_name'] ?>&nbsp;
            จ.<?php echo $datas['tambon_name'] ?>&nbsp;
            <?php echo $datas['zipcode'] ?>
        </td>
    </tr>
    <tr>
        <td style="text-align: right;">วัน - เวลา ที่เปิดทำการ</td>
        <td><?php echo $datas['dayopen'] ?></td>
    </tr>
    <tr>
        <td style="text-align: right;">สถานที่ตั้ง</td>
        <td><?php echo ($datas['location']) ? $datas['location'] : "-"; ?></td>
    </tr>
    <tr>
        <td style="text-align: right;">รอบจัดเก็บ (ครั้งต่อสัปดาห์)</td>
        <td><?php echo $datas['roundofweek'] ?></td>
    </tr>
    <tr>
        <td style="text-align: right;">รวมจำนวนครั้งต่อเดือน</td>
        <td><?php echo $datas['roundofmount'] ?></td>
    </tr>
    <tr>
        <td style="text-align: right;">ราคาต่อเดือน</td>
        <td><?php echo $datas['priceofmount'] ?></td>
    </tr>
    <tr>
        <td style="text-align: right;">ราคาต่อปี</td>
        <td><?php echo $datas['priceofyear'] ?></td>
    </tr>
    <tr>
        <td style="text-align: right;">ออกบิลในนาม</td>
        <td><?php echo $datas['typebill'] ?></td>
    </tr>
    <tr>
        <td style="text-align: right;">รอบการชำระเงิน</td>
        <td><?php echo $datas['roundprice'] ?></td>
    </tr>
    <tr>
        <td style="text-align: right;">รายละเอียดอื่น ๆ</td>
        <td><?php echo ($datas['detail']) ? $datas['detail'] : "-"; ?></td>
    </tr>
    <tr>
        <td style="text-align: right;">วันที่บันทึก</td>
        <td><?php echo $datas['d_update'] ?></td>
    </tr>
</table>

