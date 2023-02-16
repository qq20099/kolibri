<?php

namespace console\models;

use Yii;

/**
 * This is the model class for table "coraltravel_hotel_category_group".
 *
 * @property int $ID
 * @property string $Name
 * @property string|null $SName
 *
 * @property CoraltravelHotelCategory[] $categories
 * @property CoraltravelHotelCathotGroupHotel[] $coraltravelHotelCathotGroupHotels
 */
class CoraltravelHotelCategoryGroup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'coraltravel_hotel_category_group';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'Name'], 'required'],
            [['ID'], 'integer'],
            [['Name'], 'string', 'max' => 150],
            [['SName'], 'string', 'max' => 50],
            [['SName'], 'unique'],
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
            'SName' => Yii::t('app', 'S Name'),
        ];
    }

    /**
     * Gets query for [[Categories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(CoraltravelHotelCategory::class, ['ID' => 'category_id'])->viaTable('coraltravel_hotel_cathot_group_hotel', ['group_id' => 'ID']);
    }

    /**
     * Gets query for [[CoraltravelHotelCathotGroupHotels]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCoraltravelHotelCathotGroupHotels()
    {
        return $this->hasMany(CoraltravelHotelCathotGroupHotel::class, ['group_id' => 'ID']);
    }
}
