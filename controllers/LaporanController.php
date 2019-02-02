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

/**
 * LaporanController 
 */
class LaporanController extends Controller
{

    /**
     * Lists all Laporan
     * @param int $id (id_spk)
     * @return mixed
     */
    public function actionIndex($id = null)
    {
        if ($id != null && !Spk::find()->where(['id' => $id])->exists()) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $laporan = $this->generateLaporan($id);
        $laporan['data_spk'] = Spk::find()->indexBy('id')->all();

        return $this->render('index', $laporan);
    }

    public function generateLaporan($id)
    {
        $penilaian = Penilaian::find()->alias('p')->where(['p.id_spk' => $id])->joinWith(['alternatif'])->all();
        $kriteria = Kriteria::find()->indexBy('id')->where(['id_spk' => $id])->all();

        $nilai = $this->getNilai($penilaian);
        $normalisasi = $this->getNormalisasi($nilai, $kriteria);
        $rank = $this->getRank($normalisasi, $kriteria);

        return [
            'penilaian' => $penilaian,
            'kriteria' => $kriteria,
            'nilai' => $nilai,
            'normalisasi' => $normalisasi,
            'rank' => $rank,
            'id' => $id,
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
        // print_r($rank);die();

        return $rank;
    }
    
}