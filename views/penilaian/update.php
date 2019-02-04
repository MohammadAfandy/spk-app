<?php

use yii\helpers\Html;
use app\components\Helpers;

/* @var $this yii\web\View */
/* @var $model app\models\Penilaian */

$this->title = 'Update Penilaian - ' . Helpers::getNamaAlternatifByIdPenilaian($model->id);
$this->params['breadcrumbs'][] = ['label' => 'Penilaian', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="box-header with-border">
    <h2 class="box-title"><?= Html::encode($this->title) ?></h2>
</div>
<div class="box-body">

    <?= $this->render('_form', [
        'model' => $model,
        'alternatif' => $alternatif,
        'kriteria' => $kriteria,
        'nilai' => $nilai,
        'id' => $id,
    ]) ?>

</div>
