<?php

namespace app\models;

use Yii;
use app\models\Alternatif;
/**
 * This is the model class for table "{{%penilaian}}".
 *
 * @property int $id
 * @property int $id_spk
 * @property int $id_alternatif
 * @property string $penilaian json penilaian
 * @property string $created_date
 * @property string $updated_date
 */
class Penilaian extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%penilaian}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_spk', 'id_alternatif', 'penilaian'], 'required'],
            [['id_spk', 'id_alternatif'], 'integer'],
            [['penilaian'], 'string'],
            [['created_date', 'updated_date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_spk' => 'Nama Spk',
            'id_alternatif' => 'Nama Alternatif',
            'penilaian' => 'Penilaian',
            'created_date' => 'Created Date',
            'updated_date' => 'Updated Date',
        ];
    }

    public function getAlternatif()
    {
        return $this->hasOne(Alternatif::className(), ['id' => 'id_alternatif']);
    }

    public static function namaAlternatif($id_penilaian)
    {
        $id_alternatif = self::findOne($id_penilaian)->id_alternatif;
        $nama_alternatif = Alternatif::findOne($id_alternatif)->nama_alternatif;

        return $nama_alternatif ? $nama_alternatif : '';
    }

    public static function cekAlternatif($id)
    {
        $alternatif_exist = self::find()->select(['id_alternatif'])->where(['id_spk' => $id])->column();

        $alternatif = Alternatif::find()->andWhere(['id_spk' => $id])->andWhere(['NOT IN', 'id', $alternatif_exist])->all();

        if ($alternatif) {
            $data_alternatif = \yii\helpers\ArrayHelper::map($alternatif, 'id', 'nama_alternatif');
            return $data_alternatif;
        }

        return null;
    }

    public static function cekKriteriaSesuaiPenilaian($id_spk, $jml_kriteria)
    {
        $penilaian = self::find()->where(['id_spk' => $id_spk])->all();
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
}
