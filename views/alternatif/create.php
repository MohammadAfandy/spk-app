<?php

use yii\helpers\Html;
use app\components\Helpers;

/* @var $this yii\web\View */
/* @var $model app\models\Alternatif */

$this->title = 'Tambah Alternatif - ' . Helpers::getNamaSpkByIdSpk($id);
$this->params['breadcrumbs'][] = ['label' => 'Alternatif', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box-header with-border">
    <h2 class="box-title"><?= Html::encode($this->title) ?></h2>
</div>
<div class="box-body">

    <?= $this->render('_form', [
        'model' => $model,
        'id' => $id,
    ]) ?>

</div>
