<?php
use app\components\Helpers;
?>

<table class="table table-striped table-bordered dataTable">
    <thead>
        <th>No</th>
        <th>Nama Alternatif</th>
        <th>Nilai</th>
    </thead>
    <tbody>
        <?php if (!empty($vektor_v) && is_array($vektor_v)): ?>
        <?php $no = 1; ?>
        <?php foreach($vektor_v as $key => $vv): ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= Helpers::getNamaAlternatifByIdPenilaian($key) ?></td>
                <td><?= round($vv, 3) ?></td>
                <?php $no++; ?>
            </tr>
        <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="3">Data Tidak Ditemukan</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>