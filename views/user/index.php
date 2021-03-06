<?php

use yii\helpers\Html;
use yii\grid\GridView;

use mdm\admin\components\UserStatus;
use app\components\Helpers;
/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box-header with-border">
    <h2 class="box-title"><?= Html::encode($this->title) ?></h2>
</div>
<div class="box-body">
    <p>
        <?= Html::a('Tambah User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'email:email',
            [
                'attribute' => 'status',
                'filter' => [
                    UserStatus::ACTIVE => 'ACTIVE',
                    UserStatus::INACTIVE => 'NON ACTIVE',
                ],
                'value' => function($model) {
                    return $model->status === app\models\User::STATUS_ACTIVE ? 'ACTIVE' : 'NON ACTIVE';
                },
            ],
            [
                'attribute' => 'created_date',
                'value' => function($model) {
                    return Helpers::dateTimeIndonesia($model->created_date);
                },
            ],

            [
                'class' => 'app\components\ActionColumn',
                'template' => '{update} {delete}',
                'header' => 'aksi',
            ],
        ],
    ]); ?>
</div>
