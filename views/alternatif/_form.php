<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Alternatif */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="panel-body">
    <div class="alternatif-form">

        <?php
        $form = ActiveForm::begin([
                'options' => [
                    'enctype' => 'multipart/form-data',
                ],
                'layout' => 'horizontal',
            ]);
        ?>
        <div class="form-group">
            <?php if ($model->isNewRecord): ?>

                <div class="col-sm-offset-3 col-sm-6">
                    <?= Html::textInput('nama_spk', \app\models\Spk::namaSpk($id), ['disabled' => true, 'class' => 'form-control']) ?>
                </div>
            
            <?php else: ?>

                <div class="col-sm-offset-3 col-sm-6">
                    <?= Html::textInput('nama_spk', \app\models\Spk::namaSpk($model->id_spk), ['disabled' => true, 'class' => 'form-control']) ?>
                </div>

            <?php endif; ?>
        </div>

        <?= $form->field($model, 'nama_alternatif')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
