<style tyle="text/css">
    table thead tr th{
        background:#eeeeee;
    }
</style>
<?php
use yii\helpers\Url;
use app\models\Config;
$Config = new Config();
?>

    <button type="button" class="print" style="display:none;" onclick="printDiv('invoice')"><i class="fa fa-print"></i> พิมพ์ใบแจ้งหนี้</button>
<div style="background:#ffffff; padding:10px;" id="invoice">
<h4 style="text-align: center;">ใบวางบิล / ใบแจ้งหนี้</h4>
<div style="width:50%; float: left;">
    <img src="<?php echo Url::to('@web/web/images/logo-dark.png') ?>" /><br/><br/>
    <b></b>ไอซี ควอลิตี้ ซิสเท็ม<br/>
    โทรศัพท์ 02-1010325<br/>
    ชื่อลูกค้า <?php echo $customer['company'] ?><br/>
    ที่อยู่ <?php echo 'ตำบล / แขวง '.$customer['tambon_name'].' อำเภอ '.$customer['ampur_name'].' จังหวัด '.$customer['changwat_name'].' '.$customer['zipcode'] ?>
    </div>
    <div style="width:30%; float: right; text-align: right;">
        เลขที่ <?php echo $invnumber ?><br/>
        อ้างจากสัญญา <?php echo $promise['promisenumber'] ?><br/>
        วันที่ <?php echo date("d/m/Y") ?>
    </div>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th style="text-align:center;">รายการ</th>
            <th style="text-align:right;">ราคาต่อหน่วย</th>
            <th style="text-align:center;">จำนวน</th>
            <th style="text-align:right;">ค่าใช้จ่าย</th>
        </tr>
    </thead>
    <tbody>
    <?php
$sum = 0;
$i = 0;foreach ($billdetail as $rs): $i++;
	$totalRow = ($promise['unitprice'] * $promise['levy']) ;
    $sum = $sum + $totalRow;
    $month = substr($rs['datekeep'],5,2);
    $year = substr($rs['datekeep'],0,4);
	?>
														    <tr>
													            <td><?php echo $i ?></td>
													            <td>ค่ากำจัดขยะติดเชื้อ ประจำเดือน (<?php echo $Config->month_shot()[$month]." ".($year + 543) ?>)</td>
													            <td style="text-align:right;"><?php echo $promise['unitprice'] ?></td>
													            <td style="text-align:center;"><?php echo $promise['levy'] ?></td>
													            
													            <td style="text-align:right;"><?php echo number_format($totalRow,2) ?></td>
													        </tr>
													    <?php endforeach;?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="3" style="text-align:center;">
                
            </th>
            <th style="text-align:left;">ยอดเงินสุทธิ</th>
            <th style="text-align:right;"><?php echo number_format($sum,2) ?></th>
        </tr>
        <tr>
        <th colspan="3" style="text-align:center;">
        
            </th>
            <th style="text-align:left;">ส่วนลด <?php echo ($promise['distcountpercent']) ? $promise['distcountpercent']." %" : ""; ?></th>
            <th style="text-align:right;"><?php echo ($promise['distcountbath']) ? number_format($promise['distcountbath'],2) : "-"; ?></th>
        </tr>

        <th colspan="3" style="text-align:center; background:#eeeeee;">
        <div style="text-align:left; float:left;background:#eeeeee;"><em>(ตัวอักษร)</em></div><?php echo $Config->Convert($promise['total']) ?>
                </th>
                <th style="text-align:left;background:#eeeeee;">รวมหักส่วนลด </th>
                <th style="text-align:right;background:#eeeeee;"><?php echo number_format($promise['total'],2) ?></th>
            </tr>
        
        <tr>
            <th colspan="2">
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
            <th colspan="5">
            
                <button class="btn btn-success" type="button" id="btn-save" onclick="saveInvoice()"><i class="fa fa-save"></i> บันทึกข้อมูล</button>
            
            </th>
        </tr>
        <?php } ?>
        
    </tfoot>
</table>
</div>

<!-- /////////////////////// Bill ///////////////////////////-->
<br/>
    <button type="button" class="print" style="display:none;" onclick="printDiv('bill')"><i class="fa fa-print"></i> พิมพ์ใบเสร็จ</button>
