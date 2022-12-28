<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "area".
 *
 * @property int $id
 * @property string $title
 * @property int $region_id
 * @property int $activity
 *
 * @property AreaArea[] $areaAreas
 */
class Area extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'area';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'region_id'], 'required'],
            [['region_id', 'activity'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['title', 'region_id'], 'unique', 'targetAttribute' => ['title', 'region_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'region_id' => Yii::t('app', 'Region ID'),
            'activity' => Yii::t('app', 'Activity'),
        ];
    }

    /**
     * Gets query for [[AreaAreas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAreaAreas()
    {
        return $this->hasMany(AreaArea::class, ['area_id' => 'id']);
    }
}
