<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Penilaian;
use app\models\Spk;
use app\models\Kriteria;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PenilaianSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = ($spk) ? 'Hasil - SPK ' . Spk::namaSpk($spk) . ' - Metode ' . strtoupper($metode) : 'Hasil';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
.nav-tabs {
    padding-left: 15px;
    margin-bottom: 0;
    border: none;
}
.tab-content {
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 15px;
}
</style>

<div class="box-header with-border">
    <h2 class="box-title"><?= Html::encode($this->title) ?></h2>
</div>
<div class="box-body">

    <form>
        <div class="row" style="margin-top: 30px;">
            <div class="col-lg-5">
                <?= Html::dropDownList('spk', $spk, \yii\helpers\ArrayHelper::map($data_spk, 'id', 'nama_spk'), ['prompt' => '--PILIH SPK--', 'class' => 'form-control', 'id' => 'pilih_spk']) ?>
            </div>
            <div class="col-lg-3">
                <?= Html::dropDownList('metode', $metode, ['saw' => 'SAW (Simple Additive Weighting)', 'wp' => 'WP (Weighted Product)'], ['prompt' => '--PILIH METODE--', 'class' => 'form-control', 'id' => 'pilih_metode']) ?>
            </div>
            <div class="col-lg-3">
                <?= Html::submitButton('PROSES', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </form>

    <?php if ($spk && $metode): ?>
        <?php if (Kriteria::cekBobotKosong($spk)): ?>
            <div class="alert alert-danger" style="margin-top: 20px">
                <strong>Perhatian ! </strong>Data bobot kriteria masih ada yang belum diset atau 0, harap cek <?= Html::a('Data Kriteria', ['kriteria/index', 'id' => $spk]) ?>
            </div>
        <?php elseif (!Penilaian::cekKriteriaSesuaiPenilaian($spk, count($kriteria))): ?>
            <div class="alert alert-danger" style="margin-top: 20px">
                <strong>Perhatian ! </strong>Data penilaian yang diinput tidak sesuai dengan jumlah kriteria, harap cek <?= Html::a('Data Penilaian', ['penilaian/index', 'id' => $spk]) ?>
            </div>
        <?php else: ?>
            <div class="alert alert-info" style="margin-top: 20px">
                Berdasarkan Sistem Pendukung Keputusan <strong><?= ucwords(Spk::namaSpk($spk)) ?></strong> menggunakan <strong>Metode <?= strtoupper($metode) ?></strong>, maka diperoleh hasil bahwa <strong>Alternatif Terbaik</strong> adalah <strong><?= ($metode === 'saw') ? ucwords(Penilaian::namaAlternatif(key($hasil['rank']))) : ucwords(Penilaian::namaAlternatif(key($hasil['vektor_v']))) ?></strong>
            </div>
            <div class="panel-body" style="margin-top: 30px;">
                <?php
                $items[] = [
                    'label' => 'Penilaian',
                    'content' => $this->render('_penilaian', [
                        'penilaian' => $penilaian,
                        'kriteria' => $kriteria,
                        'nilai' => $nilai,
                    ]),
                ];
    
                if ($metode === 'saw') {
                    $items[] = [
                        'label' => 'Normalisasi',
                        'content' => $this->render('saw/_normalisasi', [
                            'penilaian' => $penilaian,
                            'kriteria' => $kriteria,
                            'normalisasi' => $hasil['normalisasi'],
                        ]),
                    ];
                    $items[] = [
                        'label' => 'Ranking',
                        'content' => $this->render('saw/_rank', [
                            'penilaian' => $penilaian,
                            'kriteria' => $kriteria,
                            'rank' => $hasil['rank'],
                        ]),
                    ];
                } else if ($metode === 'wp') {
                    $items[] = [
                        'label' => 'Vektor S',
                        'content' => $this->render('wp/_vektor_s', [
                            'penilaian' => $penilaian,
                            'kriteria' => $kriteria,
                            'vektor_s' => $hasil['vektor_s'],
                        ]),
                    ];
                    $items[] =  [
                        'label' => 'Vektor V',
                        'content' => $this->render('wp/_vektor_v', [
                            'penilaian' => $penilaian,
                            'kriteria' => $kriteria,
                            'vektor_v' => $hasil['vektor_v'],
                        ]),
                    ];
                }
                echo \yii\bootstrap\Tabs::widget([
                    'items' => $items,
                ]);
                ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>