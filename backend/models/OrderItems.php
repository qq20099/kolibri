<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "order_items".
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
 * @property string $FlightDateSource
 * @property string $HotelCheckInDateSource
 * @property int|null $main
 * @property int $order_id
 * @property int $created_at
 */
class OrderItems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['FlightDate', 'HotelCheckInDate', 'AreaID', 'PlaceID', 'PackageNight', 'HotelID', 'HotelCategoryID', 'MealID', 'RoomID', 'AccID', 'Adult', 'PackagePrice', 'ToCountryID', 'SeatClassID', 'FlightDateSource', 'HotelCheckInDateSource', 'order_id', 'created_at'], 'required'],
            [['FlightDate', 'HotelCheckInDate', 'AreaID', 'PlaceID', 'PackageNight', 'HotelID', 'HotelCategoryID', 'MealID', 'RoomID', 'AccID', 'Adult', 'Child', 'FlightAllotmentStatus', 'BackFlightAllotmentStatus', 'HotelAllotmentStatus', 'HotelStopSaleStatus', 'ToCountryID', 'SeatClassID', 'SaleStatus', 'EarlyBookingEndDate', 'BusinessFlightAllotmentStatus', 'BusinessBackFlightAllotmentStatus', 'HotelNight', 'PromotionStatus', 'main', 'order_id', 'created_at'], 'integer'],
            [['PackagePrice', 'PackagePriceOld'], 'number'],
            [['ChildAges', 'AirportRoute'], 'string', 'max' => 150],
            [['EarlyBookingText', 'FlightLeftAllotmentText', 'BackFlightLeftAllotmentText', 'B2BUrl', 'B2CUrl'], 'string', 'max' => 255],
            [['FlightDateSource', 'HotelCheckInDateSource'], 'string', 'max' => 20],
            [['FlightDate', 'AreaID', 'HotelNight', 'HotelID', 'MealID', 'RoomID', 'AccID', 'ToCountryID', 'SeatClassID', 'PackagePrice', 'Adult', 'Child'], 'unique', 'targetAttribute' => ['FlightDate', 'AreaID', 'HotelNight', 'HotelID', 'MealID', 'RoomID', 'AccID', 'ToCountryID', 'SeatClassID', 'PackagePrice', 'Adult', 'Child']],
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
            'HotelCategoryID' => 'Hotel Category ID',
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
            'order_id' => 'Order ID',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Acc]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAcc()
    {
        return $this->hasOne(CoraltravelAcc::class, ['ID' => 'AccID']);
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
     * Gets query for [[Hotel]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHotel()
    {
        return $this->hasOne(CoraltravelHotel::class, ['ID' => 'HotelID']);
    }

    /**
     * Gets query for [[HotelCategory]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHotelCategory()
    {
        return $this->hasOne(CoraltravelHotelCategory::class, ['ID' => 'HotelCategoryID']);
    }

    /**
     * Gets query for [[Meal]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMeal()
    {
        return $this->hasOne(CoraltravelMeal::class, ['ID' => 'MealID']);
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
     * Gets query for [[Room]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRoom()
    {
        return $this->hasOne(CoraltravelRoom::class, ['ID' => 'RoomID']);
    }

    /**
     * Gets query for [[SeatClass]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSeatClass()
    {
        return $this->hasOne(CoraltravelSeatClass::class, ['ID' => 'SeatClassID']);
    }

    /**
     * Gets query for [[ToCountry]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getToCountry()
    {
        return $this->hasOne(CoraltravelCountry::class, ['ID' => 'ToCountryID']);
    }    
}
