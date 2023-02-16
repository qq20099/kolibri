<?php

namespace console\models;

use Yii;

/**
 * This is the model class for table "cron_tours_items".
 *
 * @property int $id
 * @property int $ToCountryID
 * @property int $ToAreaID
 * @property int $Adult
 * @property int $Child
 * @property int $Page
 * @property int $PackageDate
 * @property int $rows
 * @property int $cron_id
 * @property int $status
 *
 * @property CronTours $cron
 */
class CronToursItems extends \yii\db\ActiveRecord
{
    const STATUS_START = 0;
    const STATUS_SUCCESS = 1;    
    const STATUS_ERROR = 4;
    const STATUS_END = 9;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cron_tours_items';
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    \yii\db\ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
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
            [['ToCountry', 'ToArea', 'Adult', 'Page', 'BeginDate', 'cron_id'], 'required'],
            [['ToCountry', 'ToArea', 'Adult', 'Child', 'Page', 'BeginDate', 'rows', 'insert_rows', 'update_rows', 'duplicates', 'cron_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['errors'], 'string'],
            [['cron_id'], 'exist', 'skipOnError' => true, 'targetClass' => CronTours::class, 'targetAttribute' => ['cron_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'ToCountryID' => Yii::t('app', 'To Country ID'),
            'ToAreaID' => Yii::t('app', 'To Area ID'),
            'Adult' => Yii::t('app', 'Adult'),
            'Child' => Yii::t('app', 'Child'),
            'Page' => Yii::t('app', 'Page'),
            'PackageDate' => Yii::t('app', 'Package Date'),
            'rows' => Yii::t('app', 'Rows'),
            'cron_id' => Yii::t('app', 'Cron ID'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * Gets query for [[Cron]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCron()
    {
        return $this->hasOne(CronTours::class, ['id' => 'cron_id']);
    }
}
