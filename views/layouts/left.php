<?php
use mdm\admin\components\Helper;
?>

<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <ul class="sidebar-menu">
            <li class="header">MAIN MENU</li>
        </ul>
        <!-- /.search form -->
        <?php
        $menuItems = [
            ['label' => 'Home', 'url' => ['/site/index'], 'icon' => 'home'],
            ['label' => 'SPK', 'url' => ['/spk/index'], 'icon' => 'database'],
            ['label' => 'Alternatif', 'url' => ['/alternatif/index'], 'icon' => 'user'],
            ['label' => 'Kriteria', 'url' => ['/kriteria/index'], 'icon' => 'random'],
            ['label' => 'Penilaian', 'url' => ['/penilaian/index'], 'icon' => 'bar-chart'],
            ['label' => 'Hasil', 'url' => ['/hasil/index'], 'icon' => 'pie-chart'],
            ['label' => 'User Management', 'url' => ['/admin/assignment/index'], 'icon' => 'users '],
            ['label' => 'About', 'url' => ['/site/about'], 'icon' => 'info'],
        ];

        $menuItems = Helper::filter($menuItems);
        if (Yii::$app->user->isGuest) {
            $menuItems[] = ['label' => 'Home', 'url' => ['/site/index']];
            $menuItems[] = ['label' => 'About', 'url' => ['/site/about']];
        }
        ?>
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => $menuItems,
            ]
        ) ?>

    </section>

</aside>