<div style="background:#ffffff; padding:10px;" id="bill">
<h4 style="text-align: center;">บิล / ใบเสร็จรับเงิน</h4>
<div style="width:50%; float: left;">
    <img src="<?php echo Url::to('@web/web/images/logo-dark.png') ?>" /><br/><br/>
    <b></b>ไอซี ควอลิตี้ ซิสเท็ม<br/>
    โทรศัพท์ 02-1010325<br/>
    ชื่อลูกค้า <?php echo $customer['company'] ?><br/>
    ที่อยู่ <?php echo 'ตำบล / แขวง '.$customer['tambon_name'].' อำเภอ '.$customer['ampur_name'].' จังหวัด '.$customer['changwat_name'].' '.$customer['zipcode'] ?>
    </div>
    <div style="width:30%; float: right; text-align: right;">
        เลขที่ <?php echo $invnumber ?><br/>
        อ้างจากสัญญา <?php echo $promise['promisenumber'] ?><br/>
        วันที่ <?php echo date("d/m/Y") ?>
    </div>
    <table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th style="text-align:center;">รายการ</th>
            <th style="text-align:right;">ราคาต่อหน่วย</th>
            <th style="text-align:center;">จำนวน</th>
            <th style="text-align:right;">ค่าใช้จ่าย</th>
        </tr>
    </thead>
    <tbody>
    <?php
$sum = 0;
$i = 0;foreach ($billdetail as $rs): $i++;
	$totalRow = ($promise['unitprice'] * $promise['levy']) ;
    $sum = $sum + $totalRow;
    $month = substr($rs['datekeep'],5,2);
    $year = substr($rs['datekeep'],0,4);
	?>
														    <tr>
													            <td><?php echo $i ?></td>
													            <td>ค่ากำจัดขยะติดเชื้อ ประจำเดือน (<?php echo $Config->month_shot()[$month]." ".($year + 543) ?>)</td>
													            <td style="text-align:right;"><?php echo $promise['unitprice'] ?></td>
													            <td style="text-align:center;"><?php echo $promise['levy'] ?></td>
													            
													            <td style="text-align:right;"><?php echo number_format($totalRow,2) ?></td>
													        </tr>
													    <?php endforeach;?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="3" style="text-align:center;">
                
            </th>
            <th style="text-align:left;">ยอดเงินสุทธิ</th>
            <th style="text-align:right;"><?php echo number_format($sum,2) ?></th>
        </tr>
        <tr>
        <th colspan="3" style="text-align:center;">
        
            </th>
            <th style="text-align:left;">ส่วนลด <?php echo ($promise['distcountpercent']) ? $promise['distcountpercent']." %" : ""; ?></th>
            <th style="text-align:right;"><?php echo ($promise['distcountbath']) ? number_format($promise['distcountbath'],2) : "-"; ?></th>
        </tr>

        <th colspan="3" style="text-align:center; background:#eeeeee;">
        <div style="text-align:left; float:left;background:#eeeeee;"><em>(ตัวอักษร)</em></div><?php echo $Config->Convert($promise['total']) ?>
                </th>
                <th style="text-align:left;background:#eeeeee;">รวมหักส่วนลด </th>
                <th style="text-align:right;background:#eeeeee;"><?php echo number_format($promise['total'],2) ?></th>
            </tr>
        <tr>
            <th colspan="5">
                <b>ชำระเงินโดย</b>
                <ul>
                    <li><input type="radio" name="payment" id="payment"/> ชำระเงินสด</li>
                    <li><input type="radio" name="payment" id="payment"/> โอนผ่านบัญชีธนาคาร</li>
                </ul>
            </th>
        </tr>
        <tr>
            <th colspan="5">
                <br/><br/>
                <div style="width:45%; float: left;">
                    ลงชื่อ
                    <div style="margin-top:0px; border-bottom:#999999 dotted 1px; color:#999999;"></div><br/>
                    <div style="text-align:center;">ผู้รับเงิน</div>
                </div>
            
                <div style="width:45%; float: right;">
                    ลงชื่อ
                    <div style="margin-top:0px; border-bottom:#999999 dotted 1px; color:#999999;"></div><br/>
                    <div style="text-align:center;">ผู้มีอำนาจลงนาม</div>
                </div>
            </th>
        </tr>
        
    </tfoot>
</table>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        var status = "<?php echo $status ?>";
        if(status > 0){
            $(".print").show();
            $("#btn-save").hide();
        } 
    })
    function saveInvoice(){
        var url = "<?php echo Yii::$app->urlManager->createUrl(['service/default/addinvoice']) ?>";
        var invoiceNumber = "<?php echo $invnumber ?>";
        var promiseId = "<?php echo $promise['id'] ?>";
        var total = "<?php echo $promise['total'] ?>";
        
        var data = {
            invoiceNumber: invoiceNumber,
            promiseId: promiseId,
            total: total,
            roundId: '',
		    monthyear: '',
            type: 2
        }
        //console.log(data);
        
        $.post(url,data,function(datas){
            $(".print").show();
            $("#btn-save").hide();
        });
        
    }

    function getInvoice(){
        var url = "<?php echo Yii::$app->urlManager->createUrl(['service/default/getinvoiceyear']) ?>";
        var promiseid = "<?php echo $promise['id'] ?>";
		var invoice = "<?php echo $invnumber ?>";
        var data = {
            promiseid: promiseid,
            invoice: invoice
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