<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">APP</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <!-- Messages: style can be found in dropdown.less-->
                
                <!-- User Account: style can be found in dropdown.less -->

                <li class="dropdown user user-menu" style="margin-right: 40px;">
                    <?php if (Yii::$app->user->isGuest): ?>
                        <?= Html::a('Login',['/site/login']) ?>
                    <?php else: ?>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="hidden-xs"><?= Yii::$app->user->identity->username ?></span>
                        </a>
                        <ul class="dropdown-menu" style="width: 100%">
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <?= Html::a(
                                    'Setting',
                                    ['/user/view/', 'id' => Yii::$app->user->id]
                                ) ?>
                            </li>
                            <li class="user-footer">
                                <?= Html::a(
                                    'Sign out',
                                    ['/site/logout'],
                                    ['data-method' => 'post']
                                ) ?>
                            </li>
                        </ul>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </nav>
</header>
