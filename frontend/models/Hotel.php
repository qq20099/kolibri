<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "hotel".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $year_construction
 * @property int $year_renovation
 * @property int $number_rooms
 * @property int $total_area
 * @property string $check_in
 * @property string $check_out
 * @property string $location
 * @property float $lat
 * @property float $lng
 * @property string $room_size
 * @property int $location_id
 *
 * @property HotelNumber[] $hotelNumbers
 * @property Images[] $images
 * @property Location $location0
 * @property Raiting[] $raitings
 * @property Ticket[] $tickets
 */
class Hotel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hotel';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description', 'year_construction', 'year_renovation', 'number_rooms', 'total_area', 'check_in', 'check_out', 'location', 'lat', 'lng', 'room_size', 'location_id'], 'required'],
            [['description', 'location'], 'string'],
            [['year_construction', 'year_renovation', 'number_rooms', 'total_area', 'location_id'], 'integer'],
            [['lat', 'lng'], 'number'],
            [['title', 'room_size'], 'string', 'max' => 255],
            [['check_in', 'check_out'], 'string', 'max' => 5],
            [['location_id'], 'exist', 'skipOnError' => true, 'targetClass' => Location::class, 'targetAttribute' => ['location_id' => 'id']],
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
            'description' => Yii::t('app', 'Description'),
            'year_construction' => Yii::t('app', 'Year Construction'),
            'year_renovation' => Yii::t('app', 'Year Renovation'),
            'number_rooms' => Yii::t('app', 'Number Rooms'),
            'total_area' => Yii::t('app', 'Total Area'),
            'check_in' => Yii::t('app', 'Check In'),
            'check_out' => Yii::t('app', 'Check Out'),
            'location' => Yii::t('app', 'Location'),
            'lat' => Yii::t('app', 'Lat'),
            'lng' => Yii::t('app', 'Lng'),
            'room_size' => Yii::t('app', 'Room Size'),
            'location_id' => Yii::t('app', 'Location ID'),
        ];
    }

    /**
     * Gets query for [[HotelNumbers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHotelNumbers()
    {
        return $this->hasMany(HotelNumber::class, ['hotel_id' => 'id']);
    }

    /**
     * Gets query for [[Images]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(Images::class, ['hotel_id' => 'id']);
    }

    /**
     * Gets query for [[Location0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLocation0()
    {
        return $this->hasOne(Location::class, ['id' => 'location_id']);
    }

    /**
     * Gets query for [[Raitings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRaitings()
    {
        return $this->hasMany(Raiting::class, ['hotel_id' => 'id']);
    }

    /**
     * Gets query for [[Tickets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTickets()
    {
        return $this->hasMany(Ticket::class, ['hotel_id' => 'id']);
    }

    public function raiting()
    {
        return $this->getRaitings()->average('value');
    }

    public function getMainImage()
    {
        $path = '/uploads/hotel/';
        return ($this->images[0]->title) ? $path.$this->images[0]->title : '/images/_panorama-52.jpg';
    }
}
