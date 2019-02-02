<div class="panel-body">
    <fieldset class="fieldset">
        <legend>Penilaian</legend>
        <table class="table table-bordered">
            <thead>
                <th>No</th>
                <th>Nama Alternatif</th>
                <?php foreach ($kriteria as $kri): ?>
                    <th><?= $kri->nama_kriteria ?></th>
                <?php endforeach; ?>
            </thead>
            <tbody>
                <?php if (!empty($nilai) && is_array($nilai)): ?>
                    <?php $no = 1; ?>
                    <?php foreach($nilai as $key => $nil): ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= app\models\Penilaian::namaAlternatif($key) ?></td>
                            <?php foreach ($nil as $n): ?>
                                <td><?= $n ?></td>
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