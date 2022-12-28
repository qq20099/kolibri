<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "coraltravel_to_country".
 *
 * @property int $ID
 * @property string $Name
 * @property int $BeginNight
 * @property int $EndNight
 * @property int $Currency
 * @property int $FromArea
 */
class CoraltravelToCountry extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'coraltravel_to_country';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'Name', 'BeginNight', 'EndNight', 'Currency', 'FromArea'], 'required'],
            [['ID', 'BeginNight', 'EndNight', 'Currency', 'FromArea'], 'integer'],
            [['Name'], 'string', 'max' => 150],
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
            'BeginNight' => Yii::t('app', 'Begin Night'),
            'EndNight' => Yii::t('app', 'End Night'),
            'Currency' => Yii::t('app', 'Currency'),
            'FromArea' => Yii::t('app', 'From Area'),
        ];
    }
}
