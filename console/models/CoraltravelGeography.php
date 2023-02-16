<?php

namespace console\models;

use Yii;

/**
 * This is the model class for table "coraltravel_geography".
 *
 * @property int $CountryID
 * @property string $CountryName
 * @property string $CountryLName
 * @property int $RegionID
 * @property string $RegionName
 * @property string $RegionLName
 * @property int $AreaID
 * @property string $AreaName
 * @property string $AreaLName
 * @property int $PlaceID
 * @property string $PlaceName
 * @property string $PlaceLName
 *
 * @property CoraltravelArea $area
 * @property CoraltravelCountry $country
 * @property CoraltravelPlace $place
 * @property CoraltravelRegion $region
 */
class CoraltravelGeography extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'coraltravel_geography';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['CountryID', 'CountryName', 'CountryLName', 'RegionID', 'RegionName', 'RegionLName', 'AreaID', 'AreaName', 'AreaLName', 'PlaceID', 'PlaceName', 'PlaceLName'], 'required'],
            [['CountryID', 'RegionID', 'AreaID', 'PlaceID'], 'integer'],
            [['CountryName', 'CountryLName', 'RegionName', 'RegionLName', 'AreaName', 'AreaLName', 'PlaceName', 'PlaceLName'], 'string', 'max' => 150],
            /*[['CountryID'], 'exist', 'skipOnError' => true, 'targetClass' => CoraltravelCountry::class, 'targetAttribute' => ['CountryID' => 'ID']],
            [['AreaID'], 'exist', 'skipOnError' => true, 'targetClass' => CoraltravelArea::class, 'targetAttribute' => ['AreaID' => 'ID']],
            [['PlaceID'], 'exist', 'skipOnError' => true, 'targetClass' => CoraltravelPlace::class, 'targetAttribute' => ['PlaceID' => 'ID']],
            [['RegionID'], 'exist', 'skipOnError' => true, 'targetClass' => CoraltravelRegion::class, 'targetAttribute' => ['RegionID' => 'ID']],*/
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'CountryID' => Yii::t('app', 'Country ID'),
            'CountryName' => Yii::t('app', 'Country Name'),
            'CountryLName' => Yii::t('app', 'Country L Name'),
            'RegionID' => Yii::t('app', 'Region ID'),
            'RegionName' => Yii::t('app', 'Region Name'),
            'RegionLName' => Yii::t('app', 'Region L Name'),
            'AreaID' => Yii::t('app', 'Area ID'),
            'AreaName' => Yii::t('app', 'Area Name'),
            'AreaLName' => Yii::t('app', 'Area L Name'),
            'PlaceID' => Yii::t('app', 'Place ID'),
            'PlaceName' => Yii::t('app', 'Place Name'),
            'PlaceLName' => Yii::t('app', 'Place L Name'),
        ];
    }

    /**
     * Gets query for [[Area]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArea()
    {
        return $this->hasOne(CoraltravelArea::class, ['ID' => 'AreaID']);
    }

    /**
     * Gets query for [[Country]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(CoraltravelCountry::class, ['ID' => 'CountryID']);
    }

    /**
     * Gets query for [[Place]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlace()
    {
        return $this->hasOne(CoraltravelPlace::class, ['ID' => 'PlaceID']);
    }

    /**
     * Gets query for [[Region]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(CoraltravelRegion::class, ['ID' => 'RegionID']);
    }
}
