<?php
use yii\helpers\Url;
use app\models\Config;
$Config = new Config();
?>

<?php if($status > 0) { ?>
    <button type="button" onclick="printDiv('invoice')"><i class="fa fa-print"></i> พิมพ์ใบแจ้งหนี้</button>
<?php } ?>
<div style="background:#ffffff; padding:10px;" id="invoice">

<div style="width:50%; left:20px;  position:absolute;">
    <img src="<?php echo Url::to('@web/web/images/logo-dark.png') ?>" /><br/><br/>
</div>

    <div style="width:30%; right:20px; text-align: right;position:absolute;">
        เลขที่ <?php echo $invnumber ?><br/>
        อ้างจากสัญญา <?php echo $promise['promisenumber'] ?><br/>
        วันที่ <?php echo date("d/m/Y") ?>
    </div>

    <h4 style="text-align: center;">ใบวางบิล / ใบแจ้งหนี้</h4>
<div style="text-align:center;">
<?php if($type == 1) { ?>
    <b></b>ไอซี ควอลิตี้ ซิสเท็ม จำกัด<br/>
    IC QUALITY SYSTEM เลขประจำตัวผู้เสียภาษีเลขที่: 0135557019633<br/>
    เลขที่ 50/9 หมู่ 6 ตำบล วังหลวง อำเภอ เมือง จังหวัด ปทุมธานี 12000 <br/>
    50/19 Moo 6 Bangluang , Muengpathumthani , Pathumthani 12000<br/>
    โทรศัพท์ (tel.) : 02-581-1950 , 092-641-7564 Email : icqualitysystem2019@gmail.com<br/><br/>
<?php } ?>
</div>

<table class="table table-bordered">
    <thead>
    <tr>
        <th colspan="6">
        ชื่อลูกค้า <?php echo $customer['company'] ?><br/>
    ที่อยู่ <?php echo 'ตำบล / แขวง '.$customer['tambon_name'].' อำเภอ '.$customer['ampur_name'].' จังหวัด '.$customer['changwat_name'].' '.$customer['zipcode'] ?>
    
        </th>
    </tr>
        <tr>
            <th colspan="6">
                ประจำงวดที่ <?php echo $rounddate ?>
            </th>
        </tr>
        <tr>
            <th>#</th>
            <th>รายการ</th>
            <th style="text-align:right;">ปริมาณขยะ</th>
            <th style="text-align:right;">ราคาต่อหน่วย</th>
            <th style="text-align:right;">ขยะเกิน</th>
            <th style="text-align:right;">ค่าใช้จ่าย</th>
        </tr>
    </thead>
    <tbody>
    <?php
$sum = 0;
$i = 0;foreach ($billdetail as $rs): $i++;
	$fineprice = ($promise['fine'] * $rs['garbageover']);
	$totalRow = ($promise['unitprice'] + $fineprice);
	$sum = $sum + $totalRow;
	?>
														    <tr>
													            <td><?php echo $i ?></td>
													            <td>ค่ากำจัดขยะติดเชื้อ รอบที่ <?php echo $rs['round'] ?></td>
													            <td style="text-align:right;"><?php echo $rs['amount'] ?></td>
													            <td style="text-align:right;"><?php echo $promise['unitprice'] ?></td>
													            <td style="text-align:right;">
								                                <?php
	echo ($rs['garbageover'] > 0) ? $promise['fine'] . ' x ' . $rs['garbageover'] . " = " : "";
	echo number_format($fineprice);
	?>
								                                </td>
													            <td style="text-align:right;"><?php echo $totalRow ?></td>
													        </tr>
													    <?php endforeach;?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="4" style="text-align:center;">
                <?php echo $Config->Convert($sum) ?>
            </th>
            <th style="text-align:center;">ยอดเงินสุทธิ</th>
            <th style="text-align:right;"><?php echo number_format($sum) ?></th>
        </tr>

        <tr>
            <th colspan="3">
                <b>การชำระเงิน</b>
                <ul>
                    <li><input type="radio" name="payment" id="payment"/> ชำระเงินสด</li>
                    <li><input type="radio" name="payment" id="payment"/> โอนผ่านบัญชีธนาคาร</li>
                </ul>
            </th>
            <th colspan="3">
            <br/>
            ลงชื่อ
            <div style="margin-top:0px; border-bottom:#999999 dotted 1px; color:#999999;"></div><br/>
                <div style="text-align:center;">ผู้มีอำนาจลงนาม</div>
            </th>
        </tr>
        <?php if($status <= 0) { ?>
        <tr>
            <th colspan="6">
            <?php if($i == $promise['levy']) { ?>
                <button class="btn btn-success" type="button" onclick="saveInvoice()"><i class="fa fa-save"></i> บันทึกข้อมูล</button>
            <?php } else { ?>
                <button class="btn btn-warning disabled" type="button"><i class="fa fa-info"></i> บันทึกข้อมูลการจัดเก็บในรอบเดือนไม่ครบ</button>
            <?php } ?>
            </th>
        </tr>
        <?php } ?>
        
    </tfoot>
</table>
</div>
<input type="hidden" id="id" name="id" class="form-control" value="<?php echo $id ?>"/>

<!-- /////////////////////// Bill ///////////////////////////-->
<br/>
<?php if($status > 0) { ?>
    <button type="button" onclick="printDiv('bill')"><i class="fa fa-print"></i> พิมพ์ใบเสร็จ</button>
<?php } ?>
<div style="background:#ffffff; padding:10px;" id="bill">
<div style="width:50%; left:20px;  position:absolute;">
    <img src="<?php echo Url::to('@web/web/images/logo-dark.png') ?>" /><br/><br/>
