<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Alternatif */

$this->title = 'Tambah Alternatif - ' . \app\models\Spk::namaSpk($id);
$this->params['breadcrumbs'][] = ['label' => 'Alternatif', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alternatif-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'id' => $id,
    ]) ?>

</div>
