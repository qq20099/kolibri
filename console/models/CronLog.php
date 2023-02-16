<?php

namespace console\models;

use Yii;

/**
 * This is the model class for table "region".
 *
 * @property int $id
 * @property string $title
 * @property int $country_id
 * @property int $activity
 *
 * @property RegionRegion[] $regionRegions
 */
class CronLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cron_log';
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ],
            ],
        ];
    }
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['errors', 'data'], 'string'],
            [['type'], 'string', 'max' => 100],
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
            'country_id' => Yii::t('app', 'Country ID'),
            'activity' => Yii::t('app', 'Activity'),
        ];
    }

    /**
     * Gets query for [[RegionRegions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public static function add($data)
    {
        $log = new CronLog();
        $log->attributes = $data;
        $log->save();
    }
}
