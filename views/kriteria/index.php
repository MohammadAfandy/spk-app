<?php

use yii\web\View;
use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Kriteria;
use yii\bootstrap\Modal;
use mdm\admin\components\Helper;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\models\KriteriaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = ($id) ? 'Kriteria' . ' - ' . $data_spk[$id]->nama_spk : 'Kriteria';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kriteria-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::dropDownList('spk', $id, \yii\helpers\ArrayHelper::map($data_spk, 'id', 'nama_spk'), ['prompt' => '--PILIH--', 'class' => 'form-control', 'id' => 'pilih_spk']) ?>
    </p>

    <p>
        <?php
        Modal::begin([
            'header' => '<h2>Tambah Kriteria</h2>',
            'id' => 'modal_tambah',
            'size' => 'modal-lg',
            'toggleButton' => [
                'label' => 'Tambah Kriteria',
                'class' => 'btn btn-success',
                'disabled' => Helper::checkRoute('admin-role') ? false : true,
            ],
        ]);

        echo $this->render('_form', [
            'model' => $model,
            'data_spk' => $data_spk,
        ]);

        Modal::end();
        ?>
    </p>

    <form method="POST" action="<?= Yii::$app->urlManager->createUrl(['kriteria/set-kriteria']) ?>">
        <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
        <div style="color: red; min-height: 20px;">
            <strong><span id="error_bobot"></span></strong>
        </div>
        <?php
        $tabindex = 1;
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            // 'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
    
                [
                    'header' => 'Nama Kriteria' . '<span class="pull-right">' . 
                        Html::button('Edit All', [
                            'class' => 'btn btn-success btn-xs',
                            'id' => 'btn_edit_all_nama',
                        ]) . ' ' .
                        Html::button('Cancel All', [
                            'class' => 'btn btn-danger btn-xs',
                            'id' => 'btn_cancel_all_nama',
                        ])
                    ,
                    'attribute' => 'nama_kriteria',
                    'value' => function($model) use (&$tabindex) {
                        $id_spk = $model->id;
                        $nama = Html::textInput('Kriteria[' .$model->id. '][nama_kriteria]', ucwords($model->nama_kriteria), [
                            'class' => 'nama_kriteria',
                            'disabled' => 'disabled',
                            'tabindex' => $tabindex,
                            'data-id' => $model->id,
                            'data-oldval' => $model->nama_kriteria,
                        ]);
                        $edit = Html::button('Edit', [
                            'class' => 'btn btn-success btn-xs btn_edit_nama',
                            'data-id' => $model->id,
                        ]);
                        $cancel = Html::button('X', [
                            'class' => 'btn btn-danger btn-xs btn_cancel_nama',
                            'data-id' => $model->id,
                        ]);
                        $tabindex++;
                        return $nama . '<span class="pull-right">' . $edit . ' '. $cancel;
                    },
                    'format' => 'raw',
                ],
                [
                    'header' => 'Type Kriteria' . '<span class="pull-right">' . 
                        Html::button('Edit All', [
                            'class' => 'btn btn-success btn-xs',
                            'id' => 'btn_edit_all_type',
                        ]) . ' ' .
                        Html::button('Cancel All', [
                            'class' => 'btn btn-danger btn-xs',
                            'id' => 'btn_cancel_all_type',
                        ])
                    ,
                    'attribute' => 'type',
                    'value' => function($model) use (&$tabindex) {
                        $type = Html::dropDownList('Kriteria[' .$model->id. '][type]',
                            $model->type,
                            [
                                Kriteria::COST => 'COST',
                                Kriteria::BENEFIT => 'BENEFIT',
                            ],
                            [
                                'class' => 'type_kriteria',
                                'disabled' => 'disabled',
                                'tabindex' => $tabindex,
                                'data-id' => $model->id,
                                'data-oldval' => $model->type,
                            ]
                        );
                        $edit = Html::button('Edit', [
                            'class' => 'btn btn-success btn-xs btn_edit_type',
                            'data-id' => $model->id,
                        ]);
                        $cancel = Html::button('X', [
                            'class' => 'btn btn-danger btn-xs btn_cancel_type',
                            'data-id' => $model->id,
                        ]);
                        $tabindex++;
                        return $type . '<span class="pull-right">' . $edit . ' '. $cancel;
                    },
                    'format' => 'raw',
                    // 'value' => function($model) {
                    //     return $model->type = Kriteria::COST ? 'COST' : 'BENEFIT';
                    // },
                ],
                [
                    'header' => 'Bobot' . '<span class="pull-right">' . 
                        Html::button('Edit All', [
                            'class' => 'btn btn-success btn-xs',
                            'id' => 'btn_edit_all_bobot',
                        ]) . ' ' .
                        Html::button('Cancel All', [
                            'class' => 'btn btn-danger btn-xs',
                            'id' => 'btn_cancel_all_bobot',
                        ])
                    ,
                    'attribute' => 'bobot',
                    'value' => function($model) use (&$tabindex) {
                        $bobot = Html::textInput('Kriteria[' .$model->id. '][bobot]', $model->bobot * 100, [
                            'type' => 'number',
                            'class' => 'bobot_kriteria',
                            'disabled' => 'disabled',
                            'tabindex' => $tabindex,
                            'data-id' => $model->id,
                            'data-oldval' => $model->bobot * 100,
                        ]);
                        $edit = Html::button('Edit', [
                            'class' => 'btn btn-success btn-xs btn_edit_bobot',
                            'data-id' => $model->id,
                        ]);
                        $cancel = Html::button('X', [
                            'class' => 'btn btn-danger btn-xs btn_cancel_bobot',
                            'data-id' => $model->id,
                        ]);
                        $tabindex++;
                        return $bobot . ' %<span class="pull-right">' . $edit . ' '. $cancel;
                    },
                    'format' => 'raw',
                ],
    
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => 'Aksi',
                    'template' => Helper::filterActionColumn('{delete}'),
                ],
            ],
        ]);
        ?>

        <?= Html::submitButton('Set Kriteria', ['class' => 'btn btn-primary', 'id' => 'btn_set']); ?>
        <?= Html::a('Reset Bobot', ['reset-bobot', 'id' => $id], ['class' => 'btn btn-danger', 'id' => 'btn_reset']); ?>
    </form>
