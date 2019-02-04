<?php

use yii\helpers\Html;
use app\components\Helpers;

/* @var $this yii\web\View */
/* @var $model app\models\Penilaian */

$this->title = 'Tambah Penilaian - ' . Helpers::getNamaSpkByIdSpk($id);
$this->params['breadcrumbs'][] = ['label' => 'Penilaian', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box-header with-border">
    <h2 class="box-title"><?= Html::encode($this->title) ?></h2>
</div>
<div class="box-body">

    <?= $this->render('_form', [
        'model' => $model,
        'alternatif' => $alternatif,
        'kriteria' => $kriteria,
        'id' => $id,
    ]) ?>

</div>
