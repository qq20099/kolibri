<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "ticket_attribute".
 *
 * @property int $ticket_id
 * @property int $attribute_id
 *
 * @property Attribute $attribute0
 * @property Ticket $ticket
 */
class TicketAttribute extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ticket_attribute';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ticket_id', 'attribute_id'], 'required'],
            [['ticket_id', 'attribute_id'], 'integer'],
            [['ticket_id', 'attribute_id'], 'unique', 'targetAttribute' => ['ticket_id', 'attribute_id']],
            [['attribute_id'], 'exist', 'skipOnError' => true, 'targetClass' => Attribute::class, 'targetAttribute' => ['attribute_id' => 'id']],
            [['ticket_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ticket::class, 'targetAttribute' => ['ticket_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ticket_id' => Yii::t('app', 'Ticket ID'),
            'attribute_id' => Yii::t('app', 'Attribute ID'),
        ];
    }

    /**
     * Gets query for [[Attribute0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAttribute0()
    {
        return $this->hasOne(Attribute::class, ['id' => 'attribute_id']);
    }

    /**
     * Gets query for [[Ticket]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTicket()
    {
        return $this->hasOne(Ticket::class, ['id' => 'ticket_id']);
    }
}
