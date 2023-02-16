<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "coraltravel_seat_class".
 *
 * @property int $ID
 * @property string $Name
 * @property string $LName
 * @property int|null $IsDefault
 * @property int|null $IsUsed
 */
class CoraltravelSeatClass extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'coraltravel_seat_class';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'Name', 'LName'], 'required'],
            [['ID', 'IsDefault', 'IsUsed'], 'integer'],
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
            'Name' => Yii::t('app', 'Класс отеля'),
            'LName' => Yii::t('app', 'L Name'),
            'IsDefault' => Yii::t('app', 'Is Default'),
            'IsUsed' => Yii::t('app', 'Is Used'),
        ];
    }
}
