<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Spk */

$this->title = 'Update SPK: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'SPK', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="box-header with-border">
    <h2 class="box-title"><?= Html::encode($this->title) ?></h2>
</div>
<div class="box-body">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
