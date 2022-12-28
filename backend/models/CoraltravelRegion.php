<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "coraltravel_region".
 *
 * @property int $ID
 * @property string $Name
 * @property string $LName
 * @property int $CountryID
 *
 * @property CoraltravelCountry $country
 * @property RegionRegion[] $regionRegions
 */
class CoraltravelRegion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'coraltravel_region';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'Name', 'LName', 'CountryID'], 'required'],
            [['ID', 'CountryID'], 'integer'],
            [['Name', 'LName'], 'string', 'max' => 150],
            [['ID'], 'unique'],
            [['CountryID'], 'exist', 'skipOnError' => true, 'targetClass' => CoraltravelCountry::class, 'targetAttribute' => ['CountryID' => 'ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => Yii::t('app', 'ID'),
            'Name' => Yii::t('app', 'Name'),
            'LName' => Yii::t('app', 'L Name'),
            'CountryID' => Yii::t('app', 'Country ID'),
        ];
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
     * Gets query for [[RegionRegions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegionRegions()
    {
        return $this->hasMany(RegionRegion::class, ['op_region_id' => 'ID']);
    }

    public function getRegion()
    {
        //return $this->hasMany(CountryCountry::class, ['op_country_id' => 'ID']);
        return $this->hasOne(Region::className(), ['id' => 'region_id'])
            ->viaTable(RegionRegion::tableName(), ['op_region_id' => 'ID']);
    }
}
