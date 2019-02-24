<?php

use yii\web\View;
use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Kriteria;
use yii\bootstrap\Modal;
use mdm\admin\components\Helper;
use yii\helpers\Url;
use app\components\Helpers;
/* @var $this yii\web\View */
/* @var $searchModel app\models\KriteriaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = ($id) ? 'Kriteria' . ' - ' . $data_spk[$id]->nama_spk : 'Kriteria';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box-header with-border">
    <h2 class="box-title"><?= Html::encode($this->title) ?></h2>
</div>
<div class="box-body" style="margin-top: 30px;">

    <div class="row">
        <div class="col-lg-2">
            <label>PILIH NAMA SPK</label>
        </div>
        <div class="col-lg-4">
            <?= Html::dropDownList('spk', $id, \yii\helpers\ArrayHelper::map($data_spk, 'id', 'nama_spk'), ['prompt' => '--PILIH--', 'class' => 'form-control', 'id' => 'pilih_spk']) ?>
        </div>
    </div>

    <?php if ($id): ?>
        <?php
            Modal::begin(['id' =>'modal', 'size' => 'modal-md',]);
            Modal::end();
        ?>

        <p>
            <?= Html::a('Tambah Kriteria', ['create', 'id' => $id], ['class' => 'btn btn-success show-modal']) ?>
        </p>

        <form method="POST" action="<?= Yii::$app->urlManager->createUrl(['kriteria/set-kriteria']) ?>">
            <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
            <?= Html::hiddenInput('jenis_bobot', Helpers::getJenisBobot($id), ['id' => 'jenis_bobot']) ?>
            <div style="color: red; min-height: 20px;">
                <strong><span id="error_bobot"></span></strong>
            </div>
            <?php
            $tabindex = 1;
            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'layout' => '{items}',
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'header' => 'Nama Kriteria' . '<span class="pull-right">' .
                        '<i class="fa fa-edit fa-lg" id="btn_edit_all_nama" title="Edit All Nama"></i>' . ' ' .
                        '<i class="fa fa-close fa-lg" id="btn_cancel_all_nama" title="Cancel All Nama"></i>'
                            // Html::button('Edit All', [
                            //     'class' => 'fa fa-edit btn-xs',
                            //     'id' => 'btn_edit_all_nama',
                            // ]) . ' ' .
                            // Html::button('Cancel All', [
                            //     'class' => 'btn btn-danger btn-xs',
                            //     'id' => 'btn_cancel_all_nama',
                            // ])
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
                            $edit = '<i class="fa fa-edit btn_edit_nama" data-id="' .$model->id. '" title="Edit Nama"></i>';
                            $cancel = '<i class="fa fa-close btn_cancel_nama" data-id="' .$model->id. '" title="Cancel Nama"></i>';
                            // $edit = Html::button('Edit', [
                            //     'class' => 'btn btn-success btn-xs btn_edit_nama',
                            //     'data-id' => $model->id,
                            // ]);
                            // $cancel = Html::button('X', [
                            //     'class' => 'btn btn-danger btn-xs btn_cancel_nama',
                            //     'data-id' => $model->id,
                            // ]);
                            $tabindex++;
                            return $nama . '<span class="pull-right">' . $edit . ' '. $cancel;
                        },
                        'format' => 'raw',
                    ],
                    [
                        'header' => 'Type Kriteria' . '<span class="pull-right">' . 
                        '<i class="fa fa-edit fa-lg" id="btn_edit_all_type" title="Edit All Type"></i>' . ' ' .
                        '<i class="fa fa-close fa-lg" id="btn_cancel_all_type" title="Cancel All Type"></i>'
                            // Html::button('Edit All', [
                            //     'class' => 'btn btn-success btn-xs',
                            //     'id' => 'btn_edit_all_type',
                            // ]) . ' ' .
                            // Html::button('Cancel All', [
                            //     'class' => 'btn btn-danger btn-xs',
                            //     'id' => 'btn_cancel_all_type',
                            // ])
                        ,
                        'attribute' => 'type',
                        'value' => function($model) use (&$tabindex) {
                            $type = Html::dropDownList('Kriteria[' .$model->id. '][type]',
                                $model->type,
                                [
                                    Kriteria::COST => Helpers::getTypeKriteria(Kriteria::COST),
                                    Kriteria::BENEFIT => Helpers::getTypeKriteria(Kriteria::BENEFIT),
                                ],
                                [
                                    'class' => 'type_kriteria',
                                    'disabled' => 'disabled',
                                    'tabindex' => $tabindex,
                                    'data-id' => $model->id,
                                    'data-oldval' => $model->type,
                                ]
                            );
                            $edit = '<i class="fa fa-edit btn_edit_type" data-id="' .$model->id. '" title="Edit Type"></i>';
                            $cancel = '<i class="fa fa-close btn_cancel_type" data-id="' .$model->id. '" title="Cancel Type"></i>';
                            // $edit = Html::button('Edit', [
                            //     'class' => 'btn btn-success btn-xs btn_edit_type',
                            //     'data-id' => $model->id,
                            // ]);
                            // $cancel = Html::button('X', [
                            //     'class' => 'btn btn-danger btn-xs btn_cancel_type',
                            //     'data-id' => $model->id,
                            // ]);
                            $tabindex++;
                            return $type . '<span class="pull-right">' . $edit . ' '. $cancel;
                        },
                        'format' => 'raw',
                    ],
                    [
                        'header' => '<span>Bobot (' . (Helpers::getJenisBobot($id) === 0 ? 'Preferensi' : 'Persen') . ')</span>' . '<span class="pull-right">' . 
                        '<i class="fa fa-edit fa-lg" id="btn_edit_all_bobot" title="Edit All Bobot"></i>' . ' ' .
                        '<i class="fa fa-close fa-lg" id="btn_cancel_all_bobot" title="Cancel All Bobot"></i>'
                            // Html::button('Edit All', [
                            //     'class' => 'btn btn-success btn-xs',
                            //     'id' => 'btn_edit_all_bobot',
                            // ]) . ' ' .
                            // Html::button('Cancel All', [
                            //     'class' => 'btn btn-danger btn-xs',
                            //     'id' => 'btn_cancel_all_bobot',
                            // ])
                        ,
                        'attribute' => 'bobot',
                        'value' => function($model) use ($id, &$tabindex) {
                            $bobot = Html::textInput(
                                'Kriteria[' .$model->id. '][bobot]',
                                Helpers::getJenisBobot($id) === \app\models\Spk::BOBOT_PERSEN
                                ? $model->bobot * 100
                                : $model->bobot,
                                [
                                    'type' => 'number',
                                    'class' => 'bobot_kriteria',
                                    'disabled' => 'disabled',
                                    'tabindex' => $tabindex,
                                    'data-id' => $model->id,
                                    'data-oldval' => $model->bobot * 100,
                                ]
                            );
                            $edit = '<i class="fa fa-edit btn_edit_bobot" data-id="' .$model->id. '" title="Edit Bobot"></i>';
                            $cancel = '<i class="fa fa-close btn_cancel_bobot" data-id="' .$model->id. '" title="Cancel Bobot"></i>';
                            // $edit = Html::button('Edit', [
                            //     'class' => 'fa fa-edit btn_edit_bobot',
                            //     'data-id' => $model->id,
                            // ]);
                            // $cancel = Html::button('X', [
                            //     'class' => 'btn btn-danger btn-xs btn_cancel_bobot',
                            //     'data-id' => $model->id,
                            // ]);
                            $tabindex++;
                            return $bobot . '<span class="pull-right">' . $edit . ' '. $cancel;
                        },
                        'format' => 'raw',
                    ],
        
                    [
                        'class' => 'app\components\ActionColumn',
                        'header' => 'Aksi',
                        'template' => Helper::filterActionColumn('{crips} {delete}'),
                        'buttons' => [
                            'crips' => function ($url, $model, $key) {
                                return Html::a('Crips', $url, ['class' => 'btn btn-xs btn-primary show-modal']);
                            },
                            'delete' => function ($url, $model, $key) {
                                return Html::a('Delete', $url, [
                                    'class' => 'btn btn-xs btn-danger',
                                    'data-method' => 'post',
                                    'data-confirm' => 'Apakah Anda Yakin Ingin Menghapus Data ?',
                                ]);
                            },
                        ],
                    ],
                ],
            ]);
            ?>
    
            <?= Html::submitButton('Set Kriteria', ['class' => 'btn btn-primary', 'id' => 'btn_set']); ?>
            <?= Html::a('Reset Bobot', ['reset-bobot', 'id' => $id], ['class' => 'btn btn-danger', 'id' => 'btn_reset']); ?>
        </form>
    <?php endif; ?>
</div>

<?php
$this->registerJs(
    '
    $("#pilih_spk").on("change", function() {
        showLoading();
        window.location.href = "' .Url::to(['index']). '/" + this.value;
    });

    // if ($("#jenis_bobot").val() == "1") {
    //     $(".pilih-bobot").find(".text-bobot").text("Bobot Persen")
    //     $(".pilih-bobot").attr("title", "Ganti ke Bobot Preferensi");
    // }

    // $(".pilih-bobot").on("click", function() {
    //     if ($(this).find(".text-bobot").text() == "Bobot Preferensi") {
    //         $(this).find(".text-bobot").text("Bobot Persen");
    //         $(this).attr("title", "Ganti ke Bobot Preferensi");

    //         $("#jenis_bobot").val("1");
    //     } else {
    //         $(this).find(".text-bobot").text("Bobot Preferensi");
    //         $(this).attr("title", "Ganti ke Bobot Persen");

    //         $("#jenis_bobot").val("0");
    //     }
    // });

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
        if (this.value === "") {
            this.value = 0;
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

    $(document).on("click", ".show-modal", function(e) {
        e.preventDefault();
        $("#modal").modal("show").find(".modal-content").attr("data-href", $(this).attr("href")).load($(this).attr("href"));
    });

    $("#modal").on("hidden.bs.modal", function () {
        $(this).find(".modal-content").empty();
    });

    $("#btn_set").on("click", function() {
        let total = 0;
        let cek_nama = cek_type = cek_bobot = true;

        $(".nama_kriteria").each(function() {
            if (!$(this).is(":disabled")) {
                cek_nama = false;
            }
        });

        $(".type_kriteria").each(function() {
            if (!$(this).is(":disabled")) {
                cek_type = false;
            }
        });

        $(".bobot_kriteria").each(function() {
            if (!$(this).is(":disabled")) {
                cek_bobot = false;
            }
            total += parseInt(this.value);
        });

        if (cek_nama == true && cek_type == true && cek_bobot == true) {
            $("#error_bobot").html("Tidak Ada Data yang Diedit");
            return false;
        } else if ((cek_nama == false || cek_type == false) && cek_bobot == true) {
            return true;
        } else if ($("#jenis_bobot").val() === "0") {
            return true;
        } else {
            if (total == 100) {
                return true;
            } else {
                $("#error_bobot").html("Total Bobot Harus 100 %. Total Saat Ini " + total + " %");
                return false;   
            }
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
?>