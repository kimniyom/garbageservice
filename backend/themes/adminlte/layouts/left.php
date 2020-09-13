<style>
    #text-header-side{
        color: rgb(116, 200, 255);
        font-weight: bold;;
    }

    .sidebar-menu li ul li a{
        font-size: 16px;
    }

    .sidebar ul .header{
        font-size: 16px;
    }
</style>
<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\customer\models\Customers;
use app\modules\promise\models\Promise;
use app\models\Confirmform;

$customerModel = new Customers();
$promiseModel = new Promise();
$confirmFormModel = new Confirmform();
$promiseall = $promiseModel->Countpromiseall();
$confirmformAll = $confirmFormModel->countConfirmform();
$contInvoice = $promiseModel->contInvoice();
$countCheckInvoice = $promiseModel->countCheckInvoice();
$countInvoiceNonActive = $promiseModel->contInvoiceNonActive();
?>
<aside class="main-sidebar" style=" z-index: 5;">

    <section class="sidebar" style=" font-family: supermarket; font-size: 18px;">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo Url::to('../images/logo-sm.png') ?>" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?php
                    if (!Yii::$app->user->isGuest) {
                        echo Yii::$app->user->identity->username;
                    }
                    ?></p>

                <i class="fa fa-circle text-success"></i> Online
            </div>
        </div>


        <?=
        dmstr\widgets\Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
                    'items' => [
                        ['label' => 'Menu', 'options' => ['class' => 'header', 'id' => 'text-header-side']],
                        ['label' => 'Dashboard', 'icon' => 'dashboard text-danger', 'url' => ['/site/index']],
                        ['label' => 'ข้อมูลลูกค้า', 'icon' => 'user text-info', 'url' => ['/'],
                            'items' => [
                                ['label' => 'ทั้งหมด', 'icon' => 'users', 'url' => ['/customer/customers/index']],
                                ['label' => 'เพิ่ม', 'icon' => 'plus', 'url' => ['/customer/customers/check']],
                            ],
                        ],
                        [
                            'label' => 'ใบเสนอราคา',
                            'icon' => 'file text-danger',
                            'url' => ['/customer/customers/quotation', 'status' => 0],
                            'template' => '<a href="{url}">{icon} {label}<span class="pull-right-container"><small class="label pull-right bg-red">' . $customerModel->countQuotation() . '</small></span></a>'
                        ],
                        ['label' => 'สัญญา', 'icon' => 'address-card-o text-info', 'url' => ['/'],
                            'items' => [
                                ['label' => 'กลุ่มคลินิก', 'icon' => 'h-square', 'url' => ['/promise/promise', 'group' => 1, 'groupname' => 'กลุ่มคลินิก']],
                                ['label' => 'กลุ่มโรงพยาบาล', 'icon' => 'hospital-o', 'url' => ['/promise/promise', 'group' => 2, 'groupname' => 'กลุ่มโรงพยาบาล']],
                                ['label' => 'กลุ่มบริษัท', 'icon' => 'building-o', 'url' => ['/promise/promise', 'group' => 3, 'groupname' => 'กลุ่มบริษัท']],
                                ['label' => 'กลุ่ม รพ.สต.', 'icon' => 'medkit', 'url' => ['/promise/promise', 'group' => 4, 'groupname' => 'กลุ่ม รพ.สต.']],
                                ['label' => 'กลุ่มหน่วยงานราชการ', 'icon' => 'building', 'url' => ['/promise/promise', 'group' => 5, 'groupname' => 'กลุ่มหน่วยงานราชการ']],
                                ['label' => 'กลุ่มอื่น ๆ', 'icon' => 'university', 'url' => ['/promise/promise', 'group' => 6, 'groupname' => 'กลุ่มอื่น ๆ']],
                            ],
                        ],
                        [
                            'label' => 'แบบยืนยันลูกค้า',
                            'icon' => 'file text-success',
                            'url' => ['/confirmform/confirmform'],
                            'template' => '<a href="{url}">{icon} {label}<span class="pull-right-container"><small class="label pull-right bg-green">' . $confirmformAll . '</small></span></a>'
                        ],
                        //['label' => 'รอบการเก็บขยะ', 'icon' => '', 'url' => ['/roundgarbage/roundgarbage']],
                        ['label' => 'รอบการเก็บขยะ', 'icon' => '', 'url' => ['/roundgarbage/roundgarbage/calendar']],
                        ['label' => 'บันทึกรายการจัดเก็บ', 'icon' => 'save text-success', 'url' => ['/'],
                            'items' => [
                                ['label' => 'ตามสัญญา', 'icon' => 'trash', 'url' => ['/service/default/index']],
                                ['label' => 'รายครั้ง', 'icon' => 'trash-o', 'url' => ['/service/servicepertime/index']],
                            ],
                        ],
                        ['label' => 'ใบวางบิล/ใบเสร็จ', 'icon' => 'file text-warning', 'url' => ['/service/default/mainbill']],
                        [
                            'label' => 'ลูกค้าค้างชำระเงิน',
                            'icon' => 'info text-danger',
                            'url' => ['/service/default/outstandingpaymenall'],
                            'template' => '<a href="{url}">{icon} {label}<span class="pull-right-container"><small class="label pull-right bg-red">' . $countInvoiceNonActive . '</small></span></a>'
                        ],
                        [
                            'label' => 'ตรวจสอบการชำระเงิน',
                            'icon' => 'check text-success',
                            'url' => ['/service/default/confirmorder'],
                            'template' => '<a href="{url}">{icon} {label}<span class="pull-right-container"><small class="label pull-right bg-orange">' . $contInvoice . '</small></span></a>'
                        ],
                        [
                            'label' => 'ยืนยันการชำระเงิน',
                            'icon' => 'check text-info',
                            'url' => ['/promise/promise/promisepay'],
                            'template' => '<a href="{url}">{icon} {label}<span class="pull-right-container"><small class="label pull-right bg-orange">' . $countCheckInvoice . '</small></span></a>'
                        ],
                        ['label' => 'บันทึกรายงานการเก็บขยะเกิน', 'icon' => 'check text-warning', 'url' => ['/service/default/genformgarbageover']],
                        ['label' => 'ออกใบส่งมอบงาน', 'icon' => 'file text-success', 'url' => ['/service/default/confirmorderonmonth']],
                        ['label' => 'ตั้งค่าระบบ', 'options' => ['class' => 'header', 'id' => 'text-header-side']],
                        //['label' => 'ผู้ใช้งาน(ลูกค้า)', 'icon' => 'users', 'url' => ['/user/admin']],
                        ['label' => 'ผู้ใช้งาน(เจ้าหน้าที่)', 'icon' => 'address-card', 'url' => ['/useremp/user/index']],
                        ['label' => 'บัญชีธนาคาร', 'icon' => 'book', 'url' => ['/bookbank/index']],
                        ['label' => 'รถจัดเก็บขยะ', 'icon' => 'car', 'url' => ['/car/car']],
                        ['label' => 'จัดการหน้าเว็บ', 'options' => ['class' => 'header', 'id' => 'text-header-side']],
                        ['label' => 'แนะนำสินค้าอื่นๆ', 'icon' => 'trash', 'url' => ['/garbagecontainer/garbagecontainer/index']],
                        ['label' => 'ข่าวสารและโปรโมชั่น', 'icon' => 'newspaper-o', 'url' => ['/news/news/index']],
                        ['label' => 'เมนูเว็บไซต์', 'icon' => 'bars', 'url' => ['/navbar/navbar/index']],
                    ],
                ]
        )
        ?>

    </section>

</aside>
