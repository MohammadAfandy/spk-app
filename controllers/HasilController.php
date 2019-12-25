<?php

namespace app\controllers;

use Yii;
use app\models\Spk;
use app\models\Alternatif;
use app\models\Kriteria;
use app\models\Penilaian;
use yii\web\Controller;

use yii\helpers\ArrayHelper;
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
            // $result = array_merge($result, $this->getHasil($result['spk'], $result['metode']));
            $result = $result + $this->getHasil($result['spk'], $result['metode']);
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
        $result['alternatif'] = Alternatif::find()->where(['id_spk' => $spk])->asArray()->all();

        // $result = array_merge($result, $this->getHasil($result['spk'], $result['metode']));
        $result = $result + $this->getHasil($result['spk'], $result['metode']);

        $result['normalisasi'] = isset($result['hasil']['normalisasi']) ? $result['hasil']['normalisasi'] : null;
        $result['rank'] = isset($result['hasil']['rank']) ? $result['hasil']['rank'] : null;
        $result['vektor_s'] = isset($result['hasil']['vektor_s']) ? $result['hasil']['vektor_s'] : null;
        $result['vektor_v'] = isset($result['hasil']['vektor_v']) ? $result['hasil']['vektor_v'] : null;

        $content = $this->renderPartial('pdf/pdf_hasil', $result);
        $filename = strtolower('spk-' . str_replace(' ', '-', Helpers::getNamaSpkByIdSpk($spk)) . '-' . $metode . '-' . time() . '.pdf');

        return Helpers::generatePdf($content, 'I', $filename);
    }

    public function actionExportExcel($spk, $metode)
    {
        if (empty($spk) || ($metode !== 'saw' && $metode !== 'wp')) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $data_alternatif = $data_kriteria = $penilaian = $normalisasi = $rank = $vektor_s = $vektor_v = [];

        $no = 0;
        $data_alternatif = array_map(function($v) use (&$no) {
            return ['no' => ++$no] + $v;
        }, Alternatif::find()->select(['nama_alternatif', 'keterangan'])->where(['id_spk' => $spk])->asArray()->all());
        
        $no = 0;
        $data_kriteria = array_map(function($v) use (&$no, $spk) {
            $v['type'] = $v['type'] == Kriteria::COST ? 'COST' : 'BENEFIT'; 
            $v['bobot'] = Helpers::getJenisBobot($spk) == Spk::BOBOT_PERSEN ? $v['bobot'] * 100 . ' %' : $v['bobot']; 
            return ['no' => ++$no] + $v;
        }, Kriteria::find()->select(['nama_kriteria', 'type', 'bobot'])->where(['id_spk' => $spk])->asArray()->all());

        $result = $this->getHasil($spk, $metode);

        $arr_rank = $metode === 'saw' ? array_keys($result['hasil']['rank']) : array_keys($result['hasil']['vektor_v']);
        $titles = ['No', 'Nama Alternatif'];

        foreach ($result['kriteria'] as $kriteria) {
            $titles[] = $kriteria->nama_kriteria . ' (' . Helpers::getTypeKriteria($kriteria->type) . ')';
        }

        $i = 0;
        foreach ($result['nilai'] as $id_pen => $nilai) {
            $j = 2;
            $key = array_search($id_pen, $arr_rank);
            $penilaian[$i][] = $i + 1;
            $penilaian[$i][] = Helpers::getNamaAlternatifByIdPenilaian($id_pen);

            if ($metode === 'saw') {
                $normalisasi[$i][] =  $i + 1;
                $rank[$key][] = $key + 1;
                $normalisasi[$i][] = $rank[$key][] = Helpers::getNamaAlternatifByIdPenilaian($id_pen);
                $rank[$key][] = round($result['hasil']['rank'][$id_pen], 3);
            } else {
                $vektor_s[$i][] = $i + 1;
                $vektor_v[$key][] = $key + 1;
                $vektor_s[$i][] = $vektor_v[$key][] = Helpers::getNamaAlternatifByIdPenilaian($id_pen);
                $vektor_s[$i][] = round($result['hasil']['vektor_s'][$id_pen], 3);
                $vektor_v[$key][] = round($result['hasil']['vektor_v'][$id_pen], 3);
            }

            foreach ($nilai as $id_kri => $kri) {
                $penilaian[$i][$j] = Helpers::nilaiToCrips($kri, $id_kri);
                if ($metode === 'saw') {
                    $normalisasi[$i][$j] = round($result['hasil']['normalisasi'][$id_pen][$id_kri], 3);
                }
                $j++;
            }

            $i++;
        }

        ksort($rank);
        ksort($vektor_v);

        $filename = strtolower('spk-' . str_replace(' ', '-', Helpers::getNamaSpkByIdSpk($spk)) . '-' . $metode . '-' . time() . '.xlsx');

        $data_excel = [
            'Alternatif' => [
                'data' => $data_alternatif,
                'titles' => ['No', 'Nama Alternatif', 'Keterangan'],
            ],
            'Kriteria' => [
                'data' => $data_kriteria,
                'titles' => ['No', 'Nama Kriteria', 'Type', 'Bobot'],
            ],
            'Penilaian' => [
                'data' => $penilaian,
                'titles' => $titles,
            ],
            ($metode === 'saw') ? 'Normalisasi' : 'Vektor S' => [
                'data' => ($metode === 'saw') ? $normalisasi : $vektor_s,
                'titles' => ($metode === 'saw') ? $titles : ['No', 'Nama Alternatif', 'Vektor S'],
            ],
            ($metode === 'saw') ? 'Rank' : 'Vektor V' => [
                'data' => ($metode === 'saw') ? $rank : $vektor_v,
                'titles' => ['No', 'Nama Alternatif', ($metode === 'saw') ? 'Rank' : 'Vektor V'],
            ],
        ];

        $style_excel = [
            'B1:B30' => [
                'alignment' => [
                    'horizontal' => 'left'
                ],
            ],
        ];

        return Helpers::generateExcel($filename, $data_excel, $style_excel);
    }

    public function getHasil($id_spk, $metode)
    {
        $penilaian = $kriteria = $nilai = $hasil = $alt_terbaik = null;
        $penilaian = Penilaian::find()->alias('p')->where(['p.id_spk' => $id_spk])->joinWith(['alternatif'])->all();
        $kriteria = Kriteria::find()->indexBy('id')->where(['id_spk' => $id_spk])->all();

        $arr_bobot = \yii\helpers\ArrayHelper::map($kriteria, 'id', 'bobot');
        if (!empty($arr_bobot) && is_array($arr_bobot)) {
            $sum_bobot = array_sum($arr_bobot);   

            if ($sum_bobot != 0) {
                foreach ($arr_bobot as $key => $bobot) {
                    $arr_bobot[$key] = (string) ($bobot / $sum_bobot);
                }
            }
        }

        $jenis_bobot = Helpers::getJenisBobot($id_spk);

        if ($penilaian && !Helpers::cekBobotKosong($id_spk)) {
            $nilai = $this->getNilai($penilaian);

            if ($metode === 'saw') {
                $hasil = $this->generateSaw($nilai, $kriteria,  $jenis_bobot);
            } else if ($metode === 'wp') {
                $hasil = $this->generateWp($nilai, $kriteria, $jenis_bobot);
            }

            $alt_terbaik = $this->getAlternatifTerbaik($hasil, $metode);
        
        }

        return [
            'penilaian' => $penilaian,
            'kriteria' => $kriteria,
            'arr_bobot' => $arr_bobot,
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

    public function generateSaw($nilai, $kriteria, $jenis_bobot)
    {
        $normalisasi = $this->getNormalisasi($nilai, $kriteria);
        $rank = $this->getRank($normalisasi, $kriteria, $jenis_bobot);

        return [
            'normalisasi' => $normalisasi,
            'rank' => $rank,
        ];
    }

    public function generateWp($nilai, $kriteria, $jenis_bobot)
    {
        $vektor_s = $this->getVektorS($nilai, $kriteria, $jenis_bobot);
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

    public function getRank($normalisasi, $kriteria, $jenis_bobot)
    {
        $rank = [];

        if ($jenis_bobot === Spk::BOBOT_PREFERENSI) {
            $arr_bobot = [];
            foreach ($kriteria as $k) {
                $arr_bobot[] = $k->bobot;
            }
            $sum_bobot = array_sum($arr_bobot);

            foreach ($normalisasi as $key => $norm) {
                foreach ($norm as $k => $n) {
                    $bobot = $kriteria[$k]->bobot / $sum_bobot;
                    $rank[$key][] = $n * $bobot;
                }
                $rank[$key] = array_sum($rank[$key]);
            }
        } else if ($jenis_bobot === Spk::BOBOT_PERSEN) {
            foreach ($normalisasi as $key => $norm) {
                foreach ($norm as $k => $n) {
                    $rank[$key][] = $n * $kriteria[$k]->bobot;
                }
                $rank[$key] = array_sum($rank[$key]);
            }
        }

        arsort($rank);

        return $rank;
    }

    public function getVektorS($nilai, $kriteria, $jenis_bobot)
    {
        $vektor_s = [];

        if ($jenis_bobot === Spk::BOBOT_PREFERENSI) {

            $arr_bobot = [];
            foreach ($kriteria as $k) {
                $arr_bobot[] = $k->bobot;
            }
            $sum_bobot = array_sum($arr_bobot);

            foreach ($nilai as $key => $nil) {
                foreach ($nil as $k => $n) {
                    $bobot = $kriteria[$k]->bobot / $sum_bobot;
                    $vektor_s[$key][$k] = ($kriteria[$k]->type == Kriteria::COST) ? pow($n, -($bobot)) : pow($n, $bobot);  
                }
                $vektor_s[$key] = array_product($vektor_s[$key]);
            }
        } else if ($jenis_bobot === Spk::BOBOT_PERSEN) {
            foreach ($nilai as $key => $nil) {
                foreach ($nil as $k => $n) {
                    $vektor_s[$key][$k] = ($kriteria[$k]->type == Kriteria::COST) ? pow($n, -($kriteria[$k]->bobot)) : pow($n, $kriteria[$k]->bobot);  
                }
                $vektor_s[$key] = array_product($vektor_s[$key]);
            }
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