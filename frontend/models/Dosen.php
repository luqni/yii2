<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "dosen".
 *
 * @property string $nidn
 * @property string $nama
 * @property string $tmp_lahir
 * @property string $tgl_lahir
 * @property string $jk
 * @property integer $prodi_id
 *
 * @property Prodi $prodi
 * @property RombonganBelajar[] $rombonganBelajars
 */
class Dosen extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dosen';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nidn', 'prodi_id'], 'required'],
            [['tgl_lahir'], 'safe'],
            [['prodi_id'], 'integer'],
            [['nidn'], 'string', 'max' => 10],
            [['nama', 'tmp_lahir'], 'string', 'max' => 45],
            [['jk'], 'string', 'max' => 1],
            [['prodi_id'], 'exist', 'skipOnError' => true, 'targetClass' => Prodi::className(), 'targetAttribute' => ['prodi_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'nidn' => 'Nidn',
            'nama' => 'Nama',
            'tmp_lahir' => 'Tmp Lahir',
            'tgl_lahir' => 'Tgl Lahir',
            'jk' => 'Jk',
            'prodi_id' => 'Prodi ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProdi()
    {
        return $this->hasOne(Prodi::className(), ['id' => 'prodi_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRombonganBelajars()
    {
        return $this->hasMany(RombonganBelajar::className(), ['dosen_pa' => 'nidn']);
    }
}
