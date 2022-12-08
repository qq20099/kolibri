<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "ticket".
 *
 * @property int $id
 * @property int $person
 * @property int $date
 * @property int $days
 * @property int $pitanie
 * @property float $price
 * @property int $hotel_id
 *
 * @property Hotel $hotel
 */
class Ticket extends \yii\db\ActiveRecord
{
    public $country_id;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ticket';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'date', 'days', 'price', 'hotel_id'], 'required'],
            [['id', 'person', 'date', 'days', 'pitanie', 'hotel_id', 'hot', 'country_id'], 'integer'],
            [['price'], 'number'],
            [['id'], 'unique'],
            [['hotel_id'], 'exist', 'skipOnError' => true, 'targetClass' => Hotel::class, 'targetAttribute' => ['hotel_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'person' => Yii::t('app', 'Person'),
            'date' => Yii::t('app', 'Date'),
            'days' => Yii::t('app', 'Days'),
            'pitanie' => Yii::t('app', 'Pitanie'),
            'price' => Yii::t('app', 'Price'),
            'hotel_id' => Yii::t('app', 'Hotel ID'),
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
