<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "area_area".
 *
 * @property int $area_id
 * @property int $op_area_id
 * @property string $operator
 *
 * @property Area $area
 * @property CoraltravelArea $opArea
 */
class AreaArea extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'area_area';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['area_id', 'op_area_id', 'operator'], 'required'],
            [['area_id', 'op_area_id'], 'integer'],
            [['operator'], 'string', 'max' => 20],
            [['area_id', 'op_area_id', 'operator'], 'unique', 'targetAttribute' => ['area_id', 'op_area_id', 'operator']],
            [['area_id'], 'exist', 'skipOnError' => true, 'targetClass' => Area::class, 'targetAttribute' => ['area_id' => 'id']],
            [['op_area_id'], 'exist', 'skipOnError' => true, 'targetClass' => CoraltravelArea::class, 'targetAttribute' => ['op_area_id' => 'ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'area_id' => Yii::t('app', 'Area ID'),
            'op_area_id' => Yii::t('app', 'Op Area ID'),
            'operator' => Yii::t('app', 'Operator'),
        ];
    }

    /**
     * Gets query for [[Area]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArea()
    {
        return $this->hasOne(Area::class, ['id' => 'area_id']);
    }

    /**
     * Gets query for [[OpArea]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOpArea()
    {
        return $this->hasOne(CoraltravelArea::class, ['ID' => 'op_area_id']);
    }
}
