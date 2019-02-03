<?php

use yii\web\View;
use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Kriteria;
use yii\bootstrap\Modal;
use mdm\admin\components\Helper;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel app\models\KriteriaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>

<div class="kriteria-crips" style="margin: 50px;">

    <h1><?= 'Data Crips - ' . $model->nama_kriteria?></h1>
    <div class="panel-body">
        <?php
        $form = ActiveForm::begin([
            'action' => ['crips', 'id' => $id],
            'options' => [
                'enctype' => 'multipart/form-data',
            ],
            'layout' => 'horizontal',
        ]);
        ?>

        <?= $form->field($model, 'nama_kriteria')->textInput(['disabled' => true]) ?>
        <div class="form-group">
            <div class="col-sm-offset-9">
                <button type="button" id="btn_tambah_crips"><span class="glyphicon glyphicon-plus"></span></button>
            </div>
        </div>
        <div id="form-crips">
            <?php $id_crips = 1 ?>
            <?php if (!empty($model->crips)): ?>
                <?php foreach (json_decode($model->crips, true) as $nama_cr => $nilai_cr): ?>
                    <div class="form-group input-crips" id="crips_<?= $id_crips ?>">
                        <div class="col-sm-offset-3 col-sm-4">
                            <?= Html::textInput('Crips[' . $id_crips .  '][nama_crips]', $nama_cr, [
                                'class' => 'form-control',
                                'placeholder' => 'Nama Crips',
                                'required' => true,
                            ]) ?>
                        </div>
                        <div class="col-sm-2">
                            <?= Html::textInput('Crips[' . $id_crips .  '][nilai_crips]', $nilai_cr, [
                                'class' => 'form-control',
                                'placeholder' => 'Nilai (0-100)',
                                'max' => '100',
                                'min' => '0',
                                'type' => 'number',
                                'required' => true,
                            ]) ?>
                        </div>
                        <div class="col-sm-1">
                            <button type="button" class="btn-hapus-crips" data-id="<?= $id_crips ?>"><span class="glyphicon glyphicon-minus"></span></button>
                        </div>
                    </div>
                    <?php $id_crips++; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
<?php
$this->registerJs(
    '
    
    $(function() {
        let id_crips = ' . $id_crips .  ';

        $("#btn_tambah_crips").on("click", function() {
            $("#form-crips").append(`
                <div class="form-group input-crips" id="crips_` + id_crips + `">
                    <div class="col-sm-offset-3 col-sm-4">
                        ' . Html::textInput("Crips[` + id_crips + `][nama_crips]", "", [
                            "class" => "form-control",
                            "placeholder" => "Nama Crips",
                            "required" => true,
                            ]) . '
                    </div>
                    <div class="col-sm-2">
                        ' . Html::textInput("Crips[` + id_crips + `][nilai_crips]", "", [
                            "class" => "form-control",
                            "placeholder" => "Nilai (0-100)",
                            "max" => "100",
                            "min" => "0",
                            "type" => "number",
                            "required" => true,
                            ]) . '
                    </div>
                    <div class="col-sm-1">
                        <button type="button" class="btn-hapus-crips" data-id=` + id_crips + `><span class="glyphicon glyphicon-minus"></span></button>
                    </div>
                </div>
            `);
            id_crips++;

            if ($(".input-crips").length >= 10) {
                $(this).attr("disabled", true);
            }

        });
    });

    $(document).on("click", ".btn-hapus-crips", function() {
        $("#crips_" + $(this).data("id")).remove();

        if ($(".input-crips").length <= 10) {
            $("#btn_tambah_crips").removeAttr("disabled");
        }
    });

    ',
    View::POS_READY,
    'kriteria-crips-js'
);
?>