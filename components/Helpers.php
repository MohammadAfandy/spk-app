<?php

namespace app\components;

use Yii;

use app\models\Alternatif;
use app\models\Kriteria;
use app\models\Spk;
use app\models\Penilaian;

class Helpers extends \yii\base\Component
{

    public static function dateIndonesia($date) 
    {
        $result = '';
        if(!empty($date) && $date !== '0000-00-00') {
            $BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"); 
            $tahun = substr($date, 0, 4);
            $bulan = substr($date, 5, 2);
            $tgl   = substr($date, 8, 2);
         
            $result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;
            
        }
        return $result;
    }

    public static function dateTimeIndonesia($date) 
    {
        $result = '';
        if(!empty($date) && $date !== '0000-00-00 00:00:00') {
            $BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"); 
            $tahun = substr($date, 0, 4);
            $bulan = substr($date, 5, 2);
            $tgl   = substr($date, 8, 2);
         
            $result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun.' - '.substr($date, 11, 19);
            
        }
        return $result;
    }

    public static function getNamaAlternatifByIdAlternatif($id_alternatif)
    {
        $nama_alternatif = Alternatif::findOne($id_alternatif)->nama_alternatif;

        return !empty($nama_alternatif) ? $nama_alternatif : '';
    }

    public static function getNamaSpkByIdSpk($id_spk)
    {
        $nama_spk = Spk::findOne($id_spk)->nama_spk;

        return !empty($nama_spk) ? $nama_spk : '';
    }

    public static function cekBobotKosong($id_spk)
    {
        $arr_bobot = [];
        $kriteria = Kriteria::find()->select('bobot')->where(['id_spk' => $id_spk])->asArray()->all();
        
        foreach ($kriteria as $key => $kri) {
            $arr_bobot[] = $kri['bobot'];
        }

        if (in_array(0, $arr_bobot)) {
            return true;
        } else {
            return false;
        }
    }

    public static function cekKriteriaSesuaiPenilaian($id_spk, $jml_kriteria)
    {
        $penilaian = Penilaian::find()->where(['id_spk' => $id_spk])->all();
        $kriteria = Kriteria::find()->where(['id_spk' => $id_spk])->all();
        $arr_jml_nilai = [];

        foreach ($penilaian as $key => $pen) {
            $arr_jml_nilai[] = count(json_decode($pen->penilaian, true));
        }

        foreach ($arr_jml_nilai as $jml) {
            if ($jml_kriteria != $jml) {
                return false;
            }
        }
        
        return true;
    }

    public static function getNamaAlternatifByIdPenilaian($id_penilaian)
    {
        $id_alternatif = Penilaian::findOne($id_penilaian)->id_alternatif;
        $nama_alternatif = Alternatif::findOne($id_alternatif)->nama_alternatif;

        return $nama_alternatif ? $nama_alternatif : '';
    }

    /**
     * Convert nilai crips to nama crips
     * @param double nilai_crips
     * @param int id_kriteria
     * @return string nama_crips
     */
    public static function nilaiToCrips($nilai_crips, $id_kriteria)
    {
        $crips = json_decode(Kriteria::findOne($id_kriteria)->crips, true);
        
        if ($crips) {
            $nama_crips = array_search($nilai_crips, $crips);
            if ($nama_crips) {
                return $nama_crips;   
            } else {
                return $nilai_crips;
            }   
        } else {
            return $nilai_crips;
        }
    }

    public static function getCrips($id_kriteria)
    {
        $crips = json_decode(Kriteria::findOne($id_kriteria)->crips, true);

        return $crips ? array_flip($crips) : '';
    }

}