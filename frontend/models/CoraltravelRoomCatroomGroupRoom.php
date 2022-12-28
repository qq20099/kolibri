<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "coraltravel_room_catroom_group_room".
 *
 * @property int $category_id
 * @property int $group_id
 */
class CoraltravelRoomCatroomGroupRoom extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'coraltravel_room_catroom_group_room';
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
}
