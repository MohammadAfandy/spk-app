<div class="panel-body">
    <fieldset class="fieldset">
        <legend>Normalisasi</legend>
        <table class="table table-bordered">
            <thead>
                <th>No</th>
                <th>Nama Alternatif</th>
                <?php foreach ($kriteria as $kri): ?>
                    <th><?= $kri->nama_kriteria . '<br>('  . (($kri->type == 0) ? 'COST' : 'BENEFIT') . ' )' ?></th>
                <?php endforeach; ?>
            </thead>
            <tbody>
                <?php if (!empty($normalisasi) && is_array($normalisasi)): ?>
                    <?php $no = 1; ?>
                    <?php foreach($normalisasi as $key => $norm): ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= app\models\Penilaian::namaAlternatif($key) ?></td>
                            <?php foreach ($norm as $n): ?>
                                <td><?= round($n, 3) ?></td>
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
    </fieldset>
</div>