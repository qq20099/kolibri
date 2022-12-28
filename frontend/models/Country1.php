<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "country".
 *
 * @property int $id
 * @property string $title
 * @property int $activity
 *
 * @property Location[] $locations
 */
class Country extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'country';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'iso_code'], 'required'],
            [['activity'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['iso_code'], 'filter', 'filter' => 'strtoupper'],
            [['iso_code'], 'unique'],
            [['iso_code'], 'string', 'max' => 10],
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
            'activity' => Yii::t('frontend', 'Activity'),
        ];
    }

    /**
     * Gets query for [[Locations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLocations()
    {
        return $this->hasMany(Location::class, ['country_id' => 'id']);
    }
}
