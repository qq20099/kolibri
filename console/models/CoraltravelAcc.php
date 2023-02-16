<?php

namespace console\models;

use Yii;

/**
 * This is the model class for table "coraltravel_acc".
 *
 * @property int $ID
 * @property string $Name
 * @property string $LName
 * @property int|null $AdultCount
 * @property int|null $ChildCount
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
            'ID' => Yii::t('app', 'ID'),
            'Name' => Yii::t('app', 'Name'),
            'LName' => Yii::t('app', 'L Name'),
            'AdultCount' => Yii::t('app', 'Adult Count'),
            'ChildCount' => Yii::t('app', 'Child Count'),
        ];
    }
}
