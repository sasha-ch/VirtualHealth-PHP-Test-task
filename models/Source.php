<?php

namespace app\models;

use app\models\Rel;
use Yii;

/**
 * This is the model class for table "{{%source}}".
 *
 * @property integer $ID
 * @property string  $MEDREC_ID
 * @property string  $ICD
 * @property string  $PATIENT_NAME
 */
class Source extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%source}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['MEDREC_ID', 'ICD'], 'string', 'max' => 10],
            [['PATIENT_NAME'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'MEDREC_ID' => 'Medrec  ID',
            'ICD' => 'Icd',
            'PATIENT_NAME' => 'Patient  Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRel()
    {
        return $this->hasMany(Rel::className(), ['MEDREC_ID' => 'MEDREC_ID']);
    }
}
