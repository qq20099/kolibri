<?php

namespace console\models;

use Yii;

/**
 * This is the model class for table "coraltravel_hotel_cathot_group_hotel".
 *
 * @property int $category_id
 * @property int $group_id
 *
 * @property CoraltravelHotelCategory $category
 * @property CoraltravelHotelCategoryGroup $group
 */
class CoraltravelHotelCathotGroupHotel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'coraltravel_hotel_cathot_group_hotel';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'group_id'], 'required'],
            [['category_id', 'group_id'], 'integer'],
            [['category_id', 'group_id'], 'unique', 'targetAttribute' => ['category_id', 'group_id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => CoraltravelHotelCategory::class, 'targetAttribute' => ['category_id' => 'ID']],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => CoraltravelHotelCategoryGroup::class, 'targetAttribute' => ['group_id' => 'ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'category_id' => Yii::t('app', 'Category ID'),
            'group_id' => Yii::t('app', 'Group ID'),
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(CoraltravelHotelCategory::class, ['ID' => 'category_id']);
    }

    /**
     * Gets query for [[Group]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(CoraltravelHotelCategoryGroup::class, ['ID' => 'group_id']);
    }
}
