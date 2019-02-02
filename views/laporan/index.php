<?php

use yii\helpers\Html;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $searchModel app\models\PenilaianSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = ($id) ? 'Laporan - ' . \app\models\Spk::namaSpk($id) : 'Laporan';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="laporan-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row" style="margin-top: 30px;">
        <div class="col-lg-2">
            <label>PILIH NAMA SPK</label>
        </div>
        <div class="col-lg-4">
            <?= Html::dropDownList('spk', $id, \yii\helpers\ArrayHelper::map($data_spk, 'id', 'nama_spk'), ['prompt' => '--PILIH--', 'class' => 'form-control', 'id' => 'pilih_spk']) ?>
        </div>
    </div>

    <?php if ($id): ?>
        <?php
        echo $this->render('_penilaian', [
            'penilaian' => $penilaian,
            'kriteria' => $kriteria,
            'nilai' => $nilai,
        ]);
        ?>

        <?php
        echo $this->render('_normalisasi', [
            'penilaian' => $penilaian,
            'kriteria' => $kriteria,
            'normalisasi' => $normalisasi,
        ]);
        ?>

        <?php
        echo $this->render('_rank', [
            'penilaian' => $penilaian,
            'kriteria' => $kriteria,
            'rank' => $rank,
        ]);
        ?>
    <?php endif; ?>
</div>

<?php
$this->registerJs(
    '

    $("#pilih_spk").on("change", function() {
        window.location.href = "' . \yii\helpers\Url::to(['index']) . '/" + this.value;
    });

    ',
    \yii\web\View::POS_READY,
    'alternatif-js'
);
?>