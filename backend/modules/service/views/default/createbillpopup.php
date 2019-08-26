<?php
use app\models\Config;
$Config = new Config();
?>
<div style="background:#ffffff; padding:10px;">
<h4 style="text-align: center;">ใบวางบิล / ใบแจ้งหนี้</h4>
<div style="width:50%; float: left;">
    <b></b>ไอซี ควอลิตี้ ซิสเท็ม<br/>
    โทรศัพท์ 02-1010325<br/>
    ชื่อลูกค้า <?php echo $customer['company'] ?>
    </div>
    <div style="width:30%; float: right; text-align: right;">
        อ้างจากสัญญา <?php echo $promise['promisenumber'] ?><br/>
        วันที่ <?php echo date("d/m/Y") ?>
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
    ?>
						    <tr>
					            <td><?php echo $i ?></td>
					            <td>ค่ากำจัดขยะติดเชื้อ รอบที่ <?php echo $rs['round'] ?></td>
					            <td style="text-align:right;"><?php echo $rs['amount'] ?></td>
					            <td style="text-align:right;"><?php echo $promise['unitprice'] ?></td>
					            <td style="text-align:right;">
                                <?php 
                                    echo $promise['fine'].' x '.$rs['garbageover'];
                                    echo ' = '.number_format($fineprice);
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
            </th style="text-align:center;">
            <th style="text-align:center;">ยอดเงินสุทธิ</th>
            <th style="text-align:right;"><?php echo number_format($sum) ?></th>
        </tr>
    </tfoot>
</table>
</div>