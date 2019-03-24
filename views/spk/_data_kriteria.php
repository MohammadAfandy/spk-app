<?php
use app\components\Helpers;

$jenis_bobot = Helpers::getJenisBobotByIdSpk(!empty($id) ? $id : $spk);
?>
<fieldset class="fieldset">
    <legend>Kriteria</legend>
    <table class="table table-striped table-bordered table-pdf">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kriteria</th>
                <th>Tipe</th>
                <th><?= $jenis_bobot == '0' ? 'Bobot Preferensi' : 'Bobot Persen' ?></th>
                <?= $jenis_bobot == '0' ? '<th>Perbaikan Bobot</th>' : '' ?>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($kriteria) && is_array($kriteria)): ?>
            <?php $no = 1; ?>
            <?php foreach($kriteria as $key => $kri): ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $kri['nama_kriteria'] ?></td>
                    <td><?= Helpers::getTypeKriteria($kri['type']) ?></td>
                    <td><?= $jenis_bobot == '0' ? $kri['bobot'] : $kri['bobot'] * 100 . ' %' ?></td>
                    <?= $jenis_bobot == '0' ? '<td>' . round($arr_bobot[$key], 3) . '</td>' : '' ?>
                </tr>
            <?php $no++; ?>
            <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">Data Tidak Ditemukan</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</fieldset>