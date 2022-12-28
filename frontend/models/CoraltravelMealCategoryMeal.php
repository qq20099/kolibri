<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "coraltravel_meal_category_meal".
 *
 * @property int $category_id
 * @property int $meal_id
 */
class CoraltravelMealCategoryMeal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'coraltravel_meal_category_meal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'meal_id'], 'required'],
            [['category_id', 'meal_id'], 'integer'],
            [['category_id', 'meal_id'], 'unique', 'targetAttribute' => ['category_id', 'meal_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'category_id' => Yii::t('app', 'Category ID'),
            'meal_id' => Yii::t('app', 'Meal ID'),
        ];
    }
}
