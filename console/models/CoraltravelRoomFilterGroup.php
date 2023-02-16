<?php

namespace console\models;

use Yii;

/**
 * This is the model class for table "coraltravel_room_filter_group".
 *
 * @property int $ID
 * @property string $Name
 * @property int $SortOrder
 * @property int $CancelStatus
 */
class CoraltravelRoomFilterGroup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'coraltravel_room_filter_group';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'Name', 'SortOrder'], 'required'],
            [['ID', 'SortOrder', 'CancelStatus'], 'integer'],
            [['Name'], 'string', 'max' => 150],
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
            'SortOrder' => Yii::t('app', 'Sort Order'),
            'CancelStatus' => Yii::t('app', 'Cancel Status'),
        ];
    }
}
