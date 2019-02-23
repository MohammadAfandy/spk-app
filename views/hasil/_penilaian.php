<?php
use app\components\Helpers;
?>

<table class="table table-striped table-bordered dataTable table-pdf">
    <thead>
        <tr>
        <th>No</th>
        <th>Nama Alternatif</th>
            <?php foreach ($kriteria as $kri): ?>
                <th><?= $kri->nama_kriteria . '<br>('  . Helpers::getTypeKriteria($kri->type) . ')' ?></th>
            <?php endforeach; ?>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($nilai) && is_array($nilai)): ?>
        <?php $no = 1; ?>
        <?php foreach($nilai as $key => $nil): ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= Helpers::getNamaAlternatifByIdPenilaian($key) ?></td>
                <?php foreach ($nil as $k => $n): ?>
                    <td>
                        <?= Helpers::nilaiToCrips($n, $k) ?>
                    </td>
                <?php endforeach; ?>
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