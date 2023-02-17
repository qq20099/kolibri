<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "coraltravel_hotel_category".
 *
 * @property int $ID
 * @property string $Name
 * @property string $LocalName
 * @property string|null $ShortName
 *
 * @property CoraltravelHotelCathotGroupHotel[] $coraltravelHotelCathotGroupHotels
 * @property CoraltravelHotelCategoryGroup[] $groups
 */
class CoraltravelHotelCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'coraltravel_hotel_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'Name', 'LocalName'], 'required'],
            [['ID'], 'integer'],
            [['Name', 'LocalName'], 'string', 'max' => 150],
            [['ShortName'], 'string', 'max' => 50],
            [['ShortName'], 'unique'],
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
            'Name' => Yii::t('app', 'Viesnīcas kategorija'),
            'LocalName' => Yii::t('app', 'Local Name'),
            'ShortName' => Yii::t('app', 'Short Name'),
        ];
    }

    /**
     * Gets query for [[CoraltravelHotelCathotGroupHotels]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCoraltravelHotelCathotGroupHotels()
    {
        return $this->hasMany(CoraltravelHotelCathotGroupHotel::class, ['category_id' => 'ID']);
    }

    /**
     * Gets query for [[Groups]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroups()
    {
        return $this->hasMany(CoraltravelHotelCategoryGroup::class, ['ID' => 'group_id'])->viaTable('coraltravel_hotel_cathot_group_hotel', ['category_id' => 'ID']);
    }
}
