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
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'SPK', 'url' => ['/spk/index']],
            ['label' => 'Alternatif', 'url' => ['/alternatif/index']],
            ['label' => 'Kriteria', 'url' => ['/kriteria/index']],
            ['label' => 'Penilaian', 'url' => ['/penilaian/index']],
            ['label' => 'Hasil', 'url' => ['/hasil/index']],
            ['label' => 'User Management', 'url' => ['/admin/assignment/index']],
        ];

        $menuItems = Helper::filter($menuItems);
        ?>
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => $menuItems,
            ]
        ) ?>

    </section>

</aside>
