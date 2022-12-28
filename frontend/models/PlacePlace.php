<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "place_place".
 *
 * @property int $place_id
 * @property int $op_place_id
 * @property string $operator
 *
 * @property CoraltravelPlace $opPlace
 * @property Place $place
 */
class PlacePlace extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'place_place';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['place_id', 'op_place_id', 'operator'], 'required'],
            [['place_id', 'op_place_id'], 'integer'],
            [['operator'], 'string', 'max' => 20],
            [['place_id', 'op_place_id', 'operator'], 'unique', 'targetAttribute' => ['place_id', 'op_place_id', 'operator']],
            [['op_place_id'], 'exist', 'skipOnError' => true, 'targetClass' => CoraltravelPlace::class, 'targetAttribute' => ['op_place_id' => 'ID']],
            [['place_id'], 'exist', 'skipOnError' => true, 'targetClass' => Place::class, 'targetAttribute' => ['place_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'place_id' => Yii::t('app', 'Place ID'),
            'op_place_id' => Yii::t('app', 'Op Place ID'),
            'operator' => Yii::t('app', 'Operator'),
        ];
    }

    /**
     * Gets query for [[OpPlace]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOpPlace()
    {
        return $this->hasOne(CoraltravelPlace::class, ['ID' => 'op_place_id']);
    }

    /**
     * Gets query for [[Place]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlace()
    {
        return $this->hasOne(Place::class, ['id' => 'place_id']);
    }
}
