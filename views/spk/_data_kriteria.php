<?php
use app\components\Helpers;
?>
<fieldset class="fieldset">
    <legend>Kriteria</legend>
    <table class="table table-striped table-bordered table-pdf">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kriteria</th>
                <th>Tipe</th>
                <th>Bobot</th>
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
                    <td><?= $kri['bobot'] * 100 . ' %' ?></td>
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