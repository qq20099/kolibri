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

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    \yii\db\ActiveRecord::EVENT_BEFORE_UPDATE => ['created_at', 'updated_at'],
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
            [['FlightDate', 'HotelCheckInDate', 'AreaID', 'PackageNight', 'HotelID', 'MealID', 'RoomID', 'AccID', 'Adult', 'PackagePrice', 'ToCountryID', 'SeatClassID'], 'required'],
            [['FlightDate', 'HotelCheckInDate', 'AreaID', 'PackageNight', 'HotelID', 'MealID', 'RoomID', 'AccID', 'Adult', 'Child', 'FlightAllotmentStatus', 'BackFlightAllotmentStatus', 'HotelAllotmentStatus', 'HotelStopSaleStatus', 'ToCountryID', 'SeatClassID', 'SaleStatus', 'EarlyBookingEndDate', 'BusinessFlightAllotmentStatus', 'BusinessBackFlightAllotmentStatus', 'HotelNight', 'PromotionStatus', 'main', 'created_at', 'updated_at', 'activity'], 'integer'],
            [['PackagePrice', 'PackagePriceOld'], 'number'],
            [['FlightDateSource', 'HotelCheckInDateSource'], 'string', 'max' => 20],
            [['ChildAges', 'AirportRoute'], 'string', 'max' => 150],
            [['EarlyBookingText', 'FlightLeftAllotmentText', 'BackFlightLeftAllotmentText', 'B2BUrl', 'B2CUrl'], 'string', 'max' => 255],
            //[['AccID'], 'exist', 'skipOnError' => true, 'targetClass' => CoraltravelAcc::class, 'targetAttribute' => ['AccID' => 'ID']],
            //[['AreaID'], 'exist', 'skipOnError' => true, 'targetClass' => CoraltravelArea::class, 'targetAttribute' => ['AreaID' => 'ID']],
            //[['HotelCategoryID'], 'exist', 'skipOnError' => true, 'targetClass' => CoraltravelHotelCategory::class, 'targetAttribute' => ['HotelCategoryID' => 'ID']],
            //[['HotelID'], 'exist', 'skipOnError' => true, 'targetClass' => CoraltravelHotel::class, 'targetAttribute' => ['HotelID' => 'ID']],
            //[['MealID'], 'exist', 'skipOnError' => true, 'targetClass' => CoraltravelMeal::class, 'targetAttribute' => ['MealID' => 'ID']],
            //[['PlaceID'], 'exist', 'skipOnError' => true, 'targetClass' => CoraltravelPlace::class, 'targetAttribute' => ['PlaceID' => 'ID']],
            //[['RoomID'], 'exist', 'skipOnError' => true, 'targetClass' => CoraltravelRoom::class, 'targetAttribute' => ['RoomID' => 'ID']],
            //[['SeatClassID'], 'exist', 'skipOnError' => true, 'targetClass' => CoraltravelSeatClass::class, 'targetAttribute' => ['SeatClassID' => 'ID']],
            //[['ToCountryID'], 'exist', 'skipOnError' => true, 'targetClass' => CoraltravelCountry::class, 'targetAttribute' => ['ToCountryID' => 'ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'FlightDate' => Yii::t('app', 'Izlidošanas datums'),
            'HotelCheckInDate' => Yii::t('app', 'Reģistrēšanās datums'),
            'AreaID' => Yii::t('app', 'Area ID'),
            'PlaceID' => Yii::t('app', 'Place ID'),
            'PackageNight' => Yii::t('app', 'Ночей'),
            'HotelID' => Yii::t('app', 'Hotel ID'),
            'HotelCategoryID' => Yii::t('app', 'Hotel Category ID'),
            'MealID' => Yii::t('app', 'Meal ID'),
            'RoomID' => Yii::t('app', 'Room ID'),
            'AccID' => Yii::t('app', 'Acc ID'),
            'Adult' => Yii::t('app', 'Pieaugušo skaits'),
            'Child' => Yii::t('app', 'Количество детей'),
            'PackagePrice' => Yii::t('app', 'Cena'),
            'FlightAllotmentStatus' => Yii::t('app', 'Flight Allotment Status'),
            'BackFlightAllotmentStatus' => Yii::t('app', 'Back Flight Allotment Status'),
            'HotelAllotmentStatus' => Yii::t('app', 'Hotel Allotment Status'),
            'HotelStopSaleStatus' => Yii::t('app', 'Hotel Stop Sale Status'),
            'ToCountryID' => Yii::t('app', 'To Country ID'),
            'SeatClassID' => Yii::t('app', 'Seat Class ID'),
            'SaleStatus' => Yii::t('app', 'Sale Status'),
            'ChildAges' => Yii::t('app', 'Возраст детей'),
            'AirportRoute' => Yii::t('app', 'Airport Route'),
            'PackagePriceOld' => Yii::t('app', 'Стоимость без скидки'),
            'EarlyBookingEndDate' => Yii::t('app', 'Early Booking End Date'),
            'EarlyBookingText' => Yii::t('app', 'Early Booking Text'),
            'BusinessFlightAllotmentStatus' => Yii::t('app', 'Business Flight Allotment Status'),
            'BusinessBackFlightAllotmentStatus' => Yii::t('app', 'Business Back Flight Allotment Status'),
            'HotelNight' => Yii::t('app', 'Ночей в отеле'),
            'FlightLeftAllotmentText' => Yii::t('app', 'Flight Left Allotment Text'),
            'BackFlightLeftAllotmentText' => Yii::t('app', 'Back Flight Left Allotment Text'),
            'B2BUrl' => Yii::t('app', 'B2b Url'),
            'B2CUrl' => Yii::t('app', 'B2c Url'),
            'PromotionStatus' => Yii::t('app', 'Promotion Status'),
            'main' => Yii::t('app', 'Main'),
            'created_at' => Yii::t('app', 'Created At'),
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

    public function getGeography()
    {
        return $this->hasOne(CoraltravelGeography::class, ['AreaID' => 'AreaID']);
    }

    public function getMainImage()
    {
        $path = '/uploads/hotel/';
        return ($this->images[0]->title) ? $path.$this->images[0]->title : '/images/_panorama-52.jpg';
    }

    public function getRelatedTours($t = false)
    {
        $q = self::find()
        ->where(['HotelID' => $this->HotelID])
        ->andWhere(['!=', 'id', $this->id])
        ->andWhere(['=', 'FlightDate', $this->FlightDate]);
        $q->andFilterWhere(['Adult' => $this->Adult]);
        $q->andFilterWhere(['Child' => $this->Child]);
        //$q->with(['room']);
        //$q->groupBy(['Child', 'Adult']);
        //$q->groupBy(['RoomID', 'MealID', 'Adult']);
        $q->groupBy(['RoomID', 'MealID']);
        $q->orderBy('PackagePrice');

        if (!$t) {
            return $q->all();
        }

        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $q,
            'sort'=> [
                'defaultOrder' => [
                    //'FlightDate' => SORT_DESC
                    'PackagePrice' => SORT_ASC
                ]
            ],
            'pagination' => [
                'pageSize' => 18,
            ],
        ]);

        return $dataProvider;
        /*echo "<br>-------------<br>";
        echo "<pre>";
        print_r($q->count());
        print_r($q->all());
        echo "</pre>";
        echo "<br>-------------<br>";*/

    }

}
