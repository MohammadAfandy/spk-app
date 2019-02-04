<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Spk */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="panel-body">
    <div class="spk-form">

        <?php
        $form = ActiveForm::begin([
                'options' => [
                    'enctype' => 'multipart/form-data',
                ],
                'layout' => 'horizontal',
            ]);
        ?>

        <?= $form->field($model, 'nama_spk')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>
        
        <div class="form-group">
            <div class="col-sm-offset-6 col-lg-1">
                <?= Html::a('Kembali', ['index'], ['class' => 'btn btn-danger']) ?>
            </div>
            <div class="col-lg-1">
                <?= Html::submitButton('Tambah', ['class' => 'btn btn-success']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
