<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "coraltravel_airport".
 *
 * @property int $ID
 * @property string $Name
 * @property string|null $LName
 * @property string|null $Sname
 * @property int $CancelStatus
 * @property int $PlaceID
 * @property int $AreaID
 * @property int $RegionID
 * @property int $CountryID
 * @property string|null $AreaNameV
 * @property int|null $TransportType
 */
class CoraltravelAirport extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'coraltravel_airport';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'Name', 'PlaceID', 'AreaID', 'RegionID', 'CountryID'], 'required'],
            [['ID', 'CancelStatus', 'PlaceID', 'AreaID', 'RegionID', 'CountryID', 'TransportType'], 'integer'],
            [['Name', 'LName', 'Sname', 'AreaNameV'], 'string', 'max' => 150],
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
            'LName' => Yii::t('app', 'L Name'),
            'Sname' => Yii::t('app', 'Sname'),
            'CancelStatus' => Yii::t('app', 'Cancel Status'),
            'PlaceID' => Yii::t('app', 'Place ID'),
            'AreaID' => Yii::t('app', 'Area ID'),
            'RegionID' => Yii::t('app', 'Region ID'),
            'CountryID' => Yii::t('app', 'Country ID'),
            'AreaNameV' => Yii::t('app', 'Area Name V'),
            'TransportType' => Yii::t('app', 'Transport Type'),
        ];
    }
}
