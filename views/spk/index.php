<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\components\Helpers;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SpkSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sistem Pendukung Keputusan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box-header with-border">
    <h2 class="box-title"><?= Html::encode($this->title) ?></h2>
</div>
<div class="box-body">

    <p>
        <?= Html::a('Tambah SPK', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nama_spk',
            'keterangan:ntext',
            [
                'attribute' => 'jenis_bobot',
                'filter' => ['0' => 'Bobot Preferensi', '1' => 'Bobot Persen'],
                'value' => function($model) {
                    return ($model->jenis_bobot == '0') ? 'Bobot Preferensi' : 'Bobot Persen';
                }
            ],
            // [
            //     'attribute' => 'created_date',
            //     'value' => function($model) {
            //         return Helpers::dateTimeIndonesia($model->created_date);
            //     }
            // ],
            [
                'class' => 'app\components\ActionColumn',
                'header' => 'Aksi',
                // 'template' => '{update} {delete}',
            ],
        ],
    ]); ?>
</div>
