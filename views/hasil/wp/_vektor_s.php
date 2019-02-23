<?php
use app\components\Helpers;
?>

<table class="table table-striped table-bordered dataTable table-pdf">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Alternatif</th>
            <th>Nilai</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($vektor_s) && is_array($vektor_s)): ?>
        <?php $no = 1; ?>
        <?php foreach($vektor_s as $key => $vs): ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= Helpers::getNamaAlternatifByIdPenilaian($key) ?></td>
                <td><?= round($vs, 3) ?></td>
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