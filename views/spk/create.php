<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Spk */

$this->title = 'Create Spk';
$this->params['breadcrumbs'][] = ['label' => 'Spks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="spk-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
