<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AlternatifSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Alternatif';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alternatif-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Tambah Alternatif', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nama_alternatif',
            'keterangan:ntext',
            'id_spk',
            'created_date',
            //'updated_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
