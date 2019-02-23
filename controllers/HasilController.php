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
        $result['spk'] = Yii::$app->request->get('spk');
        $result['metode'] = Yii::$app->request->get('metode');

        $result['data_spk'] = Spk::find()->indexBy('id')->all();

        if ($result['spk'] && $result['metode']) {
            $result = array_merge($result, $this->getHasil($result['spk'], $result['metode']));
        }

        return $this->render('index', $result);
    }

    public function actionExportPdf($spk, $metode)
    {
        if (empty($spk) || ($metode !== 'saw' && $metode !== 'wp')) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $result['spk'] = Yii::$app->request->get('spk');
        $result['metode'] = Yii::$app->request->get('metode');
        $result['alternatif'] = \app\models\Alternatif::find()->where(['id_spk' => $spk])->asArray()->all();

        $result = array_merge($result, $this->getHasil($result['spk'], $result['metode']));

        $result['normalisasi'] = isset($result['hasil']['normalisasi']) ? $result['hasil']['normalisasi'] : null;
        $result['rank'] = isset($result['hasil']['rank']) ? $result['hasil']['rank'] : null;
        $result['vektor_s'] = isset($result['hasil']['vektor_s']) ? $result['hasil']['vektor_s'] : null;
        $result['vektor_v'] = isset($result['hasil']['vektor_v']) ? $result['hasil']['vektor_v'] : null;

        $content = $this->renderPartial('pdf/pdf_hasil', $result);
        $filename = strtolower('spk-' . str_replace(' ', '-', Helpers::getNamaSpkByIdSpk($spk)) . '-' . $metode . '-' . time() . '.pdf');

        return Helpers::generatePdf($content, 'I', $filename);
    }

    public function actionExportExcel()
    {
        
    }

    public function getHasil($id_spk, $metode)
    {
        $penilaian = $kriteria = $nilai = $hasil = $alt_terbaik = null;
        $penilaian = Penilaian::find()->alias('p')->where(['p.id_spk' => $id_spk])->joinWith(['alternatif'])->all();
        $kriteria = Kriteria::find()->indexBy('id')->where(['id_spk' => $id_spk])->all();

        if ($penilaian) {
            $nilai = $this->getNilai($penilaian);

            if ($metode === 'saw') {
                $hasil = $this->generateSaw($nilai, $kriteria);
            } else if ($metode === 'wp') {
                $hasil = $this->generateWp($nilai, $kriteria);
            }

            $alt_terbaik = $this->getAlternatifTerbaik($hasil, $metode);
        
        }

        return [
            'penilaian' => $penilaian,
            'kriteria' => $kriteria,
            'nilai' => $nilai,
            'hasil' => $hasil,
            'alt_terbaik' => $alt_terbaik,
        ];
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