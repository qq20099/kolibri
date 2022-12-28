<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "pages".
 *
 * @property int $id
 * @property string $title
 * @property string|null $content
 * @property int $activity
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Gallery[] $galleries
 */
class Pages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['anons', 'content'], 'string'],
            [['activity', 'created_at', 'updated_at', 'menu', 'sort'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    \yii\db\ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Назва',
            'content' => 'Контент',
            'activity' => 'На сайте',
            'created_at' => 'Создано',
            'updated_at' => 'Изменено',
            'menu' => 'Добавить в меню',
            'sort' => 'Порядок',
        ];
    }

    /**
     * Gets query for [[Galleries]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGalleries()
    {
        return $this->hasMany(Gallery::class, ['page_id' => 'id']);
    }
}
