<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "region_region".
 *
 * @property int $region_id
 * @property int $op_region_id
 * @property string $operator
 *
 * @property CoraltravelRegion $opRegion
 * @property Region $region
 */
class RegionRegion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'region_region';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['region_id', 'op_region_id', 'operator'], 'required'],
            [['region_id', 'op_region_id'], 'integer'],
            [['operator'], 'string', 'max' => 20],
            [['region_id', 'op_region_id', 'operator'], 'unique', 'targetAttribute' => ['region_id', 'op_region_id', 'operator']],
            [['region_id'], 'exist', 'skipOnError' => true, 'targetClass' => Region::class, 'targetAttribute' => ['region_id' => 'id']],
            [['op_region_id'], 'exist', 'skipOnError' => true, 'targetClass' => CoraltravelRegion::class, 'targetAttribute' => ['op_region_id' => 'ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'region_id' => Yii::t('app', 'Region ID'),
            'op_region_id' => Yii::t('app', 'Op Region ID'),
            'operator' => Yii::t('app', 'Operator'),
        ];
    }

    /**
     * Gets query for [[OpRegion]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOpRegion()
    {
        return $this->hasOne(CoraltravelRegion::class, ['ID' => 'op_region_id']);
    }

    /**
     * Gets query for [[Region]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(Region::class, ['id' => 'region_id']);
    }
}
