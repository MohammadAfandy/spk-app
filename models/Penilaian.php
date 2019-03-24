<?php

namespace app\models;

use Yii;
use app\models\Alternatif;
use yii\db\ActiveRecord;
use yii\db\Expression;

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

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_date', 'updated_date'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_date'],
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public function getAlternatif()
    {
        return $this->hasOne(Alternatif::className(), ['id' => 'id_alternatif'])->from(['alternatif' => Alternatif::tableName()]);
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

    
}
