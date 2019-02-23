<?php 
// header("Content-type:application/pdf");
use app\components\Helpers;
?>
<h3 class="title">
    SISTEM PENDUKUNG KEPUTUSAN <?= strtoupper(Helpers::getNamaSpkByIdSpk($spk)) ?><br>
    METODE <?= strtoupper($metode) ?>
</h3>

<fieldset class="fieldset">
    <legend>Hasil</legend>
    <p>Berdasarkan Sistem Pendukung Keputusan <strong><?= ucwords(Helpers::getNamaSpkByIdSpk($spk)) ?></strong> menggunakan <strong>Metode <?= strtoupper($metode) ?></strong>, maka diperoleh hasil bahwa <strong>Alternatif Terbaik</strong> adalah <strong><?= count($alt_terbaik) > 1 ? implode(' dan ', $alt_terbaik) : $alt_terbaik[0]; ?></strong></p>
</fieldset>

<fieldset class="fieldset">
    <legend>Penilaian</legend>
    <table class="table-pdf">
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
</fieldset>

<?php if ($metode === 'saw'): ?>

    <fieldset class="fieldset">
        <legend>Normalisasi</legend>
        <table class="table-pdf">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Alternatif</th>
                    <?php foreach ($kriteria as $kri): ?>
                        <th><?= $kri->nama_kriteria . '<br>('  . (($kri->type == 0) ? 'COST' : 'BENEFIT') . ' )' ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($normalisasi) && is_array($normalisasi)): ?>
                <?php $no = 1; ?>
                <?php foreach($normalisasi as $key => $norm): ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td><?= Helpers::getNamaAlternatifByIdPenilaian($key) ?></td>
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

    <fieldset class="fieldset">
        <legend>Rank</legend>
        <table class="table-pdf">
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
    </fieldset>

<?php else: ?>

    <fieldset class="fieldset">
        <legend>Vektor S</legend>
        <table class="table-pdf">
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
    </fieldset>

    <fieldset class="fieldset">
        <legend>Vektor V</legend>
        <table class="table-pdf">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Alternatif</th>
                    <th>Nilai</th>
                </tr>
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
    </fieldset>

<?php endif; ?>