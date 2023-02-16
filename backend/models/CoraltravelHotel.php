<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
//use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;

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
 * @property int|null $TripAdvisorCode
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
 */
class CoraltravelHotel extends \yii\db\ActiveRecord
{
    public $path_img;
    public $path_img_t;
    public $path_img_thumbs;
    public $path_img_big;
    public $delimg;
    public $m_img;
    public $HotelImages;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'coraltravel_hotel';
    }

    public function init()
    {
        parent::init();
        //$this->path_img = '/uploads/hotel/{ID}/t/thumb_';
        $this->path_img = '/uploads/hotel/{ID}/';
        $this->path_img_thumbs = $this->path_img.'t/';
        $this->path_img_big = $this->path_img.'b/';
        $this->path_img_t = $this->path_img_thumbs.'thumb_';
    }

/*public function behaviors()
{
    return [
        TimestampBehavior::className(),
        'saveRelations' => [
            'class'     => SaveRelationsBehavior::className(),
            'relations' => [
                'images',
            ],
        ],
    ];
}

public function transactions()
{
    return [
        self::SCENARIO_DEFAULT => self::OP_ALL,
    ];
}*/
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'Name', 'Place', 'HotelCategory'], 'required'],
            [['ID', 'Place', 'HotelCategory', 'GiataCode', 'OperatorSaleCategory', 'tripAdvisorCommentCount', 'disableOnB2C', 'dontShowTripAdvisorComments', 'CountryID'], 'integer'],
            [['Latitude', 'Longitude', 'tripAdvisorPoint'], 'number'],
            [['Name', 'Address', 'Web', 'CommercialName', 'TaxOffice', 'invoiceAddress', 'tripAdvisorImage', 'TripAdvisorCode', 'cancelStatusWeb', 'maplink'], 'string', 'max' => 255],
            [['description'], 'string'],
            [['Phone1', 'Phone2', 'Fax1', 'Fax2', 'TaxNumber', 'email'], 'string', 'max' => 150],
            [['ID'], 'unique'],
            [['delimg', 'm_img', 'HotelImages'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => Yii::t('app', 'ID'),
            'Name' => Yii::t('app', 'Отель'),
            'description' => Yii::t('app', 'Описание'),
            'maplink' => Yii::t('app', 'Ссылка на карту'),
            'Place' => Yii::t('app', 'Place'),
            'HotelCategory' => Yii::t('app', 'Категория отеля'),
            'Address' => Yii::t('app', 'Адрес'),
            'Web' => Yii::t('app', 'Web'),
            'Latitude' => Yii::t('app', 'Latitude'),
            'Longitude' => Yii::t('app', 'Longitude'),
            'TripAdvisorCode' => Yii::t('app', 'Trip Advisor Code'),
            'GiataCode' => Yii::t('app', 'Giata Code'),
            'Phone1' => Yii::t('app', 'Телефон'),
            'Phone2' => Yii::t('app', 'Телефон'),
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

    public function getPlace()
    {
        return $this->hasOne(CoraltravelPlace::class, ['ID' => 'Place']);
    }

    public function getHotelCategory()
    {
        return $this->hasOne(CoraltravelHotelCategory::class, ['ID' => 'HotelCategory']);
    }

    public function getMainImg()
    {
        return $this->hasOne(Images::class, ['hotel_id' => 'ID'])->where(['main' => 1]);
    }

    public function getImages()
    {
        return $this->hasMany(Images::class, ['hotel_id' => 'ID']);
    }

    public function getMainImage()
    {
        $path = '/uploads/hotel/';
        return ($this->images[0]->title) ? $path.$this->images[0]->title : '/images/_panorama-52.jpg';
    }
}
