<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "coraltravel_available_date_items".
 *
 * @property int $package_id
 * @property int $ToCountryID
 * @property int $ToAreaID
 *
 * @property CoraltravelPackageAvailableDate $package
 * @property CoraltravelArea $toArea
 * @property CoraltravelCountry $toCountry
 */
class CoraltravelAvailableDateItems extends \yii\db\ActiveRecord
{
    public $PackDate;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'coraltravel_available_date_items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['package_id', 'ToCountryID', 'ToAreaID'], 'required'],
            [['package_id', 'ToCountryID', 'ToAreaID'], 'integer'],
            [['package_id'], 'exist', 'skipOnError' => true, 'targetClass' => CoraltravelPackageAvailableDate::class, 'targetAttribute' => ['package_id' => 'id']],
            [['ToAreaID'], 'exist', 'skipOnError' => true, 'targetClass' => CoraltravelArea::class, 'targetAttribute' => ['ToAreaID' => 'ID']],
            [['ToCountryID'], 'exist', 'skipOnError' => true, 'targetClass' => CoraltravelCountry::class, 'targetAttribute' => ['ToCountryID' => 'ID']],
            [['PackDate'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'package_id' => Yii::t('app', 'Package ID'),
            'ToCountryID' => Yii::t('app', 'To Country ID'),
            'ToAreaID' => Yii::t('app', 'To Area ID'),
        ];
    }

    /**
     * Gets query for [[Package]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPackage()
    {
        return $this->hasOne(CoraltravelPackageAvailableDate::class, ['id' => 'package_id']);
    }

    /**
     * Gets query for [[ToArea]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getToArea()
    {
        return $this->hasOne(CoraltravelArea::class, ['ID' => 'ToAreaID']);
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
