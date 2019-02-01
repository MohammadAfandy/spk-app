<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Alternatif */

$this->title = 'Update Alternatif: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Alternatifs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="alternatif-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'list_spk' => $list_spk,
    ]) ?>

</div>
