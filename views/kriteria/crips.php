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

$this->title = 'Tambah Crips' . ' - ' . $model->nama_kriteria;
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="kriteria-crips">

    <h1><?= Html::encode($this->title) ?></h1>
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
    let id = 1;

    $("#btn_tambah_crips").on("click", function() {
        $("#form-crips").append(`
            <div class="form-group" id="crips_` + id + `">
                <div class="col-sm-offset-3 col-sm-4">
                    ' . Html::textInput("Kriteria[crips][` + id + `][nama_crips]", "", [
                        "class" => "form-control",
                        "placeholder" => "Nama Crips",
                        ]) . '
                </div>
                <div class="col-sm-2">
                    ' . Html::textInput("Kriteria[crips][` + id + `][nilai_crips]", "", [
                        "class" => "form-control",
                        "placeholder" => "Nilai (0-100)",
                        "max" => "100",
                        "min" => "0",
                        "type" => "number",
                        ]) . '
                </div>
                <div class="col-sm-1">
                    <button type="button" class="btn-hapus-crips" data-id=` + id + `><span class="glyphicon glyphicon-minus"></span></button>
                </div>
            </div>
        `);
        id++;
    });

    $(document).on("click", ".btn-hapus-crips", function() {
        $("#crips_" + $(this).data("id")).remove();
    });

    ',
    View::POS_READY,
    'kriteria-crips-js'
);
?>