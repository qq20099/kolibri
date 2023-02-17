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
            [['Name', 'Address', 'Web', 'CommercialName', 'TaxOffice', 'invoiceAddress', 'tripAdvisorImage', 'TripAdvisorCode', 'cancelStatusWeb'], 'string', 'max' => 255],
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
            'Name' => Yii::t('app', 'Viesnīca'),
            'Place' => Yii::t('app', 'Place'),
            'HotelCategory' => Yii::t('app', 'Категория отеля'),
            'Address' => Yii::t('app', 'Адрес'),
            'Web' => Yii::t('app', 'Сайт'),
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

    public function getTours()
    {
        return $this->hasMany(Tours::class, ['HotelID' => 'ID']);
    }

    public function getPlace()
    {
        return $this->hasOne(CoraltravelPlace::class, ['ID' => 'Place']);
    }

    public function getImages()
    {
        return $this->hasMany(Images::class, ['hotel_id' => 'ID'])->asArray();
    }

    public function getCategory()
    {
        return $this->hasOne(CoraltravelHotelCategory::class, ['ID' => 'HotelCategory']);//->asArray();
        return $this->hasOne(CoraltravelHotelCategory::class, ['HotelCategory' => 'ID']);//->asArray();
    }

    public function getParser()
    {
        return $this->hasOne(Parser::class, ['hotel_id' => 'ID']);//->asArray();
    }

    public function getI($size = 'b')
    {
        $dir = '/uploads/hotel/'.$this->ID.'/'.$size.'/';
        $d = Yii::getAlias('@frontend/web').$dir;

        if (!is_dir($d))
          return [];

        $files = \yii\helpers\FileHelper::findFiles($d);

        return $files;
    }

    public function getMainImage($size = 'b', $f = 0)
    {
        $dir = '/uploads/hotel/'.$this->ID.'/'.$size.'/';
        $d = Yii::getAlias('@frontend/web').$dir;

        $d = Yii::getAlias('@frontend/web').$dir;

        if (!is_dir($d) && !$f)
          return '/images/_panorama-52.jpg';
        elseif (!is_dir($d) && $f)
          return '/images/637729191606480038.jpg';

        $files = \yii\helpers\FileHelper::findFiles($d);

        if ($f)
          return ($files && count($files) > 2) ? $dir.basename($files[1]) : '/images/637729191606480038.jpg';

        return ($files && count($files) > 0) ? $dir.basename($files[0]) : '/images/_panorama-52.jpg';
    }

    public function getMainImage11()
    {
        $dir = '/uploads/hotel/';
        return ($this->images[0]->title) ? $dir.$this->images[0]->title : '/images/_panorama-52.jpg';
    }

}
