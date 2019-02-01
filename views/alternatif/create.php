<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Alternatif */

$this->title = 'Create Alternatif';
$this->params['breadcrumbs'][] = ['label' => 'Alternatifs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alternatif-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'list_spk' => $list_spk,
    ]) ?>

</div>
