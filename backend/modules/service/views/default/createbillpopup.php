<div style="background:#ffffff; padding:10px;">
    <h4 style="text-align: center;">ใบวางบิล / ใบแจ้งหนี้</h4>
<div style="width:50%; float: left;">
    <b></b>ไอซี ควอลิตี้ ซิสเท็ม<br/>
    โทรสัพท์ 02-1010325<br/>
    ชื่อลูกค้า <?php echo $customer['company'] ?>
    </div>
    <div style="width:30%; float: right; text-align: right;">
        อ้างจากสัญญา <?php echo $promise['promisenumber'] ?><br/>
        วันที่ <?php echo date("d/m/Y") ?>
    </div>
<table class="table table-bordered">
    <thead>
        <tr>
            <th colspan="5">
                ประจำงวดที่ <?php echo $rounddate ?>
            </th>
        </tr>
        <tr>
            <th>#</th>
            <th>รายการ</th>
            <th>ปริมาณขยะ</th>
            <th>ขยะเกิน</th>
            <th>ค่าใช้จ่าย</th>
        </tr>
    </thead>
    <tbody>
    <?php $i = 0;foreach ($billdetail as $rs): $i++;?>
										        <tr>
										            <td><?php echo $i ?></td>
										            <td>ค่ากำจัดขยะติดเชื้อ รอบที่ <?php echo $rs['round'] ?></td>
										            <td><?php echo $rs['amount'] ?></td>
										            <td><?php echo $rs['garbageover'] ?></td>
										            <td></td>
										        </tr>
										    <?php endforeach;?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3">
                (อักษร)
            </td>
            <td>ยอดเงินสุทธิ</td>
            <td></td>
        </tr>

    </tfoot>
</table>
</div>