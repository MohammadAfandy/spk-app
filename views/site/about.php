<?php

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box-header with-border">
    <h2 class="box-title"><?= Html::encode($this->title) ?></h2>
</div>
<div class="box-body" style="margin-top: 30px;">
    <h2>Feel free to contact me</h2>
    <div style="font-size: 50px;">
        <?= Html::a('', 'https://www.github.com/mohammadafandy', ['class' => 'fa fa-github fa-lg', 'target' => 'blank']) ?>&nbsp;
        <?= Html::a('', 'https://wa.me/6289646433702', ['class' => 'fa fa-whatsapp fa-lg', 'target' => 'blank']) ?>
    </div>
    
</div>