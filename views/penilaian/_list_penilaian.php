<?php
use yii\helpers\Html;
use app\components\Helpers;
?>
<table class="table table-hover table-bordered dataTable">
    <thead>
        <th>#</th>
        <th>Nama Alternatif</th>

        <?php foreach ($kriteria as $kri): ?>
            <th><?= $kri->nama_kriteria ?></th>
        <?php endforeach; ?>

        <th>Aksi</th>
    </thead>
    <tbody>
        <?php if (!empty($penilaian) && is_array($penilaian)): ?>
        <?php $no = 1; ?>
        <?php foreach($penilaian as $key => $pen): ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $pen->alternatif->nama_alternatif; ?></td>
                <?php foreach ($kriteria as $kri): ?>
                    <td>
                        <?php
                        echo (isset($nilai[$pen->id][$kri->id])) 
                        ? Helpers::nilaiToCrips($nilai[$pen->id][$kri->id], $kri->id)
                        : '-';
                        ?>
                    </td>
                <?php endforeach; ?>
                <td>
                    <?= Html::a('', ['update', 'id' => $pen->id], [
                            'class' => 'fa fa-edit', 'title' => 'Edit'
                        ]
                    ); ?>
                    <?= Html::a('', ['delete', 'id' => $pen->id], [
                            'class' => 'fa fa-trash',
                            'title' => 'Delete',
                            'data-confirm' => 'Apakah Anda Yakin Ingin Menghapus Data ?',
                            'data-method' => 'post',
                        ]
                    ); ?>
                </td>
                <?php $no++; ?>
            </tr>
        <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="<?= count($kriteria) + 3 ?>">Data Tidak Ditemukan</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>