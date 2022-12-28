<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "coraltravel_meal".
 *
 * @property int $ID
 * @property string $Name
 * @property string|null $LName
 * @property string $SName
 * @property string|null $InfoSheetMeal
 * @property string|null $ConceptTiming
 * @property int $Hotel
 */
class CoraltravelMeal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'coraltravel_meal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'Name'], 'required'],
            [['ID', 'Hotel'], 'integer'],
            [['Name', 'LName', 'SName'], 'string', 'max' => 150],
            [['InfoSheetMeal'], 'string', 'max' => 255],
            [['ConceptTiming'], 'string', 'max' => 50],
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
            'Name' => Yii::t('app', 'Питание'),
            'LName' => Yii::t('app', 'L Name'),
            'SName' => Yii::t('app', 'S Name'),
            'InfoSheetMeal' => Yii::t('app', 'Info Sheet Meal'),
            'ConceptTiming' => Yii::t('app', 'Concept Timing'),
            'Hotel' => Yii::t('app', 'Hotel'),
        ];
    }
}
