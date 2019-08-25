<?php

$this->title = 'ตรวจสอบสัญญารอยืนยัน';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="promise-nearexpire">
<div class="box">
    <!-- /.box-header -->
    <div class="box-body">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>เลขที่สัญญา บริษัท</th>
                    <th></th>
                    <th>ติดต่อ</th>
                    <th>วันสิ้นสุดสัญญา</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php $i = 0;foreach ($promise as $rs): $i++;?>
	                <tr>
	                    <td><?php echo $i ?></td>
	                    <td>
	                        <?php echo $rs['promisenumber'] ?><br/>
	                        <?php echo $rs['company'] ?>
	                    </td>
	                    <td>
	                        <?php echo "คุณ " . $rs['manager'] ?><br/>
	                        <?php echo $rs['tel'] ?> <?php echo ($rs['telephone']<>"") ? "," . $rs['telephone'] : "" ?>
	                    </td>
	                    <td><?php echo $rs['promisedateend'] ?></td>
	                    <td>
                            <a href="<?php echo Yii::$app->urlManager->createUrl(['promise/promise/view', 'id' => $rs['id']]) ?>">
                            ตรวจสอบข้อมูล</a>
	                    </td>
	                </tr>
	            <?php endforeach;?>
            </tbody>
        </table>
    </div>
    <!-- /.box-body -->
    </div>
    <!-- /.box -->
</div>
