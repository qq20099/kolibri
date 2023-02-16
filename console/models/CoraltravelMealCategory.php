<?php

namespace console\models;

use Yii;

/**
 * This is the model class for table "coraltravel_meal_category".
 *
 * @property int $ID
 * @property string $Name
 * @property string|null $LName
 * @property string $SName
 */
class CoraltravelMealCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'coraltravel_meal_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'Name', 'SName'], 'required'],
            [['ID'], 'integer'],
            [['Name', 'LName', 'SName'], 'string', 'max' => 150],
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
        ];
    }
}
