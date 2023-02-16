<?php

namespace console\models;

use Yii;

/**
 * This is the model class for table "coraltravel_flight_supplier".
 *
 * @property int $ID
 * @property string $Name
 * @property string $Lname
 * @property int $TransportType
 * @property int $CancelStatus
 * @property string|null $Logo
 * @property int $IsUsed
 * @property string|null $Code
 * @property string|null $AccountingCode
 */
class CoraltravelFlightSupplier extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'coraltravel_flight_supplier';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'Name', 'Lname'], 'required'],
            [['ID', 'TransportType', 'CancelStatus', 'IsUsed'], 'integer'],
            [['Logo'], 'string'],
            [['Name', 'Lname'], 'string', 'max' => 150],
            [['Code'], 'string', 'max' => 15],
            [['AccountingCode'], 'string', 'max' => 150],
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
            'Lname' => Yii::t('app', 'Lname'),
            'TransportType' => Yii::t('app', 'Transport Type'),
            'CancelStatus' => Yii::t('app', 'Cancel Status'),
            'Logo' => Yii::t('app', 'Logo'),
            'IsUsed' => Yii::t('app', 'Is Used'),
            'Code' => Yii::t('app', 'Code'),
            'AccountingCode' => Yii::t('app', 'Accounting Code'),
        ];
    }
}
