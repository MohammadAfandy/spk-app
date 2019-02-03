<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Penilaian;
use app\models\Spk;

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

<div class="laporan-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <form>
        <div class="row" style="margin-top: 30px;">
            <div class="col-lg-5">
                <?= Html::dropDownList('spk', $spk, \yii\helpers\ArrayHelper::map($data_spk, 'id', 'nama_spk'), ['prompt' => '--PILIH SPK--', 'class' => 'form-control', 'id' => 'pilih_spk']) ?>
            </div>
            <div class="col-lg-3">
                <?= Html::dropDownList('metode', $metode, ['saw' => 'SAW (Simple Additive Weighting)', 'wp' => 'WP (Weighted Product)'  ], ['prompt' => '--PILIH METODE--', 'class' => 'form-control', 'id' => 'pilih_metode']) ?>
            </div>
            <div class="col-lg-3">
                <?= Html::submitButton('PROSES', [
                    'class' => 'btn btn-success',
                ]) ?>
            </div>
        </div>
    </form>

    <?php if ($spk && $metode): ?>
        <div class="alert alert-info" style="margin-top: 20px">
            Berdasarkan Sistem Pendukung Keputusan <strong><?= ucwords(Spk::namaSpk($spk)) ?></strong> menggunakan <strong>Metode <?= strtoupper($metode) ?></strong>, maka diperoleh hasil bahwa <strong>Alternatif Terbaik</strong> adalah <strong><?= ($metode === 'saw') ? ucwords(Penilaian::namaAlternatif(key($hasil['rank']))) : ucwords(Penilaian::namaAlternatif(key($hasil['vektor_v']))) ?></strong>
        </div>
        <div class="panel-body" style="margin-top: 30px;">
            <?php
            if ($metode === 'saw') {
                echo \yii\bootstrap\Tabs::widget([
                    'items' => [
                        [
                            'label' => 'Penilaian',
                            'content' => $this->render('_penilaian', [
                                'penilaian' => $penilaian,
                                'kriteria' => $kriteria,
                                'nilai' => $nilai,
                            ]),
                        ],
                        [
                            'label' => 'Normalisasi',
                            'content' => $this->render('saw/_normalisasi', [
                                'penilaian' => $penilaian,
                                'kriteria' => $kriteria,
                                'normalisasi' => $hasil['normalisasi'],
                            ]),
                        ],
                        [
                            'label' => 'Ranking',
                            'content' => $this->render('saw/_rank', [
                                'penilaian' => $penilaian,
                                'kriteria' => $kriteria,
                                'rank' => $hasil['rank'],
                            ]),
                        ],
                    ],
                ]);
            } else if ($metode === 'wp') {
                echo \yii\bootstrap\Tabs::widget([
                    'items' => [
                        [
                            'label' => 'Penilaian',
                            'content' => $this->render('_penilaian', [
                                'penilaian' => $penilaian,
                                'kriteria' => $kriteria,
                                'nilai' => $nilai,
                            ]),
                        ],
                        [
                            'label' => 'Vektor S',
                            'content' => $this->render('wp/_vektor_s', [
                                'penilaian' => $penilaian,
                                'kriteria' => $kriteria,
                                'vektor_s' => $hasil['vektor_s'],
                            ]),
                        ],
                        [
                            'label' => 'Vektor V',
                            'content' => $this->render('wp/_vektor_v', [
                                'penilaian' => $penilaian,
                                'kriteria' => $kriteria,
                                'vektor_v' => $hasil['vektor_v'],
                            ]),
                        ],
                    ],
                ]);
            }
            ?>
        </div>
    <?php endif; ?>
</div>