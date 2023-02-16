<?php

namespace backend\models;

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
 * @property int $created_at
 *
 * @property CoraltravelAcc $acc
 * @property CoraltravelArea $area
 * @property CoraltravelHotel $hotel
 * @property CoraltravelHotelCategory $hotelCategory
 * @property CoraltravelMeal $meal
 * @property CoraltravelPlace $place
 * @property CoraltravelRoom $room
 * @property CoraltravelSeatClass $seatClass
 * @property CoraltravelCountry $toCountry
 */
class Tours extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tours';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['FlightDate', 'HotelCheckInDate', 'AreaID', 'PlaceID', 'PackageNight', 'HotelID', 'HotelCategoryID', 'MealID', 'RoomID', 'AccID', 'Adult', 'PackagePrice', 'ToCountryID', 'SeatClassID', 'created_at'], 'required'],
            [['FlightDate', 'HotelCheckInDate', 'AreaID', 'PlaceID', 'PackageNight', 'HotelID', 'HotelCategoryID', 'MealID', 'RoomID', 'AccID', 'Adult', 'Child', 'FlightAllotmentStatus', 'BackFlightAllotmentStatus', 'HotelAllotmentStatus', 'HotelStopSaleStatus', 'ToCountryID', 'SeatClassID', 'SaleStatus', 'EarlyBookingEndDate', 'BusinessFlightAllotmentStatus', 'BusinessBackFlightAllotmentStatus', 'HotelNight', 'PromotionStatus', 'main', 'created_at'], 'integer'],
            [['PackagePrice', 'PackagePriceOld'], 'number'],
            [['ChildAges', 'AirportRoute'], 'string', 'max' => 150],
            [['EarlyBookingText', 'FlightLeftAllotmentText', 'BackFlightLeftAllotmentText', 'B2BUrl', 'B2CUrl'], 'string', 'max' => 255],
            [['FlightDate', 'AreaID', 'PlaceID', 'PackageNight', 'HotelID', 'MealID', 'RoomID', 'AccID', 'ToCountryID', 'SeatClassID'], 'unique', 'targetAttribute' => ['FlightDate', 'AreaID', 'PlaceID', 'PackageNight', 'HotelID', 'MealID', 'RoomID', 'AccID', 'ToCountryID', 'SeatClassID']],
            [['AccID'], 'exist', 'skipOnError' => true, 'targetClass' => CoraltravelAcc::class, 'targetAttribute' => ['AccID' => 'ID']],
            [['AreaID'], 'exist', 'skipOnError' => true, 'targetClass' => CoraltravelArea::class, 'targetAttribute' => ['AreaID' => 'ID']],
            [['HotelCategoryID'], 'exist', 'skipOnError' => true, 'targetClass' => CoraltravelHotelCategory::class, 'targetAttribute' => ['HotelCategoryID' => 'ID']],
            [['HotelID'], 'exist', 'skipOnError' => true, 'targetClass' => CoraltravelHotel::class, 'targetAttribute' => ['HotelID' => 'ID']],
            [['MealID'], 'exist', 'skipOnError' => true, 'targetClass' => CoraltravelMeal::class, 'targetAttribute' => ['MealID' => 'ID']],
            [['PlaceID'], 'exist', 'skipOnError' => true, 'targetClass' => CoraltravelPlace::class, 'targetAttribute' => ['PlaceID' => 'ID']],
            [['RoomID'], 'exist', 'skipOnError' => true, 'targetClass' => CoraltravelRoom::class, 'targetAttribute' => ['RoomID' => 'ID']],
            [['SeatClassID'], 'exist', 'skipOnError' => true, 'targetClass' => CoraltravelSeatClass::class, 'targetAttribute' => ['SeatClassID' => 'ID']],
            [['ToCountryID'], 'exist', 'skipOnError' => true, 'targetClass' => CoraltravelCountry::class, 'targetAttribute' => ['ToCountryID' => 'ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'FlightDate' => Yii::t('app', 'Дата вылета'),
            'HotelCheckInDate' => Yii::t('app', 'Дата заселения'),
            'AreaID' => 'Area ID',
            'PlaceID' => 'Place ID',
            'PackageNight' => 'К-во ночей',
            'HotelID' => 'Hotel ID',
            'HotelCategoryID' => 'Hotel Category ID',
            'MealID' => 'Meal ID',
            'RoomID' => 'Room ID',
            'AccID' => 'Acc ID',
            'Adult' => 'Adult',
            'Child' => 'Child',
            'PackagePrice' => 'Цена',
            'FlightAllotmentStatus' => 'Flight Allotment Status',
            'BackFlightAllotmentStatus' => 'Back Flight Allotment Status',
            'HotelAllotmentStatus' => 'Hotel Allotment Status',
            'HotelStopSaleStatus' => 'Hotel Stop Sale Status',
            'ToCountryID' => 'To Country ID',
            'SeatClassID' => 'Seat Class ID',
            'SaleStatus' => 'Sale Status',
            'ChildAges' => 'Возраст детей',
            'AirportRoute' => 'Airport Route',
            'PackagePriceOld' => 'Цена без скидки',
            'EarlyBookingEndDate' => 'Early Booking End Date',
            'EarlyBookingText' => 'Early Booking Text',
            'BusinessFlightAllotmentStatus' => 'Business Flight Allotment Status',
            'BusinessBackFlightAllotmentStatus' => 'Business Back Flight Allotment Status',
            'HotelNight' => 'К-во ночей',
            'FlightLeftAllotmentText' => 'Flight Left Allotment Text',
            'BackFlightLeftAllotmentText' => 'Back Flight Left Allotment Text',
            'B2BUrl' => 'B2b Url',
            'B2CUrl' => 'B2c Url',
            'PromotionStatus' => 'Promotion Status',
            'main' => 'Main',
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