</div>

<?php
$this->registerJs(
    '
    $("#pilih_spk").on("change", function() {
        window.location.href = "' .Url::to(['index']). '/" + this.value;
    });
    
    $(document).on("click", ".btn_edit_nama", function() {
        let id = $(this).data("id");
        let input = $(".nama_kriteria[data-id="+id+"]");
        input.removeAttr("disabled").css("border-bottom", "2px solid #5cb85c").focus();
    });

    $(document).on("click", ".btn_cancel_nama", function() {
        let id = $(this).data("id");
        let input = $(".nama_kriteria[data-id="+id+"]");
        input.attr("disabled", true).css("border-bottom", "2px solid #C0C0C0").val(input.data("oldval"));
    });

    $(document).on("click", ".btn_edit_type", function() {
        let id = $(this).data("id");
        let input = $(".type_kriteria[data-id="+id+"]");
        input.removeAttr("disabled").css("border-bottom", "2px solid #5cb85c").focus();
    });

    $(document).on("click", ".btn_cancel_type", function() {
        let id = $(this).data("id");
        let input = $(".type_kriteria[data-id="+id+"]");
        input.attr("disabled", true).css("border-bottom", "2px solid #C0C0C0").val(input.data("oldval"));
    });

    $(document).on("click", ".btn_edit_bobot", function() {
        let id = $(this).data("id");
        let input = $(".bobot_kriteria[data-id="+id+"]");
        input.removeAttr("disabled").css("border-bottom", "2px solid #5cb85c").focus();
    });

    $(document).on("click", ".btn_cancel_bobot", function() {
        let id = $(this).data("id");
        let input = $(".bobot_kriteria[data-id="+id+"]");
        input.attr("disabled", true).css("border-bottom", "2px solid #C0C0C0").val(input.data("oldval"));
    });

    $("#btn_edit_all_nama").on("click", function() {
        $(".nama_kriteria").each(function() {
            $(this).removeAttr("disabled").css("border-bottom", "2px solid #5cb85c");
        });
    });

    $("#btn_cancel_all_nama").on("click", function() {
        $(".nama_kriteria").each(function() {
            $(this).attr("disabled", true).css("border-bottom", "2px solid #C0C0C0").val($(this).data("oldval"));
        });
    });

    $("#btn_edit_all_type").on("click", function() {
        $(".type_kriteria").each(function() {
            $(this).removeAttr("disabled").css("border-bottom", "2px solid #5cb85c");
        });
    });

    $("#btn_cancel_all_type").on("click", function() {
        $(".type_kriteria").each(function() {
            $(this).attr("disabled", true).css("border-bottom", "2px solid #C0C0C0").val($(this).data("oldval"));
        });
    });

    $("#btn_edit_all_bobot").on("click", function() {
        $(".bobot_kriteria").each(function() {
            $(this).removeAttr("disabled").css("border-bottom", "2px solid #5cb85c");
        });
    });

    $("#btn_cancel_all_bobot").on("click", function() {
        $(".bobot_kriteria").each(function() {
            $(this).attr("disabled", true).css("border-bottom", "2px solid #C0C0C0").val($(this).data("oldval"));
        });
    });

    $(document).on("keyup", ".bobot_kriteria", function() {
        let new_value = $(this).val().replace(/\D/g, "");
        this.value = new_value;
        let input = parseInt($(this).val());
        let max = parseInt($(this).attr("data-max"));
        if (input > max) {
            this.value = max;
        }
        let total = 0;
        $(".bobot_kriteria").each(function() {
            total += parseInt(this.value);
        });
        if (total == 100) {
            $("#error_bobot").html("Total Bobot Sudah 100 %");
        } else {
            $("#error_bobot").empty();
        }
    });

    $(document).on("focus", ".bobot_kriteria", function() {
        let total = 0;
        $(".bobot_kriteria").each(function() {
            total += parseInt(this.value);
        });
        $(this).attr("data-max", (100 - total) + parseInt(this.value));
    });

    $("#btn_set").on("click", function() {
        let total = 0;
        $(".bobot_kriteria").each(function() {
            total += parseInt(this.value);
        });
        if (total == 100) {
            return true;
        } else {
            $("#error_bobot").html("Total Bobot Harus 100 %. Total Saat Ini " + total + " %");
            return false;
        }
    });

    $("#btn_reset").on("click", function() {
        if (!confirm("Apakah Anda Yakin Ingin Mereset Bobot ?")) {
            return false;
        }
    });

    $("#btn_cancel_tambah").on("click", function() {
        $("#modal_confirm_tambah").modal("hide");
    });

    $("#btn_ok_tambah").on("click", function() {
        $("#modal_confirm_tambah").modal("hide");
    });

    ',
    View::POS_READY,
    'kriteria-js'
);
