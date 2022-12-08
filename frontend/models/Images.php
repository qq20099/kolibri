<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "images".
 *
 * @property int $id
 * @property string $title
 * @property int $hotel_id
 *
 * @property Hotel $hotel
 */
class Images extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'images';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'hotel_id'], 'required'],
            [['hotel_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['hotel_id'], 'exist', 'skipOnError' => true, 'targetClass' => Hotel::class, 'targetAttribute' => ['hotel_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('frontend', 'ID'),
            'title' => Yii::t('frontend', 'Title'),
            'hotel_id' => Yii::t('frontend', 'Hotel ID'),
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
