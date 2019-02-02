<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Alternatif */

$this->title = 'Update Alternatif - ' . $model->nama_alternatif;
$this->params['breadcrumbs'][] = ['label' => 'Alternatif', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="alternatif-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
