<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Penilaian */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="panel-body">
    <div class="penilaian-form">

        <?php
        $form = ActiveForm::begin([
            'options' => [
                'enctype' => 'multipart/form-data',
            ],
            'layout' => 'horizontal',
        ]);
        ?>

        <?php if ($model->isNewRecord): ?>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <?= Html::textInput('nama_spk', \app\models\Spk::namaSpk($id), ['disabled' => true, 'class' => 'form-control']) ?>
                </div>
            </div>
                <?php if ($alternatif): ?>
                    <?= $form->field($model, 'id_alternatif')->dropDownList($alternatif, ['prompt' => '--PILIH-']) ?>
                <?php else: ?>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">
                            Tidak Bisa Menambah Data. Data Alternatif Untuk SPK ini Sudah Digunakan Semua
                        </div>
                    </div>
                <?php endif; ?>
        <?php else: ?>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <?= Html::textInput('nama_spk', \app\models\Spk::namaSpk($model->id_spk), ['disabled' => true, 'class' => 'form-control']) ?>
                </div>
            </div>
            <?php // echo $form->field(s$model, 'id_alternatif')->textInput(['disabled' => true]) ?>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <?= Html::textInput('nama_alternatif', \app\models\Penilaian::namaAlternatif($model->id), ['disabled' => true, 'class' => 'form-control']) ?>
                </div>
            </div>
        <?php endif; ?>

        <?php foreach ($kriteria as $key => $kri): ?>
            <div class="form-group">
                <label class="control-label col-sm-3"><?= $kri->nama_kriteria; ?></label>
                <div class="col-sm-6">
                    <?php if (!empty(app\models\Kriteria::getCrips($kri->id))): ?>
                        <?= Html::dropDownList(
                            'Penilaian[penilaian][' . $kri->id . ']',
                            isset($nilai[$kri->id]) ? $nilai[$kri->id] : '',
                            app\models\Kriteria::getCrips($kri->id),
                            [
                                'type' => 'number',
                                'class' => 'form-control',
                                'disabled' => $alternatif || !$model->isNewRecord ? false : true,
                            ]
                        ); ?>
                    <?php else: ?>
                        <?= Html::textInput(
                            'Penilaian[penilaian][' . $kri->id . ']',
                            isset($nilai[$kri->id]) ? $nilai[$kri->id] : '',
                            [
                                'type' => 'number',
                                'class' => 'form-control',
                                'disabled' => $alternatif || !$model->isNewRecord ? false : true,
                            ]
                        ); ?>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>