<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $model app\models\Kriteria */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="panel-body">
    <div class="kriteria-form">
        <h3><?= 'Tambah Kriteria - SPK ' . \app\models\Spk::namaSpk($id) ?></h3>
        <?php
        $form = ActiveForm::begin([
            'action' => ['create', 'id' => $id],
        ]);
        ?>
    
        <?= $form->field($model, 'nama_kriteria')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'type')->dropDownList(
            [
                app\models\Kriteria::COST => 'COST',
                app\models\Kriteria::BENEFIT => 'BENEFIT',
            ],
            ['prompt' => '--PILIH-',]
        ) ?>

        <div class="form-group pull-right">
            <?= Html::submitButton('Tambah', ['class' => 'btn btn-success']) ?>
        </div>
    
        <?php ActiveForm::end(); ?>

    </div>
</div>
