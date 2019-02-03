<table class="table table-striped table-bordered">
    <thead>
        <th>No</th>
        <th>Nama Alternatif</th>
        <?php foreach ($kriteria as $kri): ?>
            <th><?= $kri->nama_kriteria . '<br>('  . (($kri->type == 0) ? 'COST' : 'BENEFIT') . ' )' ?></th>
        <?php endforeach; ?>
    </thead>
    <tbody>
        <?php if (!empty($nilai) && is_array($nilai)): ?>
        <?php $no = 1; ?>
        <?php foreach($nilai as $key => $nil): ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= app\models\Penilaian::namaAlternatif($key) ?></td>
                <?php foreach ($nil as $k => $n): ?>
                    <td>
                        <?= app\models\Kriteria::nilaiToCrips($n, $k) ?>
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