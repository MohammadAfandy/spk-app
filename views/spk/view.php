<?php

use yii\helpers\Html;
use app\components\Helpers;

/* @var $this yii\web\View */
/* @var $model app\models\Spk */

$this->title = 'SPK - ' . Helpers::getNamaSpkByIdSpk($id);
$this->params['breadcrumbs'][] = ['label' => 'SPK', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box-header with-border">
    <h2 class="box-title"><?= Html::encode($this->title) ?></h2>
</div>
<div class="box-body">
    <div class="row">
        <div class="col-lg-6">
            <?php
            echo $this->render('_data_alternatif', [
                'id' => $id,
                'alternatif' => $alternatif,
            ]);
            ?>
        </div>
        <div class="col-lg-6">
            <?php
            echo $this->render('_data_kriteria', [
                'id' => $id,
                'kriteria' => $kriteria,
                'arr_bobot' => $arr_bobot,
            ]);
            ?>
        </div>
    </div>
    <br>
    <div class="row text-right">
        <div class="col-lg-6">
            <?= \yii\Helpers\Html::a('Data Alternatif', Yii::$app->urlManager->createUrl(['alternatif/index/', 'id' => $id]), ['class' => 'btn btn-info']) ?>
        </div>
        <div class="col-lg-6">
            <?= \yii\Helpers\Html::a('Data Kriteria', Yii::$app->urlManager->createUrl(['kriteria/index/', 'id' => $id]), ['class' => 'btn btn-info']) ?>
        </div>
    </div>
</div>
