<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "hot_deals".
 *
 * @property int $id
 * @property int $FlightDate
 * @property int $HotelCheckInDate
 * @property int $AreaID
 * @property int $PlaceID
 * @property int $PackageNight
 * @property int $HotelID
 * @property int $HotelCategoryID
 * @property int $MealID
 * @property int $RoomID
 * @property int $AccID
 * @property int $Adult
 * @property int|null $Child
 * @property float $PackagePrice
 * @property int|null $FlightAllotmentStatus
 * @property int|null $BackFlightAllotmentStatus
 * @property int|null $HotelAllotmentStatus
 * @property int|null $HotelStopSaleStatus
 * @property int $ToCountryID
 * @property int $SeatClassID
 * @property int|null $SaleStatus
 * @property string|null $ChildAges
 * @property string|null $AirportRoute
 * @property float|null $PackagePriceOld
 * @property int|null $EarlyBookingEndDate
 * @property string|null $EarlyBookingText
 * @property int|null $BusinessFlightAllotmentStatus
 * @property int|null $BusinessBackFlightAllotmentStatus
 * @property int|null $HotelNight
 * @property string|null $FlightLeftAllotmentText
 * @property string|null $BackFlightLeftAllotmentText
 * @property string|null $B2BUrl
 * @property string|null $B2CUrl
 * @property int|null $PromotionStatus
 * @property int|null $main
 */
class Tours extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hot_deals';
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['FlightDate', 'HotelCheckInDate', 'AreaID', 'PlaceID', 'PackageNight', 'HotelID', 'HotelCategoryID', 'MealID', 'RoomID', 'AccID', 'Adult', 'PackagePrice', 'ToCountryID', 'SeatClassID'], 'required'],
            [['FlightDate', 'HotelCheckInDate', 'AreaID', 'PlaceID', 'PackageNight', 'HotelID', 'HotelCategoryID', 'MealID', 'RoomID', 'AccID', 'Adult', 'Child', 'FlightAllotmentStatus', 'BackFlightAllotmentStatus', 'HotelAllotmentStatus', 'HotelStopSaleStatus', 'ToCountryID', 'SeatClassID', 'SaleStatus', 'EarlyBookingEndDate', 'BusinessFlightAllotmentStatus', 'BusinessBackFlightAllotmentStatus', 'HotelNight', 'PromotionStatus', 'main', 'created_at'], 'integer'],
            [['PackagePrice', 'PackagePriceOld'], 'number'],
            [['ChildAges', 'AirportRoute'], 'string', 'max' => 150],
            [['EarlyBookingText', 'FlightLeftAllotmentText', 'BackFlightLeftAllotmentText', 'B2BUrl', 'B2CUrl'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'FlightDate' => Yii::t('app', 'Flight Date'),
            'HotelCheckInDate' => Yii::t('app', 'Hotel Check In Date'),
            'AreaID' => Yii::t('app', 'Area ID'),
            'PlaceID' => Yii::t('app', 'Place ID'),
            'PackageNight' => Yii::t('app', 'Package Night'),
            'HotelID' => Yii::t('app', 'Hotel ID'),
            'HotelCategoryID' => Yii::t('app', 'Hotel Category ID'),
            'MealID' => Yii::t('app', 'Meal ID'),
            'RoomID' => Yii::t('app', 'Room ID'),
            'AccID' => Yii::t('app', 'Acc ID'),
            'Adult' => Yii::t('app', 'Adult'),
            'Child' => Yii::t('app', 'Child'),
            'PackagePrice' => Yii::t('app', 'Package Price'),
            'FlightAllotmentStatus' => Yii::t('app', 'Flight Allotment Status'),
            'BackFlightAllotmentStatus' => Yii::t('app', 'Back Flight Allotment Status'),
            'HotelAllotmentStatus' => Yii::t('app', 'Hotel Allotment Status'),
            'HotelStopSaleStatus' => Yii::t('app', 'Hotel Stop Sale Status'),
            'ToCountryID' => Yii::t('app', 'To Country ID'),
            'SeatClassID' => Yii::t('app', 'Seat Class ID'),
            'SaleStatus' => Yii::t('app', 'Sale Status'),
            'ChildAges' => Yii::t('app', 'Child Ages'),
            'AirportRoute' => Yii::t('app', 'Airport Route'),
            'PackagePriceOld' => Yii::t('app', 'Package Price Old'),
            'EarlyBookingEndDate' => Yii::t('app', 'Early Booking End Date'),
            'EarlyBookingText' => Yii::t('app', 'Early Booking Text'),
            'BusinessFlightAllotmentStatus' => Yii::t('app', 'Business Flight Allotment Status'),
            'BusinessBackFlightAllotmentStatus' => Yii::t('app', 'Business Back Flight Allotment Status'),
            'HotelNight' => Yii::t('app', 'Hotel Night'),
            'FlightLeftAllotmentText' => Yii::t('app', 'Flight Left Allotment Text'),
            'BackFlightLeftAllotmentText' => Yii::t('app', 'Back Flight Left Allotment Text'),
            'B2BUrl' => Yii::t('app', 'B2b Url'),
            'B2CUrl' => Yii::t('app', 'B2c Url'),
            'PromotionStatus' => Yii::t('app', 'Promotion Status'),
            'main' => Yii::t('app', 'Main'),
        ];
    }
}