</div>

    <div style="width:30%; right:20px; text-align: right;position:absolute;">
        เลขที่ <?php echo $invnumber ?><br/>
        อ้างจากสัญญา <?php echo $promise['promisenumber'] ?><br/>
        วันที่ <?php echo date("d/m/Y") ?>
    </div>

    <h4 style="text-align: center;">บิล / ใบเสร็จรับเงิน</h4>
<div style="text-align:center;">
<?php if($type == 1) { ?>
    <b></b>ไอซี ควอลิตี้ ซิสเท็ม จำกัด<br/>
    IC QUALITY SYSTEM เลขประจำตัวผู้เสียภาษีเลขที่: 0135557019633<br/>
    เลขที่ 50/9 หมู่ 6 ตำบล วังหลวง อำเภอ เมือง จังหวัด ปทุมธานี 12000 <br/>
    50/19 Moo 6 Bangluang , Muengpathumthani , Pathumthani 12000<br/>
    โทรศัพท์ (tel.) : 02-581-1950 , 092-641-7564 Email : icqualitysystem2019@gmail.com<br/><br/>
<?php } ?>
</div>
<table class="table table-bordered">
    <thead>
        <tr>
            <th colspan="6">
                ประจำงวดที่ <?php echo $rounddate ?>
            </th>
        </tr>
        <tr>
            <th>#</th>
            <th>รายการ</th>
            <th style="text-align:right;">ปริมาณขยะ</th>
            <th style="text-align:right;">ราคาต่อหน่วย</th>
            <th style="text-align:right;">ขยะเกิน</th>
            <th style="text-align:right;">ค่าใช้จ่าย</th>
        </tr>
    </thead>
    <tbody>
    <?php
$sum = 0;
$i = 0;foreach ($billdetail as $rs): $i++;
	$fineprice = ($promise['fine'] * $rs['garbageover']);
	$totalRow = ($promise['unitprice'] + $fineprice);
    $sum = $sum + $totalRow;
    //เช็คการเก็บขยะ
    if($rs['status'] == 1){
	?>
														    <tr>
													            <td><?php echo $i ?></td>
													            <td>ค่ากำจัดขยะติดเชื้อ รอบที่ <?php echo $rs['round'] ?></td>
													            <td style="text-align:right;"><?php echo $rs['amount'] ?></td>
													            <td style="text-align:right;"><?php echo $promise['unitprice'] ?></td>
													            <td style="text-align:right;">
								                                <?php
	echo ($rs['garbageover'] > 0) ? $promise['fine'] . ' x ' . $rs['garbageover'] . " = " : "";
	echo number_format($fineprice);
	?>
								                                </td>
													            <td style="text-align:right;"><?php echo $totalRow ?></td>
													        </tr>
    <?php } ?>
													    <?php endforeach;?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="4" style="text-align:center;">
                <?php echo $Config->Convert($sum) ?>
            </th>
            <th style="text-align:center;">ยอดเงินสุทธิ</th>
            <th style="text-align:right;"><?php echo number_format($sum) ?></th>
        </tr>
        <tr>
            <th colspan="6">
                <b>ชำระเงินโดย</b>
                <ul>
                    <li><input type="radio" name="payment" id="payment"/> ชำระเงินสด</li>
                    <li><input type="radio" name="payment" id="payment"/> โอนผ่านบัญชีธนาคาร</li>
                </ul>
            </th>
        </tr>
        <tr>
            <th colspan="3">
            <br/>
            ลงชื่อ
            <div style="margin-top:0px; border-bottom:#999999 dotted 1px; color:#999999;"></div><br/>
            <div style="text-align:center;">ผู้รับเงิน</div>
            </th>
            <th colspan="3">
            <br/>
            ลงชื่อ
            <div style="margin-top:0px; border-bottom:#999999 dotted 1px; color:#999999;"></div><br/>
                <div style="text-align:center;">ผู้มีอำนาจลงนาม</div>
            </th>
        </tr>
        
    </tfoot>
</table>
</div>

<script type="text/javascript">
    function saveInvoice(){
        var url = "<?php echo Yii::$app->urlManager->createUrl(['service/default/addinvoice']) ?>";
        var invoiceNumber = "<?php echo $invnumber ?>";
        var promiseId = "<?php echo $promise['id'] ?>";
        var total = "<?php echo $sum ?>";
        var roundId = "<?php echo $id ?>";
        var monthyear = "<?php echo $rounddate ?>";
        var data = {
            invoiceNumber: invoiceNumber,
            promiseId: promiseId,
            total: total,
            roundId: roundId,
            monthyear: monthyear
        }
        //console.log(data);
        
        $.post(url,data,function(datas){
            getInvoice();
        });
        
    }

    function getInvoice(){
        var url = "<?php echo Yii::$app->urlManager->createUrl(['service/default/getinvoice']) ?>";
        var promiseid = "<?php echo $promise['id'] ?>";
		var dateround = "<?php echo $rounddate ?>";
		var id = "<?php echo $id ?>";
		var invoice = "<?php echo $invnumber ?>";
        var data = {
            id: id,
            promiseid: promiseid,
            dateround: dateround,
            invoice: invoice,
            type: 1
            };
        $.post(url,data,function(datas){
            $("#createbill").html(datas);
        });
    }

    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>