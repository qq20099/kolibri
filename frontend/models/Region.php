<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "region".
 *
 * @property int $id
 * @property string $title
 * @property int $country_id
 * @property int $activity
 *
 * @property RegionRegion[] $regionRegions
 */
class Region extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'region';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'country_id'], 'required'],
            [['country_id', 'activity'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['title', 'country_id'], 'unique', 'targetAttribute' => ['title', 'country_id']],
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
            'country_id' => Yii::t('app', 'Country ID'),
            'activity' => Yii::t('app', 'Activity'),
        ];
    }

    /**
     * Gets query for [[RegionRegions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegionRegions()
    {
        return $this->hasMany(RegionRegion::class, ['region_id' => 'id']);
    }
}
