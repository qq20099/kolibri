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
 * @property int $hot
 *
 * @property Attribute[] $attributes0
 * @property Hotel $hotel
 * @property TicketAttribute[] $ticketAttributes
 */
class Ticket extends \yii\db\ActiveRecord
{
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
            [['person', 'date', 'days', 'pitanie', 'hotel_id', 'hot'], 'integer'],
            [['date', 'days', 'price', 'hotel_id'], 'required'],
            [['price'], 'number'],
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
            'hot' => Yii::t('app', 'Hot'),
        ];
    }

    /**
     * Gets query for [[Attributes0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAttributes0()
    {
        return $this->hasMany(Attribute::class, ['id' => 'attribute_id'])->viaTable('ticket_attribute', ['ticket_id' => 'id']);
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

    /**
     * Gets query for [[TicketAttributes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTicketAttributes()
    {
        return $this->hasMany(TicketAttribute::class, ['ticket_id' => 'id']);
    }
}
