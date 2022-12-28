<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "hotel_category_hotel".
 *
 * @property int $category_id
 * @property int $op_category_id
 * @property string $operator
 */
class HotelCategoryHotel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hotel_category_hotel';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'op_category_id', 'operator'], 'required'],
            [['category_id', 'op_category_id'], 'integer'],
            [['operator'], 'string', 'max' => 20],
            [['category_id', 'op_category_id', 'operator'], 'unique', 'targetAttribute' => ['category_id', 'op_category_id', 'operator']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'category_id' => Yii::t('app', 'Category ID'),
            'op_category_id' => Yii::t('app', 'Op Category ID'),
            'operator' => Yii::t('app', 'Operator'),
        ];
    }
}
