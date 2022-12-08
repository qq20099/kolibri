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
 */
class Hotel extends \yii\db\ActiveRecord
{
    public $raiting;
    
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
            [['title', 'description', 'year_construction', 'year_renovation', 'number_rooms', 'total_area', 'check_in', 'check_out', 'location', 'lat', 'lng', 'room_size'], 'required'],
            [['description', 'location'], 'string'],
            [['year_construction', 'year_renovation', 'number_rooms', 'total_area', 'raiting'], 'integer'],
            [['lat', 'lng'], 'number'],
            [['title', 'room_size'], 'string', 'max' => 255],
            [['check_in', 'check_out'], 'string', 'max' => 5],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('frontend', 'ID'),
            'title' => Yii::t('frontend', 'Title'),
            'description' => Yii::t('frontend', 'Description'),
            'year_construction' => Yii::t('frontend', 'Year Construction'),
            'year_renovation' => Yii::t('frontend', 'Year Renovation'),
            'number_rooms' => Yii::t('frontend', 'Number Rooms'),
            'total_area' => Yii::t('frontend', 'Total Area'),
            'check_in' => Yii::t('frontend', 'Check In'),
            'check_out' => Yii::t('frontend', 'Check Out'),
            'location' => Yii::t('frontend', 'Location'),
            'lat' => Yii::t('frontend', 'Lat'),
            'lng' => Yii::t('frontend', 'Lng'),
            'room_size' => Yii::t('frontend', 'Room Size'),
        ];
    }
}
