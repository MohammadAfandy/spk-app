<?php
use app\components\Helpers;
?>

<table class="table table-striped table-bordered dataTable table-pdf">
    <thead>
        <tr>
            <th>Peringkat</th>
            <th>Nama Alternatif</th>
            <th>Nilai</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($rank) && is_array($rank)): ?>
        <?php $no = 1; ?>
        <?php foreach($rank as $key => $r): ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= Helpers::getNamaAlternatifByIdPenilaian($key) ?></td>
                <td><?= round($r, 3) ?></td>
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