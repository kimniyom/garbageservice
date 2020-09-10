<style type="text/css">
    .panel-body ul li{
        clear: both;
        width: 100%;
        padding: 10px;
    }
</style>
<?php
/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use dektrium\user\widgets\UserMenu;

/**
 * @var dektrium\user\models\User $user
 */
$user = Yii::$app->user->identity;
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title" style="border-bottom: #eeeeee 1px solid;">
            <?= $user->username ?>
        </h3>
    </div>
    <div class="panel-body">
        <?= UserMenu::widget() ?>
        <hr/>
        <a href="<?php echo Yii::$app->urlManager->createUrl('site') ?>" style=" margin-left: 10px; padding-top: 10px;"><i class="fa fa-arrow-left"></i> กลับหน้าหลัก</a>
    </div>
</div>
