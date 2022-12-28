<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "coraltravel_country".
 *
 * @property int $ID
 * @property string $Name
 * @property string $LName
 * @property int|null $IsDestination
 * @property int|null $IsMarket
 * @property string $SName
 * @property string|null $PhoneCode
 * @property int|null $RegionalPhoneSizeCode
 * @property float|null $Latitude
 * @property float|null $Longitude
 * @property string $ISOCode
 * @property string $ShortName
 *
 * @property CountryCountry[] $countryCountries
 */
class CoraltravelCountry extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'coraltravel_country';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'Name', 'LName', 'SName', 'ISOCode', 'ShortName'], 'required'],
            [['ID', 'RegionalPhoneSizeCode'], 'integer'],
            //[['IsDestination', 'IsMarket'], 'default', 'value' => 0],  IsMarket
            [['IsDestination', 'IsMarket'], 'number'],
            [['Latitude', 'Longitude'], 'number'],
            [['Name', 'LName', 'SName'], 'string', 'max' => 150],
            [['PhoneCode'], 'string', 'max' => 5],
            [['ISOCode', 'ShortName'], 'string', 'max' => 20],
            [['ID'], 'unique'],
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
            'IsDestination' => Yii::t('app', 'Is Destination'),
            'IsMarket' => Yii::t('app', 'Is Market'),
            'SName' => Yii::t('app', 'S Name'),
            'PhoneCode' => Yii::t('app', 'Phone Code'),
            'RegionalPhoneSizeCode' => Yii::t('app', 'Regional Phone Size Code'),
            'Latitude' => Yii::t('app', 'Latitude'),
            'Longitude' => Yii::t('app', 'Longitude'),
            'ISOCode' => Yii::t('app', 'Iso Code'),
            'ShortName' => Yii::t('app', 'Short Name'),
        ];
    }

    /**
     * Gets query for [[CountryCountries]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCountryCountries()
    {
        return $this->hasMany(CountryCountry::class, ['op_country_id' => 'ID']);
    }
}
