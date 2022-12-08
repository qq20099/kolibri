<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "raiting".
 *
 * @property string $session_id
 * @property int $user_id
 * @property int $hotel_id
 * @property int $value
 *
 * @property Hotel $hotel
 */
class Raiting extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'raiting';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['session_id', 'hotel_id'], 'required'],
            [['user_id', 'hotel_id', 'value'], 'integer'],
            [['session_id'], 'string', 'max' => 40],
            [['session_id', 'hotel_id'], 'unique', 'targetAttribute' => ['session_id', 'hotel_id']],
            [['hotel_id'], 'exist', 'skipOnError' => true, 'targetClass' => Hotel::class, 'targetAttribute' => ['hotel_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'session_id' => Yii::t('frontend', 'Session ID'),
            'user_id' => Yii::t('frontend', 'User ID'),
            'hotel_id' => Yii::t('frontend', 'Hotel ID'),
            'value' => Yii::t('frontend', 'Value'),
        ];
    }

    /**
     * Gets query for [[Hotel]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHotel()
    {
        return $this->hasOne(Hotel::class, ['id' => 'hotel_id']);
    }
}
