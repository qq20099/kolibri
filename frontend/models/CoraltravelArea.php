<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "coraltravel_area".
 *
 * @property int $ID
 * @property string $Name
 * @property string $LName
 * @property int $RegionID
 *
 * @property AreaArea[] $areaAreas
 * @property CoraltravelRegion $region
 */
class CoraltravelArea extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'coraltravel_area';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'Name', 'LName', 'RegionID'], 'required'],
            [['ID', 'RegionID'], 'integer'],
            [['Name', 'LName'], 'string', 'max' => 150],
            [['ID'], 'unique'],
            [['RegionID'], 'exist', 'skipOnError' => true, 'targetClass' => CoraltravelRegion::class, 'targetAttribute' => ['RegionID' => 'ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => Yii::t('app', 'ID'),
            'Name' => Yii::t('app', 'Город'),
            'LName' => Yii::t('app', 'L Name'),
            'RegionID' => Yii::t('app', 'Region ID'),
        ];
    }

    /**
     * Gets query for [[AreaAreas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAreaAreas()
    {
        return $this->hasMany(AreaArea::class, ['op_area_id' => 'ID']);
    }

    /**
     * Gets query for [[Region]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(CoraltravelRegion::class, ['ID' => 'RegionID']);
    }

    public function getArea()
    {
        return $this->hasOne(Area::className(), ['id' => 'area_id'])
            ->viaTable(AreaArea::tableName(), ['op_area_id' => 'ID']);
    }
}
