<?php

namespace app\models;

use Yii;

use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "{{%alternatif}}".
 *
 * @property int $id
 * @property string $nama_alternatif
 * @property string $keterangan
 * @property int $id_spk
 * @property string $created_date
 * @property string $updated_date
 */
class Alternatif extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%alternatif}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama_alternatif'], 'required'],
            [['keterangan'], 'string'],
            [['id_spk'], 'integer'],
            [['created_date', 'updated_date'], 'safe'],
            [['nama_alternatif'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama_alternatif' => 'Nama Alternatif',
            'keterangan' => 'Keterangan',
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
