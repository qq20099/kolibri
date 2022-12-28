<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "country".
 *
 * @property int $id
 * @property string $title
 * @property string $iso_code
 * @property int $activity
 *
 * @property CountryCountry[] $countryCountries
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
            [['title'], 'required'],
            [['activity'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['iso_code'], 'string', 'max' => 10],
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
            'iso_code' => Yii::t('app', 'Iso Code'),
            'activity' => Yii::t('app', 'Activity'),
        ];
    }

    /**
     * Gets query for [[CountryCountries]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCountryCountries()
    {
        return $this->hasMany(CountryCountry::class, ['country_id' => 'id']);
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
