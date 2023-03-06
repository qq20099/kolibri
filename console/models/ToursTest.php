<?php

namespace console\models;

use Yii;

/**
 * This is the model class for table "tours_test".
 *
 * @property int $id
 * @property int $FlightDate
 * @property int $HotelCheckInDate
 * @property int $AreaID
 * @property int $PlaceID
 * @property int $PackageNight
 * @property int $HotelID
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
 * @property string $FlightDateSource
 * @property string $HotelCheckInDateSource
 * @property int|null $main
 * @property int $activity
 * @property int $created_at
 */
class ToursTest extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tours_test';
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
            [['FlightDate', 'HotelCheckInDate', 'AreaID', 'PackageNight', 'HotelID', 'MealID', 'RoomID', 'AccID', 'Adult', 'PackagePrice', 'ToCountryID', 'SeatClassID', 'FlightDateSource', 'HotelCheckInDateSource'], 'required'],
            [['FlightDate', 'HotelCheckInDate', 'AreaID', 'PlaceID', 'PackageNight', 'HotelID', 'MealID', 'RoomID', 'AccID', 'Adult', 'Child', 'FlightAllotmentStatus', 'BackFlightAllotmentStatus', 'HotelAllotmentStatus', 'HotelStopSaleStatus', 'ToCountryID', 'SeatClassID', 'SaleStatus', 'EarlyBookingEndDate', 'BusinessFlightAllotmentStatus', 'BusinessBackFlightAllotmentStatus', 'HotelNight', 'PromotionStatus', 'main', 'activity', 'created_at', 'parent_id'], 'integer'],
            [['PackagePrice', 'PackagePriceOld'], 'number'],
            [['ChildAges', 'AirportRoute'], 'string', 'max' => 150],
            [['EarlyBookingText', 'FlightLeftAllotmentText', 'BackFlightLeftAllotmentText', 'B2BUrl', 'B2CUrl'], 'string', 'max' => 255],
            [['FlightDateSource', 'HotelCheckInDateSource'], 'string', 'max' => 20],
            [['params'], 'string'],
            //[['FlightDate', 'AreaID', 'HotelNight', 'HotelID', 'MealID', 'RoomID', 'AccID', 'ToCountryID', 'SeatClassID', 'PackagePrice', 'Adult', 'Child'], 'unique', 'targetAttribute' => ['FlightDate', 'AreaID', 'HotelNight', 'HotelID', 'MealID', 'RoomID', 'AccID', 'ToCountryID', 'SeatClassID', 'PackagePrice', 'Adult', 'Child']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'FlightDate' => 'Flight Date',
            'HotelCheckInDate' => 'Hotel Check In Date',
            'AreaID' => 'Area ID',
            'PlaceID' => 'Place ID',
            'PackageNight' => 'Package Night',
            'HotelID' => 'Hotel ID',
            'MealID' => 'Meal ID',
            'RoomID' => 'Room ID',
            'AccID' => 'Acc ID',
            'Adult' => 'Adult',
            'Child' => 'Child',
            'PackagePrice' => 'Package Price',
            'FlightAllotmentStatus' => 'Flight Allotment Status',
            'BackFlightAllotmentStatus' => 'Back Flight Allotment Status',
            'HotelAllotmentStatus' => 'Hotel Allotment Status',
            'HotelStopSaleStatus' => 'Hotel Stop Sale Status',
            'ToCountryID' => 'To Country ID',
            'SeatClassID' => 'Seat Class ID',
            'SaleStatus' => 'Sale Status',
            'ChildAges' => 'Child Ages',
            'AirportRoute' => 'Airport Route',
            'PackagePriceOld' => 'Package Price Old',
            'EarlyBookingEndDate' => 'Early Booking End Date',
            'EarlyBookingText' => 'Early Booking Text',
            'BusinessFlightAllotmentStatus' => 'Business Flight Allotment Status',
            'BusinessBackFlightAllotmentStatus' => 'Business Back Flight Allotment Status',
            'HotelNight' => 'Hotel Night',
            'FlightLeftAllotmentText' => 'Flight Left Allotment Text',
            'BackFlightLeftAllotmentText' => 'Back Flight Left Allotment Text',
            'B2BUrl' => 'B2b Url',
            'B2CUrl' => 'B2c Url',
            'PromotionStatus' => 'Promotion Status',
            'FlightDateSource' => 'Flight Date Source',
            'HotelCheckInDateSource' => 'Hotel Check In Date Source',
            'main' => 'Main',
            'activity' => 'Activity',
            'created_at' => 'Created At',
        ];
    }
}
