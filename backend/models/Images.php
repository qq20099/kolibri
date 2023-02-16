<?php

namespace backend\models;

use Yii;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;

/**
 * This is the model class for table "images".
 *
 * @property int $id
 * @property string $title
 * @property int $hotel_id
 * @property int $main
 *
 * @property CoraltravelHotel $hotel
 */
class Images extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'images';
    }

    public function behaviors()
    {
        return [
            //TimestampBehavior::className(),
            'saveRelations' => [
                'class'     => SaveRelationsBehavior::className(),
                'relations' => [
                    'images',
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
            [['title', 'hotel_id'], 'required'],
            [['hotel_id', 'main'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['title', 'hotel_id'], 'unique', 'targetAttribute' => ['title', 'hotel_id']],
            [['hotel_id'], 'exist', 'skipOnError' => true, 'targetClass' => CoraltravelHotel::class, 'targetAttribute' => ['hotel_id' => 'ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'hotel_id' => 'Hotel ID',
            'main' => 'Main',
        ];
    }

    /**
     * Gets query for [[Hotel]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHotel()
    {
        return $this->hasOne(CoraltravelHotel::class, ['ID' => 'hotel_id']);
    }
}
