<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "coraltravel_acc".
 *
 * @property int $ID
 * @property string $Name
 * @property string $LName
 * @property int|null $AdultCount
 * @property int|null $ChildCount
 *
 * @property Tours[] $tours
 */
class CoraltravelAcc extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'coraltravel_acc';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'Name', 'LName'], 'required'],
            [['ID', 'AdultCount', 'ChildCount'], 'integer'],
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
            'ID' => 'ID',
            'Name' => 'Тип номера',
            'LName' => 'L Name',
            'AdultCount' => 'Adult Count',
            'ChildCount' => 'Child Count',
        ];
    }

    /**
     * Gets query for [[Tours]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTours()
    {
        return $this->hasMany(Tours::class, ['AccID' => 'ID']);
    }
}
