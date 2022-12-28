<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "hotel_category".
 *
 * @property int $id
 * @property string $title
 * @property string|null $short_title
 * @property string|null $code
 * @property int $activity
 */
class HotelCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hotel_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['activity'], 'integer'],
            [['title'], 'string', 'max' => 150],
            [['short_title', 'code'], 'string', 'max' => 50],
            [['code'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'short_title' => Yii::t('app', 'Short Title'),
            'code' => Yii::t('app', 'Code'),
            'activity' => Yii::t('app', 'Activity'),
        ];
    }
}
