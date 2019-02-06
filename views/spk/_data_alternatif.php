<fieldset class="fieldset">
    <legend>Alternatif</legend>
    <table class="table table-striped table-bordered">
        <thead>
            <th>No</th>
            <th>Nama Alternatif</th>
            <th>Keterangan</th>
        </thead>
        <tbody>
            <?php if (!empty($alternatif) && is_array($alternatif)): ?>
            <?php foreach($alternatif as $key => $alt): ?>
                <tr>
                    <td><?= $key + 1 ?></td>
                    <td><?= $alt['nama_alternatif'] ?></td>
                    <td><?= $alt['keterangan'] ?></td>
                </tr>
            <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">Data Tidak Ditemukan</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</fieldset>