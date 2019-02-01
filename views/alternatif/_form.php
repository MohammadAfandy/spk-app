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
        
        <?= $form->field($model, 'id_spk')->dropDownList($list_spk, ['prompt' => '--PILIH-',]) ?>

        <?= $form->field($model, 'nama_alternatif')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
