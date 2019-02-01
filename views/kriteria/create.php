<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Kriteria */

$this->title = 'Create Kriteria';
$this->params['breadcrumbs'][] = ['label' => 'Kriterias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kriteria-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
