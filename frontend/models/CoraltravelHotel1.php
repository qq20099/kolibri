<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "coraltravel_hotel".
 *
 * @property int $ID
 * @property string $Name
 * @property int $Place
 * @property int $HotelCategory
 * @property string|null $Address
 * @property string|null $Web
 * @property float $Latitude
 * @property float $Longitude
 * @property string|null $TripAdvisorCode
 * @property int $GiataCode
 * @property string|null $Phone1
 * @property string|null $Phone2
 * @property string|null $Fax1
 * @property string|null $Fax2
 * @property int $OperatorSaleCategory
 * @property string|null $CommercialName
 * @property string|null $TaxOffice
 * @property string|null $TaxNumber
 * @property string|null $invoiceAddress
 * @property string|null $email
 * @property float $tripAdvisorPoint
 * @property string|null $tripAdvisorImage
 * @property int $tripAdvisorCommentCount
 * @property string|null $cancelStatusWeb
 * @property int $disableOnB2C
 * @property int $dontShowTripAdvisorComments
 * @property int $CountryID
 *
 * @property Images[] $images
 * @property Tours[] $tours
 */
class CoraltravelHotel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'coraltravel_hotel';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'Name', 'Place', 'HotelCategory'], 'required'],
            [['ID', 'Place', 'HotelCategory', 'GiataCode', 'OperatorSaleCategory', 'tripAdvisorCommentCount', 'disableOnB2C', 'dontShowTripAdvisorComments', 'CountryID'], 'integer'],
            [['Latitude', 'Longitude', 'tripAdvisorPoint'], 'number'],
            [['Name', 'Address', 'Web', 'TripAdvisorCode', 'CommercialName', 'TaxOffice', 'invoiceAddress', 'tripAdvisorImage', 'cancelStatusWeb'], 'string', 'max' => 255],
            [['Phone1', 'Phone2', 'Fax1', 'Fax2', 'TaxNumber', 'email'], 'string', 'max' => 150],
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
            'Place' => Yii::t('app', 'Place'),
            'HotelCategory' => Yii::t('app', 'Hotel Category'),
            'Address' => Yii::t('app', 'Address'),
            'Web' => Yii::t('app', 'Web'),
            'Latitude' => Yii::t('app', 'Latitude'),
            'Longitude' => Yii::t('app', 'Longitude'),
            'TripAdvisorCode' => Yii::t('app', 'Trip Advisor Code'),
            'GiataCode' => Yii::t('app', 'Giata Code'),
            'Phone1' => Yii::t('app', 'Phone1'),
            'Phone2' => Yii::t('app', 'Phone2'),
            'Fax1' => Yii::t('app', 'Fax1'),
            'Fax2' => Yii::t('app', 'Fax2'),
            'OperatorSaleCategory' => Yii::t('app', 'Operator Sale Category'),
            'CommercialName' => Yii::t('app', 'Commercial Name'),
            'TaxOffice' => Yii::t('app', 'Tax Office'),
            'TaxNumber' => Yii::t('app', 'Tax Number'),
            'invoiceAddress' => Yii::t('app', 'Invoice Address'),
            'email' => Yii::t('app', 'Email'),
            'tripAdvisorPoint' => Yii::t('app', 'Trip Advisor Point'),
            'tripAdvisorImage' => Yii::t('app', 'Trip Advisor Image'),
            'tripAdvisorCommentCount' => Yii::t('app', 'Trip Advisor Comment Count'),
            'cancelStatusWeb' => Yii::t('app', 'Cancel Status Web'),
            'disableOnB2C' => Yii::t('app', 'Disable On B2c'),
            'dontShowTripAdvisorComments' => Yii::t('app', 'Dont Show Trip Advisor Comments'),
            'CountryID' => Yii::t('app', 'Country ID'),
        ];
    }

    /**
     * Gets query for [[Images]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(Images::class, ['hotel_id' => 'ID']);
    }

    /**
     * Gets query for [[Tours]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTours()
    {
        return $this->hasMany(Tours::class, ['HotelID' => 'ID']);
    }
}
