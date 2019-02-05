<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use app\components\Helpers;
/* @var $this yii\web\View */
/* @var $model app\models\Penilaian */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="panel-body">
    <div class="penilaian-form">
        <?php if (Yii::$app->session->hasFlash('failed')): ?>
            <div class="alert alert-danger">
                <?= Yii::$app->session->getFlash('failed') ?>
            </div>
        <?php endif; ?>
        <?php
        $form = ActiveForm::begin([
            'options' => [
                'enctype' => 'multipart/form-data',
            ],
            'layout' => 'horizontal',
        ]);
        ?>

        <?php if (($model->isNewRecord && $alternatif && $kriteria) || (!$model->isNewRecord) && $kriteria): ?>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <?= Html::textInput('nama_spk', Helpers::getNamaSpkByIdSpk($model->isNewRecord ? $id : $model->id_spk), ['disabled' => true, 'class' => 'form-control']) ?>
                </div>
            </div>
            <?php if ($model->isNewRecord): ?>
                <?= $form->field($model, 'id_alternatif')->dropDownList($alternatif, ['prompt' => '--PILIH-']) ?>
            <?php else: ?>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <?= Html::textInput('nama_alternatif', Helpers::getNamaAlternatifByIdAlternatif($model->id_alternatif), ['class' => 'form-control', 'disabled' => true]) ?>
                    </div>
                </div>
            <?php endif; ?>
            <?php foreach ($kriteria as $key => $kri): ?>
                <div class="form-group">
                    <label class="control-label col-sm-3"><?= $kri->nama_kriteria; ?></label>
                    <div class="col-sm-6">
                        <?php if (!empty(Helpers::getCrips($kri->id))): ?>
                            <?= Html::dropDownList(
                                'Penilaian[penilaian][' . $kri->id . ']',
                                isset($nilai[$kri->id]) ? $nilai[$kri->id] : '',
                                Helpers::getCrips($kri->id),
                                [
                                    'prompt' => '--PILIH--',
                                    'type' => 'number',
                                    'class' => 'form-control',
                                ]
                            ); ?>
                        <?php else: ?>
                            <?= Html::textInput(
                                'Penilaian[penilaian][' . $kri->id . ']',
                                isset($nilai[$kri->id]) ? $nilai[$kri->id] : '',
                                [
                                    'type' => 'number',
                                    'class' => 'form-control',
                                ]
                            ); ?>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php elseif (empty($kriteria)): ?>
            <h4 style="color:red">Data Kriteria Untuk SPK <?= Helpers::getNamaSpkByIdSpk($model->isNewRecord ? $id : $model->id_spk) ?> Belum Ada</h4>
        <?php else: ?>
            <h4 style="color:red">Data Alternatif Untuk SPK <?= Helpers::getNamaSpkByIdSpk($id) ?> Tidak Ada Atau Sudah Digunakan Semua</h4>
        <?php endif; ?>

        <div class="form-group">
            <div class="col-sm-5 pull-right">
                <?= Html::a('Kembali', ($model->isNewRecord) ? ['index', 'id' => $id] : ['index', 'id' => $model->id_spk], ['class' => 'btn btn-danger']) ?>
                <?php if (($model->isNewRecord && $alternatif) || !$model->isNewRecord): ?>
                    <?= Html::submitButton(($model->isNewRecord) ? 'Tambah' : 'Update', ['class' => 'btn btn-success',]); ?>
                <?php else: ?>
                    <?= Html::a('Tambah Data Alternatif', ['alternatif/create', 'id' => $id], ['class' => 'btn btn-info']) ?>
                <?php endif; ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>