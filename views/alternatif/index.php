<?php

use yii\helpers\Html;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AlternatifSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Alternatif';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box-header with-border">
    <h2 class="box-title"><?= Html::encode($this->title) ?></h2>
</div>
<div class="box-body" style="margin-top: 30px;">
    <div class="row">
        <div class="col-lg-2">
            <label>Pilih SPK</label>
        </div>
        <div class="col-lg-4">
            <?= Html::dropDownList('spk', $id, \yii\helpers\ArrayHelper::map($data_spk, 'id', 'nama_spk'), ['prompt' => '--PILIH--', 'class' => 'form-control', 'id' => 'pilih_spk']) ?>
        </div>
    </div>

    <?php if ($id): ?>
        <p>
            <?= Html::a('Tambah Alternatif', ['create', 'id' => $id], ['class' => 'btn btn-success']) ?>
        </p>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        'nama_alternatif',
                        'keterangan:ntext',
                        'created_date',
                    //'updated_date',

                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>
    <?php endif; ?>
</div>

<?php
$this->registerJs(
    '

    $("#pilih_spk").on("change", function() {
        showLoading();
        window.location.href = "' . \yii\helpers\Url::to(['index']) . '/" + this.value;
    });

    ',
    \yii\web\View::POS_READY,
    'alternatif-js'
);
?>