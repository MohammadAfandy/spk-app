<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Spk */

$this->title = 'Tambah SPK';
$this->params['breadcrumbs'][] = ['label' => 'SPK', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box-header with-border">
    <h2 class="box-title"><?= Html::encode($this->title) ?></h2>
</div>
<div class="box-body">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
