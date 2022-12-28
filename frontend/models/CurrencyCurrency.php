<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "currency_currency".
 *
 * @property int $currency_id
 * @property int $op_currency_id
 * @property string $operator
 */
class CurrencyCurrency extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'currency_currency';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['currency_id', 'op_currency_id', 'operator'], 'required'],
            [['currency_id', 'op_currency_id'], 'integer'],
            [['operator'], 'string', 'max' => 20],
            [['currency_id', 'op_currency_id', 'operator'], 'unique', 'targetAttribute' => ['currency_id', 'op_currency_id', 'operator']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'currency_id' => Yii::t('app', 'Currency ID'),
            'op_currency_id' => Yii::t('app', 'Op Currency ID'),
            'operator' => Yii::t('app', 'Operator'),
        ];
    }
}
