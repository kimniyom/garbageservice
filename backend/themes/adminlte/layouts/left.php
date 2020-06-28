<style>
    #text-header-side{
        color: rgb(116, 200, 255);
        font-weight: bold;;
    }
</style>
<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\customer\models\Customers;
use app\modules\promise\models\Promise;

$customerModel = new Customers();
$promiseModel = new Promise();
$promiseall = $promiseModel->Countpromiseall();

?>
<aside class="main-sidebar">

    <section class="sidebar" >

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo Url::to('@web/web/images/System-settings-icon.png') ?>" class="img-circle" alt="User Image"/>
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

        <!-- search form -->
        <!--
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                    <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        -->
        <!-- /.search form -->

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
                            //['label' => 'ประเภทธุรกิจลูกค้า', 'icon' => 'plus', 'url' => ['/typecustomer/typecustomer/']],
                            //['label' => 'รายเดือน', 'icon' => '', 'url' => '#'],
                            //['label' => 'รายปี', 'icon' => '', 'url' => '#'],
                            ],
                        ],
                        [
                            'label' => 'ใบเสนอราคา', 
                            'icon' => 'file text-danger', 
                            'url' => ['/customer/customers/quotation','status' => 0],
                            'template' => '<a href="{url}">{icon} {label}<span class="pull-right-container"><small class="label pull-right bg-red">' . $customerModel->countQuotation() . '</small></span></a>'
                            ],
                        [
                            'label' => 'สัญญา',
                            'icon' => 'fa fa-address-card-o',
                            'url' => ['/promise/promise'],
                            'template' => '<a href="{url}">{icon} {label}<span class="pull-right-container"><small class="label pull-right bg-yellow">' . $promiseall . '</small></span></a>'
                        ],
                        //['label' => 'รอบเก็บ', 'icon' => 'download', 'url' => ['/gii'],
                        //'items' => [
                        // ['label' => 'รอบการเก็บขยะ', 'icon' => '', 'url' => ['/roundgarbage/roundgarbage']],
                        //['label' => 'รอบการเก็บเงิน', 'icon' => '', 'url' => ['/roundmoney/roundmoney']],
                        //],
                        //],
                        ['label' => 'บันทึกรายการจัดเก็บ', 'icon' => 'save text-success', 'url' => ['/service/default/index']],
                        ['label' => 'ใบวางบิล/ใบแจ้งยอด', 'icon' => 'file text-warning', 'url' => ['/service/default/mainbill']],
                        ['label' => 'ตรวจสอบการชำระเงิน', 'icon' => 'check text-primary', 'url' => ['/service/default/confirmorder']],
                        /*
                        ['label' => 'รายงาน', 'icon' => 'wpforms text-default', 'url' => ['/gii'],
                            'items' => [
                                ['label' => 'ค่าบริการประจำเดือน ', 'icon' => '', 'url' => ['/report/report/monthservicefee']],
                                ['label' => 'ค้างจ่ายค่าบริการประจำเดือน', 'icon' => '', 'url' => ['/report/report/accruedservicefee']],
                                ['label' => 'ค่าบริการรายลูกค้า', 'icon' => '', 'url' => ['/report/report/customerservicefee']],
                            ],
                        ],
                         * 
                         */
                        ['label' => 'ตั้งค่าระบบ', 'options' => ['class' => 'header', 'id' => 'text-header-side']],
                        ['label' => 'ผู้ใช้งาน', 'icon' => 'users', 'url' => ['/user/admin']],
                        ['label' => 'บัญชีธนาคาร', 'icon' => 'book', 'url' => ['/bookbank/index']],
                        ['label' => 'จัดการหน้าเว็บ', 'options' => ['class' => 'header', 'id' => 'text-header-side']],
                        ['label' => 'แนะนำสินค้าอื่นๆ', 'icon' => 'trash', 'url' => ['/garbagecontainer/garbagecontainer/index']],
                        ['label' => 'ข่าวสารและโปรโมชั่น', 'icon' => 'newspaper-o', 'url' => ['/news/news/index']],
                        ['label' => 'เมนูเว็บไซต์', 'icon' => 'bars', 'url' => ['/navbar/navbar/index']],
                    /*
                      ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                      ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                      [
                      'label' => 'Some tools',
                      'icon' => 'share',
                      'url' => '#',
                      'items' => [
                      ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                      ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                      [
                      'label' => 'Level One',
                      'icon' => 'circle-o',
                      'url' => '#',
                      'items' => [
                      ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
                      [
                      'label' => 'Level Two',
                      'icon' => 'circle-o',
                      'url' => '#',
                      'items' => [
                      ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                      ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                      ],
                      ],
                      ],
                      ],
                      ],
                     */
                    ],
                ]
        )
        ?>

    </section>

</aside>
