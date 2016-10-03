<?php

namespace app\models;

use app\models\Source;
use Yii;

/**
 * This is the model class for table "{{%rel}}".
 *
 * @property integer $ID
 * @property string  $MEDREC_ID
 * @property string  $NDC
 */
class Rel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%rel}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['MEDREC_ID'], 'string', 'max' => 10],
            [['NDC'], 'string', 'max' => 20],
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
            'NDC' => 'Ndc',
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSource()
    {
        return $this->hasMany(Source::className(), ['MEDREC_ID' => 'MEDREC_ID']);
    }
}
