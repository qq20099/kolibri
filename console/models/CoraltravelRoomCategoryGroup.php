<?php

namespace console\models;

use Yii;

/**
 * This is the model class for table "coraltravel_room_category_group".
 *
 * @property int $ID
 * @property string $Name
 * @property string|null $SName
 */
class CoraltravelRoomCategoryGroup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'coraltravel_room_category_group';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'Name'], 'required'],
            [['ID'], 'integer'],
            [['Name', 'SName'], 'string', 'max' => 150],
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
            'SName' => Yii::t('app', 'S Name'),
        ];
    }
}
