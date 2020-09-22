<?php
echo $dayname;
?>
<table class="table" id="customer-event">
    <thead>
        <tr>
            <th>#</th>
            <th>ลูกค้า</th>
            <th>ที่อยู่</th>
            <th>ติดต่อ</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach ($customer as $rs): $i++;
            ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $rs['company'] ?></td>
                <td><?php echo $rs['address'] . " ต." . $rs['tambon_name'] . " อ." . $rs['ampur_name'] . " จ." . $rs['changwat_name'] ?></td>
                <td><?php echo ($rs['tel']) ? $rs['tel'] : ""; ?> <?php echo ($rs['telephone']) ? $rs['telephone'] : ""; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script type="text/javascript">
    $(document).ready(function() {
        $('#customer-event').DataTable({
            dom: 'Bfrtip',
            buttons: [
                //'copyHtml5',
                //'excelHtml5',
                {
                    extend: 'excel',
                    text: 'ส่งออก excel',
                    title: '<?php echo $filename ?>'
                },
                        //'csvHtml5',
                        //'pdfHtml5'
            ],
            'paging': false,
            'lengthChange': true,
            'searching': false,
            'ordering': true,
            'info': false,
            'autoWidth': false
        });
    });
</script>
