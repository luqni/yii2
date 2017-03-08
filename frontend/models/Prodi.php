<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "prodi".
 *
 * @property integer $id
 * @property string $kode
 * @property string $nama
 *
 * @property Dosen[] $dosens
 * @property Mahasiswa[] $mahasiswas
 */
class Prodi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'prodi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'integer'],
            [['kode'], 'string', 'max' => 2],
            [['nama'], 'string', 'max' => 45],
            [['kode'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kode' => 'Kode',
            'nama' => 'Nama',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDosens()
    {
        return $this->hasMany(Dosen::className(), ['prodi_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMahasiswas()
    {
        return $this->hasMany(Mahasiswa::className(), ['prodi_id' => 'id']);
    }
}
