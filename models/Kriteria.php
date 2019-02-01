<?php

namespace app\models;

use Yii;

use yii\db\ActiveRecord;
use yii\db\Expression;
/**
 * This is the model class for table "{{%kriteria}}".
 *
 * @property int $id
 * @property string $nama_kriteria
 * @property int $type 0=cost, 1=benefit
 * @property double $bobot
 * @property int $id_spk
 * @property string $created_date
 * @property string $updated_date
 */
class Kriteria extends \yii\db\ActiveRecord
{
    const COST = 0;
    const BENEFIT = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%kriteria}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama_kriteria', 'id_spk'], 'required'],
            [['type', 'id_spk'], 'integer'],
            [['bobot'], 'number'],
            [['created_date', 'updated_date'], 'safe'],
            [['nama_kriteria'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama_kriteria' => 'Nama Kriteria',
            'type' => 'Type',
            'bobot' => 'Bobot',
            'id_spk' => 'Nama SPK',
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
}
