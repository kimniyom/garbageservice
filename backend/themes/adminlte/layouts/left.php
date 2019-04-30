<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?php if (!Yii::$app->user->isGuest) {echo Yii::$app->user->identity->username;}?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Menu Backend', 'options' => ['class' => 'header']],
                    ['label' => 'ข้อมูลลูกค้า', 'icon' => 'file-code-o', 'url' => ['/gii'], 
                        'items'=>[
                            ['label'=>'รายเดือน', 'icon'=>'', 'url'=>'#'],
                            ['label'=>'รายปี', 'icon'=>'', 'url'=>'#'],
                        ]
                    ],
                    ['label' => 'อัตราค่าบริการ', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                    ['label' => 'ข่าวสารและโปรโมชั่น', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                    ['label' => 'รายงาน', 'icon' => 'file-code-o', 'url' => ['/gii'], 
                        'items'=>[
                                ['label'=>'ค่าบริการประจำเดือน ', 'icon'=>'', 'url'=>'#'],
                                ['label'=>'ค้างจ่ายค่าบริการประจำเดือน', 'icon'=>'', 'url'=>'#'],
                                ['label'=>'ค่าบริการรายลูกค้า', 'icon'=>'', 'url'=>'#'],
                        ]
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
                    ],*/
                ],
            ]
        ) ?>

    </section>

</aside>
