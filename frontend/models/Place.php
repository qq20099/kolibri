<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "place".
 *
 * @property int $id
 * @property string $title
 * @property int $area_id
 * @property int $activity
 *
 * @property PlacePlace[] $placePlaces
 */
class Place extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'place';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'area_id'], 'required'],
            [['area_id', 'activity'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['title', 'area_id'], 'unique', 'targetAttribute' => ['title', 'area_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'area_id' => Yii::t('app', 'Area ID'),
            'activity' => Yii::t('app', 'Activity'),
        ];
    }

    /**
     * Gets query for [[PlacePlaces]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlacePlaces()
    {
        return $this->hasMany(PlacePlace::class, ['place_id' => 'id']);
    }
}
