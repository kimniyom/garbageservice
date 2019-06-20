<?php

use app\models\Config;
use yii\helpers\Url;
$urlMap = new Config();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>ค้นหาสถานที่</title>
        <style type="text/css">
            html { height: 100% }
            body {
                height:100%;
                margin:0;padding:0;
                font-family:tahoma, "Microsoft Sans Serif", sans-serif, Verdana;
                font-size:12px;
            }
            /* css กำหนดความกว้าง ความสูงของแผนที่ */
            #map_canvas {
                width:100%;
                height:100%;
                margin:auto;
                margin-top:0px;
            }
        </style>


    </head>

    <body>
        <div id="map_canvas"></div>
        <div id="showDD" style="margin:auto;width:40%; position: absolute; top: 0px; padding: 20px; background: #FFFFFF; z-index: 0; right: 0px;">
            <!--textbox กรอกชื่อสถานที่ และปุ่มสำหรับการค้นหา เอาไว้นอกแท็ก <form>-->
            <a href="<?php echo Url::to(['customer/customers/views', 'userid' => $userid]) ?>" style=" text-decoration: none;">กลับ </a>| ค้นหาสถานที่
            <input name="namePlace" type="text" id="namePlace" size="40" />
            <input type="button" name="SearchPlace" id="SearchPlace" value="ค้นหา" />
            <hr />
            <!--  <form> เก็บข้อมูลสำหรับนำไปบันทึกลงฐานข้อมูล หรือนำไปใช้อื่นๆ-->
                <input type="text" id="customer_id" value="<?php echo $customer_id ?>">
                <input type="text" id="user_id" value="<?php echo $userid ?>">
            Latitude
            <input name="lat_value" type="text" id="lat_value" value="0" size="17" />
            Longitude
            <input name="lon_value" type="text" id="lon_value" value="0" size="17" />
            Zoom
            <input name="zoom_value" type="text" id="zoom_value" value="0" size="5" />
            <br/><br/>
            <input type="button" name="button" id="button" value="บันทึก" onclick="gettravel()"/>
        </div>

        <script type="text/javascript" src="<?php echo Url::to('@web/web/theme/js/jquery-3.3.1.min.js') ?>"></script>
        <script type="text/javascript">
                var geocoder; // กำหนดตัวแปรสำหรับ เก็บ Geocoder Object ใช้แปลงชื่อสถานที่เป็นพิกัด
                var map; // กำหนดตัวแปร map ไว้ด้านนอกฟังก์ชัน เพื่อให้สามารถเรียกใช้งาน จากส่วนอื่นได้
                var my_Marker; // กำหนดตัวแปรสำหรับเก็บตัว marker
                var GGM; // กำหนดตัวแปร GGM ไว้เก็บ google.maps Object จะได้เรียกใช้งานได้ง่ายขึ้น

                function initialize() { // ฟังก์ชันแสดงแผนที่
                    GGM = new Object(google.maps); // เก็บตัวแปร google.maps Object ไว้ในตัวแปร GGM
                    geocoder = new GGM.Geocoder(); // เก็บตัวแปร google.maps.Geocoder Object
                    // กำหนดจุดเริ่มต้นของแผนที่
                    var my_Latlng = new GGM.LatLng(16.905357, 99.131176);
                    //var my_mapTypeId = GGM.MapTypeId.ROADMAP; // กำหนดรูปแบบแผนที่ที่แสดง

                    // กำหนด DOM object ที่จะเอาแผนที่ไปแสดง ที่นี้คือ div id=map_canvas
                    var my_DivObj = $("#map_canvas")[0];
                    // กำหนด Option ของแผนที่
                    var myOptions = {
                        zoom: 13, // กำหนดขนาดการ zoom
                        center: my_Latlng, // กำหนดจุดกึ่งกลาง จากตัวแปร my_Latlng
                        // mapTypeId: my_mapTypeId // กำหนดรูปแบบแผนที่ จากตัวแปร my_mapTypeId
                        mapTypeId: 'hybrid'
                    };
                    map = new GGM.Map(my_DivObj, myOptions); // สร้างแผนที่และเก็บตัวแปรไว้ในชื่อ map

                    my_Marker = new GGM.Marker({// สร้างตัว marker ไว้ในตัวแปร my_Marker
                        position: my_Latlng, // กำหนดไว้ที่เดียวกับจุดกึ่งกลาง
                        map: map, // กำหนดว่า marker นี้ใช้กับแผนที่ชื่อ instance ว่า map
                        draggable: true, // กำหนดให้สามารถลากตัว marker นี้ได้
                        title: "คลิกลากเพื่อหาตำแหน่งจุดที่ต้องการ!" // แสดง title เมื่อเอาเมาส์มาอยู่เหนือ
                    });

                    // กำหนด event ให้กับตัว marker เมื่อสิ้นสุดการลากตัว marker ให้ทำงานอะไร
                    GGM.event.addListener(my_Marker, 'dragend', function () {
                        var my_Point = my_Marker.getPosition();  // หาตำแหน่งของตัว marker เมื่อกดลากแล้วปล่อย
                        map.panTo(my_Point); // ให้แผนที่แสดงไปที่ตัว marker
                        $("#lat_value").val(my_Point.lat());  // เอาค่า latitude ตัว marker แสดงใน textbox id=lat_value
                        $("#lon_value").val(my_Point.lng());  // เอาค่า longitude ตัว marker แสดงใน textbox id=lon_value
                        $("#zoom_value").val(map.getZoom());  // เอาขนาด zoom ของแผนที่แสดงใน textbox id=zoom_valu
                    });


                    GGM.event.addListener(my_Marker, 'click', function () {
                        var my_Point = my_Marker.getPosition();  // หาตำแหน่งของตัว marker เมื่อกดลากแล้วปล่อย
                        map.panTo(my_Point); // ให้แผนที่แสดงไปที่ตัว marker
                        $("#lat_value").val(my_Point.lat());  // เอาค่า latitude ตัว marker แสดงใน textbox id=lat_value
                        $("#lon_value").val(my_Point.lng());  // เอาค่า longitude ตัว marker แสดงใน textbox id=lon_value
                        $("#zoom_value").val(map.getZoom());  // เอาขนาด zoom ของแผนที่แสดงใน textbox id=zoom_valu

                    });


                    // กำหนด event ให้กับตัวแผนที่ เมื่อมีการเปลี่ยนแปลงการ zoom
                    GGM.event.addListener(map, 'zoom_changed', function () {
                        $("#zoom_value").val(map.getZoom());   // เอาขนาด zoom ของแผนที่แสดงใน textbox id=zoom_value
                    });

                }
                $(function () {
                    // ส่วนของฟังก์ชันค้นหาชื่อสถานที่ในแผนที่
                    var searchPlace = function () { // ฟังก์ชัน สำหรับคันหาสถานที่ ชื่อ searchPlace
                        var AddressSearch = $("#namePlace").val();// เอาค่าจาก textbox ที่กรอกมาไว้ในตัวแปร
                        if (geocoder) { // ตรวจสอบว่าถ้ามี Geocoder Object
                            geocoder.geocode({
                                address: AddressSearch // ให้ส่งชื่อสถานที่ไปค้นหา
                            }, function (results, status) { // ส่งกลับการค้นหาเป็นผลลัพธ์ และสถานะ
                                if (status == GGM.GeocoderStatus.OK) { // ตรวจสอบสถานะ ถ้าหากเจอ
                                    var my_Point = results[0].geometry.location; // เอาผลลัพธ์ของพิกัด มาเก็บไว้ที่ตัวแปร
                                    map.setCenter(my_Point); // กำหนดจุดกลางของแผนที่ไปที่ พิกัดผลลัพธ์
                                    my_Marker.setMap(map); // กำหนดตัว marker ให้ใช้กับแผนที่ชื่อ map
                                    my_Marker.setPosition(my_Point); // กำหนดตำแหน่งของตัว marker เท่ากับ พิกัดผลลัพธ์
                                    $("#lat_value").val(my_Point.lat());  // เอาค่า latitude พิกัดผลลัพธ์ แสดงใน textbox id=lat_value
                                    $("#lon_value").val(my_Point.lng());  // เอาค่า longitude พิกัดผลลัพธ์ แสดงใน textbox id=lon_value
                                    $("#zoom_value").val(map.getZoom()); // เอาขนาด zoom ของแผนที่แสดงใน textbox id=zoom_valu
                                    if (results && results.length > 0) {
                                        var address = results[0].formatted_address;

                                        //var name = results[0].address_components[0].long_name;
                                        $("#detail").val(address);
                                    } else {
                                        var address = 'Cannot determine address at this location';
                                        //alert(address);
                                        $("#detail").val(address);
                                    }

                                } else {
                                    // ค้นหาไม่พบแสดงข้อความแจ้ง
                                    alert("Geocode was not successful for the following reason: " + status);
                                    $("#namePlace").val("");// กำหนดค่า textbox id=namePlace ให้ว่างสำหรับค้นหาใหม่
                                }
                            });
                        }
                    }
                    $("#SearchPlace").click(function () { // เมื่อคลิกที่ปุ่ม id=SearchPlace ให้ทำงานฟังก์ฃันค้นหาสถานที่
                        searchPlace();  // ฟังก์ฃันค้นหาสถานที่
                    });
                    $("#namePlace").keyup(function (event) { // เมื่อพิมพ์คำค้นหาในกล่องค้นหา
                        if (event.keyCode == 13) {  //  ตรวจสอบปุ่มถ้ากด ถ้าเป็นปุ่ม Enter ให้เรียกฟังก์ชันค้นหาสถานที่
                            searchPlace();      // ฟังก์ฃันค้นหาสถานที่
                        }
                    });

                });
                $(function () {
                    // โหลด สคริป google map api เมื่อเว็บโหลดเรียบร้อยแล้ว
                    // ค่าตัวแปร ที่ส่งไปในไฟล์ google map api
                    // v=3.2&sensor=false&language=th&callback=initialize
                    //  v เวอร์ชัน่ 3.2
                    //  sensor กำหนดให้สามารถแสดงตำแหน่งทำเปิดแผนที่อยู่ได้ เหมาะสำหรับมือถือ ปกติใช้ false
                    //  language ภาษา th ,en เป็นต้น
                    //  callback ให้เรียกใช้ฟังก์ชันแสดง แผนที่ initialize
                    $("<script/>", {
                        "type": "text/javascript",
                        src: "<?php echo $urlMap->Urlmap() ?>"
                    }).appendTo("body");
                });

                function gettravel() {
                    var namePlace = $("#namePlace").val();
                    var lat_value = $("#lat_value").val();
                    var lon_value = $("#lon_value").val();
                    var zoom_value = $("#zoom_value").val();
                    var customer_id = $("#customer_id").val();
                    var user_id = $("#user_id").val();
                    if (namePlace == 0 || lat_value == 0 || lon_value == 0) {
                        alert("สถานที่ไม่ถูกต้อง ...!");
                        return false;
                    }
                    var url = "<?php echo Yii::$app->urlManager->createUrl(['customer/customers/addlocation']) ?>" + "&customer_id=" + customer_id + "&cusname=" + namePlace + "&lat=" + lat_value + "&long=" + lon_value + "&zoom=" + zoom_value + "&user_id=" + user_id;
                    window.location = url;
                }
        </script>
    </body>
</html>