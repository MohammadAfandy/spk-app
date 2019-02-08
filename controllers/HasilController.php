<?php

namespace app\controllers;

use Yii;
use app\models\Penilaian;
use app\models\PenilaianSearch;
use yii\web\Controller;

use yii\helpers\ArrayHelper;
use app\models\Spk;
use app\models\Kriteria;
use yii\web\NotFoundHttpException;

use app\components\Helpers;
/**
 * HasilController 
 */
class HasilController extends Controller
{

    /**
     * Lists all Hasil
     * @return mixed
     */
    public function actionIndex()
    {
        $spk = Yii::$app->request->get('spk');
        $metode = Yii::$app->request->get('metode');

        $penilaian = $kriteria = $nilai = $hasil = $alt_terbaik = null;
        $data_spk = Spk::find()->indexBy('id')->all();

        if ($spk && $metode) {
            $penilaian = Penilaian::find()->alias('p')->where(['p.id_spk' => $spk])->joinWith(['alternatif'])->all();
            $kriteria = Kriteria::find()->indexBy('id')->where(['id_spk' => $spk])->all();
            
            if ($penilaian) {

                $nilai = $this->getNilai($penilaian);

                if ($metode === 'saw') {
                    $hasil = $this->generateSaw($nilai, $kriteria);
                } else if ($metode === 'wp') {
                    $hasil = $this->generateWp($nilai, $kriteria);
                }

                $alt_terbaik = $this->getAlternatifTerbaik($hasil, $metode);
            }
        }

        return $this->render('index', [
            'data_spk' => $data_spk,
            'penilaian' => $penilaian,
            'kriteria' => $kriteria,
            'nilai' => $nilai,
            'hasil' => $hasil,
            'alt_terbaik' => $alt_terbaik,
            'spk' => $spk,
            'metode' => $metode,
        ]);
    }

    public function getNilai($penilaian)
    {
        $nilai = [];

        foreach ($penilaian as $key => $pen) {
            $nilai[$pen->id] = json_decode($pen->penilaian, true);
        }

        return $nilai;
    }

    public function generateSaw($nilai, $kriteria)
    {
        $normalisasi = $this->getNormalisasi($nilai, $kriteria);
        $rank = $this->getRank($normalisasi, $kriteria);

        return [
            'normalisasi' => $normalisasi,
            'rank' => $rank,
        ];
    }

    public function generateWp($nilai, $kriteria)
    {
        $vektor_s = $this->getVektorS($nilai, $kriteria);
        $vektor_v = $this->getVektorV($vektor_s);

        return [
            'vektor_s' => $vektor_s,
            'vektor_v' => $vektor_v,
        ];
    }

    public function getNormalisasi($nilai, $kriteria)
    {
        $normalisasi = [];
        $min_max = [];

        foreach ($nilai as $key => $nil) {
            foreach ($nil as $k => $n) {
                $min_max[$k][] = $n;
            }
        }

        foreach ($min_max as $k => $m) {
            $min_max[$k] = ($kriteria[$k]->type == Kriteria::COST) ? min($m) : max($m);
        }

        foreach ($nilai as $key => $nil) {
            foreach ($nil as $k => $n) {
                $normalisasi[$key][$k] = ($kriteria[$k]->type == Kriteria::COST) ? $min_max[$k] / $n : $n / $min_max[$k];  
            }
        }

        return $normalisasi;
    }

    public function getRank($normalisasi, $kriteria)
    {
        $rank = [];

        foreach ($normalisasi as $key => $norm) {
            foreach ($norm as $k => $n) {
                $rank[$key][] = $n * $kriteria[$k]->bobot;
            }
            $rank[$key] = array_sum($rank[$key]);
        }

        arsort($rank);

        return $rank;
    }

    public function getVektorS($nilai, $kriteria)
    {
        $vektor_s = [];

        foreach ($nilai as $key => $nil) {
            foreach ($nil as $k => $n) {
                $vektor_s[$key][$k] = ($kriteria[$k]->type == Kriteria::COST) ? pow($n, -($kriteria[$k]->bobot)) : pow($n, $kriteria[$k]->bobot);  
            }
            $vektor_s[$key] = array_product($vektor_s[$key]);
        }

        return $vektor_s;
    }

    public function getVektorV($vektor_s)
    {
        $vektor_v = [];
        $sum = array_sum($vektor_s);

        foreach ($vektor_s as $key => $vek) {
            $vektor_v[$key] = $vek / $sum;
        }
        arsort($vektor_v);
        return $vektor_v;
    }


    public function getAlternatifTerbaik($hasil, $metode) {
        $data = $metode === 'saw' ? $hasil['rank'] : $hasil['vektor_v'];
        $bests = array_keys($data, max($data));

        foreach ($bests as $key => $best) {
            $bests[$key] = Helpers::getNamaAlternatifByIdPenilaian($best);
        }

        return $bests;
    }
    
}