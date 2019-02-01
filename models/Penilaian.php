<?php

namespace app\models;

use Yii;

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
            'id_spk' => 'Id Spk',
            'id_alternatif' => 'Id Alternatif',
            'penilaian' => 'Penilaian',
            'created_date' => 'Created Date',
            'updated_date' => 'Updated Date',
        ];
    }

    public function getAlternatif()
    {
        return $this->hasOne(\app\models\Alternatif::className(), ['id' => 'id_alternatif']);
    }
}
