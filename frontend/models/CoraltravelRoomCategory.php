<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "coraltravel_room_category".
 *
 * @property int $ID
 * @property string $Name
 * @property string|null $LName
 */
class CoraltravelRoomCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'coraltravel_room_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'Name'], 'required'],
            [['ID'], 'integer'],
            [['Name', 'LName'], 'string', 'max' => 150],
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
            'LName' => Yii::t('app', 'L Name'),
        ];
    }
}
