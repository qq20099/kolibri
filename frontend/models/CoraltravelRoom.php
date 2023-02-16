<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "coraltravel_room".
 *
 * @property int $ID
 * @property string $Name
 * @property string|null $LName
 * @property int $CategoryID
 * @property string $RoomCode
 * @property int $Hotel
 * @property int|null $isIRO
 */
class CoraltravelRoom extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'coraltravel_room';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'Name', 'CategoryID'], 'required'],
            [['ID', 'CategoryID', 'Hotel', 'isIRO'], 'integer'],
            [['Name', 'LName'], 'string', 'max' => 150],
            [['RoomCode'], 'string', 'max' => 50],
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
            'Name' => Yii::t('app', 'Номер'),
            'LName' => Yii::t('app', 'L Name'),
            'CategoryID' => Yii::t('app', 'Category ID'),
            'RoomCode' => Yii::t('app', 'Room Code'),
            'Hotel' => Yii::t('app', 'Hotel'),
            'isIRO' => Yii::t('app', 'Is Iro'),
        ];
    }
}
