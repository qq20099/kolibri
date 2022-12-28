<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "country_country".
 *
 * @property int $country_id
 * @property int $op_country_id
 * @property string $operator
 *
 * @property Country $country
 * @property CoraltravelCountry $opCountry
 */
class CountryCountry extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'country_country';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['country_id', 'op_country_id', 'operator'], 'required'],
            [['country_id', 'op_country_id'], 'integer'],
            [['operator'], 'string', 'max' => 20],
            [['country_id', 'op_country_id', 'operator'], 'unique', 'targetAttribute' => ['country_id', 'op_country_id', 'operator']],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Country::class, 'targetAttribute' => ['country_id' => 'id']],
            [['op_country_id'], 'exist', 'skipOnError' => true, 'targetClass' => CoraltravelCountry::class, 'targetAttribute' => ['op_country_id' => 'ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'country_id' => Yii::t('app', 'Country ID'),
            'op_country_id' => Yii::t('app', 'Op Country ID'),
            'operator' => Yii::t('app', 'Operator'),
        ];
    }

    /**
     * Gets query for [[Country]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Country::class, ['id' => 'country_id']);
    }

    /**
     * Gets query for [[OpCountry]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOpCountry()
    {
        return $this->hasOne(CoraltravelCountry::class, ['ID' => 'op_country_id']);
    }
}
