<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "coraltravel_package_available_date".
 *
 * @property int $id
 * @property int $FromArea
 * @property int $PackageDate
 *
 * @property CoraltravelAvailableDateItems[] $coraltravelAvailableDateItems
 */
class CoraltravelPackageAvailableDate extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'coraltravel_package_available_date';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['FromArea', 'PackageDate', 'PackageDateSource'], 'required'],
            [['FromArea', 'PackageDate'], 'integer'],
            [['PackageDateSource'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'FromArea' => Yii::t('app', 'From Area'),
            'PackageDate' => Yii::t('app', 'Package Date'),
        ];
    }

    /**
     * Gets query for [[CoraltravelAvailableDateItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCoraltravelAvailableDateItems()
    {
        //return $this->hasOne(CoraltravelAvailableDateItems::class, ['package_id' => 'id']);
        return $this->hasMany(CoraltravelAvailableDateItems::class, ['package_id' => 'id']);
    }

    public function getTours()
    {
        return $this->hasMany(Tours::class, ['FlightDate' => 'PackageDate']);
    }

}
