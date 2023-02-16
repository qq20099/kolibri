<?php

namespace console\models;

use Yii;

/**
 * This is the model class for table "coraltravel_place".
 *
 * @property int $ID
 * @property string $Name
 * @property string $LName
 * @property int $AreaID
 * @property float|null $Latitude
 * @property float|null $Longitude
 *
 * @property CoraltravelArea $area
 * @property PlacePlace[] $placePlaces
 */
class CoraltravelPlace extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'coraltravel_place';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'Name', 'LName', 'AreaID'], 'required'],
            [['ID', 'AreaID'], 'integer'],
            [['Latitude', 'Longitude'], 'number'],
            [['Name', 'LName'], 'string', 'max' => 150],
            [['ID'], 'unique'],
            /*[['AreaID'], 'exist', 'skipOnError' => true, 'targetClass' => CoraltravelArea::class, 'targetAttribute' => ['AreaID' => 'ID']],*/
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
            'AreaID' => Yii::t('app', 'Area ID'),
            'Latitude' => Yii::t('app', 'Latitude'),
            'Longitude' => Yii::t('app', 'Longitude'),
        ];
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
     * Gets query for [[PlacePlaces]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlacePlaces()
    {
        return $this->hasMany(PlacePlace::class, ['op_place_id' => 'ID']);
    }
}
