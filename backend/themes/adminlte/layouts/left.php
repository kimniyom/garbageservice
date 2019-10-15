<?php
  use yii\helpers\Html;
  use yii\helpers\Url;
?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo Url::to('@web/web/images/System-settings-icon.png')?>" class="img-circle" alt="User Image"/>
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
                            ['label' => 'Menu Backend', 'options' => ['class' => 'header']],
                            ['label' => 'ข้อมูลลูกค้า', 'icon' => 'user', 'url' => ['/'],
                            'items' => [
                                    ['label' => 'ทั้งหมด', 'icon' => 'users', 'url' => ['/customer/customers/index']],
                                    ['label' => 'เพิ่ม', 'icon' => 'plus', 'url' => ['/customer/customers/check']],
                            //['label' => 'รายเดือน', 'icon' => '', 'url' => '#'],
                            //['label' => 'รายปี', 'icon' => '', 'url' => '#'],
                            ],
                        ],
                            ['label' => 'สัญญา', 'icon' => 'fa fa-address-card-o', 'url' => ['/promise/promise']],
                            ['label' => 'ผู้ใช้งาน', 'icon' => 'users', 'url' => ['/user/admin']],
                        //['label' => 'รอบเก็บ', 'icon' => 'download', 'url' => ['/gii'],
                        //'items' => [
                        // ['label' => 'รอบการเก็บขยะ', 'icon' => '', 'url' => ['/roundgarbage/roundgarbage']],
                        //['label' => 'รอบการเก็บเงิน', 'icon' => '', 'url' => ['/roundmoney/roundmoney']],
                        //],
                        //],

                        ['label' => 'บันทึกรายการจัดเก็บ', 'icon' => 'save', 'url' => ['/service/default/index']],
                        ['label' => 'ใบวางบิล/ใบแจ้งยอด', 'icon' => 'file', 'url' => ['/service/default/mainbill']],
                        ['label' => 'ตรวจสอบการชำระเงิน', 'icon' => 'check', 'url' => ['/service/default/confirmorder']],
                        ['label' => 'ภาชนะใส่ขยะ', 'icon' => 'trash', 'url' => ['/garbagecontainer/garbagecontainer/index']],
                        ['label' => 'ข่าวสารและโปรโมชั่น', 'icon' => 'newspaper-o', 'url' => ['/news/news/index']],
                        ['label' => 'เมนูเว็บไซต์', 'icon' => 'bars', 'url' => ['/navbar/navbar/index']],
                        ['label' => 'รายงาน', 'icon' => 'wpforms', 'url' => ['/gii'],
                        'items' => [
                          ['label' => 'ค่าบริการประจำเดือน ', 'icon' => '', 'url' => ['/report/report/monthservicefee']],
                          ['label' => 'ค้างจ่ายค่าบริการประจำเดือน', 'icon' => '', 'url' => ['/report/report/accruedservicefee']],
                          ['label' => 'ค่าบริการรายลูกค้า', 'icon' => '', 'url' => ['/report/report/customerservicefee']],
                        ],
                    ],
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
