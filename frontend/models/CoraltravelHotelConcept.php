<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "coraltravel_hotel_concept".
 *
 * @property int $ID
 * @property string $Name
 */
class CoraltravelHotelConcept extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'coraltravel_hotel_concept';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'Name'], 'required'],
            [['ID'], 'integer'],
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
        ];
    }
}
