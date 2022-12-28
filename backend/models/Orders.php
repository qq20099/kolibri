<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property int $client_id
 * @property int $tour_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Client $client
 * @property Tours $tour
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['client_id', 'tour_id'], 'required'],
            [['client_id', 'tour_id', 'created_at', 'updated_at'], 'integer'],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => Client::class, 'targetAttribute' => ['client_id' => 'id']],
            [['tour_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tours::class, 'targetAttribute' => ['tour_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client_id' => 'Client ID',
            'tour_id' => 'Tour ID',
            'created_at' => 'Создан',
            'updated_at' => 'Обновлен',
        ];
    }

    /**
     * Gets query for [[Client]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Client::class, ['id' => 'client_id']);
    }

    /**
     * Gets query for [[Tour]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasOne(OrderItems::class, ['order_id' => 'id']);
        //return $this->hasOne(Tours::class, ['id' => 'tour_id']);
    }
}
