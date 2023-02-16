<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "tour_child_ages".
 *
 * @property int $id
 * @property int $tour_id
 * @property int $age
 *
 * @property Tours $tour
 */
class TourChildAges extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tour_child_ages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tour_id', 'age'], 'required'],
            [['tour_id', 'age'], 'integer'],
            [['tour_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tours::class, 'targetAttribute' => ['tour_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'tour_id' => Yii::t('app', 'Tour ID'),
            'age' => Yii::t('app', 'Age'),
        ];
    }

    /**
     * Gets query for [[Tour]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTour()
    {
        return $this->hasOne(Tours::class, ['id' => 'tour_id']);
    }
}
