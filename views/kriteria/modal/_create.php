<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use yii\bootstrap\Modal;
use app\models\Kriteria;
use app\components\Helpers;
/* @var $this yii\web\View */
/* @var $model app\models\Kriteria */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="box-header with-border">
    <h2 class="box-title"><?= 'Tambah Kriteria - SPK ' . Helpers::getNamaSpkByIdSpk($id) ?></h2>
</div>
<div class="box-body">
    <div style="margin: 10px; color: red;">
        <strong>Perhatian ! </strong>Menambah Data Kriteria Akan Mereset Seluruh Bobot Kriteria
    </div>
    <?php
    $form = ActiveForm::begin([
        'action' => ['create', 'id' => $id],
    ]);
    ?>
    
    <?= $form->field($model, 'nama_kriteria')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList(
        [
            Kriteria::COST => Helpers::getTypeKriteria(Kriteria::COST),
            Kriteria::BENEFIT => Helpers::getTypeKriteria(Kriteria::BENEFIT),
        ],
        ['prompt' => '--PILIH-',]
    ) ?>

    <div class="form-group">
        <div class="pull-right">
            <?= Html::submitButton('Tambah', ['class' => 'btn btn-success']) ?>
        </div>
    </div>
    
    <?php ActiveForm::end(); ?>
</div>
