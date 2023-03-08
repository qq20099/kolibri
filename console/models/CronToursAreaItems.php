<?php

namespace console\models;

use Yii;

/**
 * This is the model class for table "cron_tours_area_items".
 *
 * @property int $id
 * @property int $ToCountry
 * @property int $ToArea
 * @property int $Adult
 * @property int $Child
 * @property int $Page
 * @property int $BeginDate
 * @property int $rows
 * @property int $insert_rows
 * @property int $update_rows
 * @property int $duplicates
 * @property int|null $errors
 * @property int $cron_id
 * @property int $status
 * @property int $package_id
 * @property string|null $data
 * @property int $created_at
 * @property int $updated_at
 */
class CronToursAreaItems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cron_tours_area_items';
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
            [['ToCountry', 'ToArea', 'Adult', 'Page', 'BeginDate', 'cron_id', 'package_id'], 'required'],
            [['ToCountry', 'ToArea', 'Adult', 'Child', 'Page', 'BeginDate', 'rows', 'insert_rows', 'update_rows', 'duplicates', 'errors', 'cron_id', 'status', 'package_id', 'created_at', 'updated_at'], 'integer'],
            [['data'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ToCountry' => 'To Country',
            'ToArea' => 'To Area',
            'Adult' => 'Adult',
            'Child' => 'Child',
            'Page' => 'Page',
            'BeginDate' => 'Begin Date',
            'rows' => 'Rows',
            'insert_rows' => 'Insert Rows',
            'update_rows' => 'Update Rows',
            'duplicates' => 'Duplicates',
            'errors' => 'Errors',
            'cron_id' => 'Cron ID',
            'status' => 'Status',
            'package_id' => 'Package ID',
            'data' => 'Data',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
