<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "coraltravel_currency".
 *
 * @property int $ID
 * @property string $Name
 * @property string $LName
 * @property string $SName
 * @property string|null $ISOCode
 * @property string|null $SLName
 */
class CoraltravelCurrency extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'coraltravel_currency';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'Name', 'LName', 'SName'], 'required'],
            [['ID'], 'integer'],
            [['Name', 'LName'], 'string', 'max' => 150],
            [['SName'], 'string', 'max' => 5],
            [['ISOCode', 'SLName'], 'string', 'max' => 20],
            [['SName'], 'unique'],
            [['ID'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => Yii::t('app', 'ID'),
            'Name' => Yii::t('app', 'Name'),
            'LName' => Yii::t('app', 'L Name'),
            'SName' => Yii::t('app', 'S Name'),
            'ISOCode' => Yii::t('app', 'Iso Code'),
            'SLName' => Yii::t('app', 'Sl Name'),
        ];
    }
}
