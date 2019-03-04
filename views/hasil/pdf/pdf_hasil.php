<?php 
use app\components\Helpers;
use yii\base\View;
?>
<h3 class="title">
    SISTEM PENDUKUNG KEPUTUSAN <br>
    <?= strtoupper(Helpers::getNamaSpkByIdSpk($spk)) ?><br>
    MENGGUNAKAN METODE <?= strtoupper($metode) ?>
</h3>

<?php 
echo View::render('/spk/_data_alternatif', [
    'alternatif' => $alternatif,
]);

echo View::render('/spk/_data_kriteria', [
    'spk' => $spk,
    'kriteria' => $kriteria,
]);
?>

<fieldset class="fieldset">
    <legend>Penilaian</legend>
    <?php
    echo View::render('/hasil/_penilaian', [
        'nilai' => $nilai,
        'kriteria' => $kriteria,
    ]);
    ?>
</fieldset>

<?php if ($metode === 'saw'): ?>

    <fieldset class="fieldset">
        <legend>Normalisasi</legend>
        <?php
        echo View::render('/hasil/saw/_normalisasi', [
            'normalisasi' => $normalisasi,
            'kriteria' => $kriteria,
        ]);
        ?>
    </fieldset>

    <fieldset class="fieldset">
        <legend>Rank</legend>
        <?php
        echo View::render('/hasil/saw/_rank', [
            'rank' => $rank,
        ]);
        ?>
    </fieldset>

<?php else: ?>

    <fieldset class="fieldset">
        <legend>Vektor S</legend>
        <?php
        echo View::render('/hasil/wp/_vektor_s', [
            'vektor_s' => $vektor_s,
        ]);
        ?>
    </fieldset>

    <fieldset class="fieldset">
        <legend>Vektor V</legend>
        <?php
        echo View::render('/hasil/wp/_vektor_v', [
            'vektor_v' => $vektor_v,
        ]);
        ?>
    </fieldset>

<?php endif; ?>

<fieldset class="fieldset">
    <legend>Hasil</legend>
    <p>
        Berdasarkan Sistem Pendukung Keputusan <strong><?= ucwords(Helpers::getNamaSpkByIdSpk($spk)) ?></strong> menggunakan <strong>Metode <?= strtoupper($metode) ?></strong>, maka diperoleh Alternatif Terbaik
    </p>
    <p class="terbaik"><strong>"<?= count($alt_terbaik) > 1 ? implode('" dan "', $alt_terbaik) : $alt_terbaik[0]; ?></strong>"</p>
</fieldset>