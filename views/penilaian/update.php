<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Penilaian */

$this->title = 'Update Penilaian - ' . \app\models\Alternatif::namaAlternatif($model->id_alternatif);
$this->params['breadcrumbs'][] = ['label' => 'Penilaian', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="penilaian-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'alternatif' => $alternatif,
        'kriteria' => $kriteria,
        'nilai' => $nilai,
        'id' => $id,
    ]) ?>

</div>
