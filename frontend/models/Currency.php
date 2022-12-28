<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "currency".
 *
 * @property int $id
 * @property string $title
 * @property string|null $iso_code
 * @property string $code
 * @property int $activity
 */
class Currency extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'currency';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'code'], 'required'],
            [['activity'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['iso_code'], 'string', 'max' => 10],
            [['code'], 'string', 'max' => 5],
            [['code'], 'unique'],
            [['title', 'iso_code'], 'unique', 'targetAttribute' => ['title', 'iso_code']],
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
            'iso_code' => Yii::t('app', 'Iso Code'),
            'code' => Yii::t('app', 'Code'),
            'activity' => Yii::t('app', 'Activity'),
        ];
    }
}
