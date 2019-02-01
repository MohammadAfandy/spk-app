<?php

use yii\helpers\Html;
use yii\grid\GridView;

use mdm\admin\components\UserStatus;
/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
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
            'created_date',
            'updated_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
