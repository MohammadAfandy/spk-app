<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PenilaianSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Penilaian';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penilaian-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Tambah Penilaian', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <table class="table table-hover table-bordered">
        <thead>
            <th>No</th>
            <th>Nama Alternatif</th>
            
            <?php foreach ($kriteria as $kri): ?>
                <th><?= $kri->nama_kriteria ?></th>
            <?php endforeach; ?>
            
            <th>Aksi</th>
        </thead>
        
        <?php if (!empty($penilaian) && is_array($penilaian)): ?>
            
            <?php foreach($penilaian as $key => $pen): ?>
                
                <tbody>
                    <tr>
                        <td><?= ($key + 1) ?></td>
                        <td><?= $pen->alternatif->nama_alternatif; ?></td>
                        
                        <?php foreach ($kriteria as $kri): ?>
                            <td><?= $nilai[$pen->id][$kri->id_kriteria]; ?></td>
                        <?php endforeach; ?>

                        <td>
                            <?= Html::a('Update',
                                Helper::checkRoute('admin-role') ? ['update', 'id' => $pen->id] : '#',
                                [
                                    'class' => 'btn btn-primary btn-xs',
                                    'disabled' => Helper::checkRoute('admin-role') ? false : true,
                                ]
                            ); ?>
                            <?= Html::a('Delete',
                                Helper::checkRoute('admin-role') ? ['delete', 'id' => $pen->id] : '#',
                                [
                                    'class' => 'btn btn-danger btn-xs',
                                    'disabled' => Helper::checkRoute('admin-role') ? false : true,
                                    'data-confirm' => Helper::checkRoute('admin-role') ? 'Apakah Anda Yakin Ingin Menghapus Data ?' : false,
                                    'data-method' => Helper::checkRoute('admin-role') ? 'post' : false,
                                ]
                            ); ?>
                        </td>
                    </tr>
                </tbody>
            
            <?php endforeach; ?>
        
        <?php else: ?>
            
            <tbody>
                <tr>
                    <td colspan="<?= count($kriteria) + 3 ?>">Data Tidak Ditemukan</td>
                </tr>
            </tbody>
        
        <?php endif; ?>
    
    </table>
</div>
