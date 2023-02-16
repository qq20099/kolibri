<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "pages".
 *
 * @property int $id
 * @property string $title
 * @property string $url
 * @property string|null $anons
 * @property string|null $content
 * @property string|null $meta_title
 * @property string|null $meta_description
 * @property string|null $meta_keywords
 * @property int $activity
 * @property int $menu
 * @property int $sort
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Banners[] $banners
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
            [['anons', 'content', 'meta_description'], 'string'],
            [['activity', 'menu', 'sort', 'created_at', 'updated_at'], 'integer'],
            [['title', 'menu_title', 'url', 'meta_title', 'meta_keywords'], 'string', 'max' => 255],
            ['main', 'safe'],
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
    
    public function beforeSave($insert)
    {
        if (!$this->menu_title) {
            $this->menu_title = $this->title;
        }

        if ($insert || !$this->url) {
            $t = str_replace('.', '. ', $this->title);
            $url = \yii\helpers\Inflector::slug($t);
            $this->url = $url;
        }
        return parent::beforeSave($insert);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Страница',
            'url' => 'Url',
            'anons' => 'Anons',
            'content' => 'Content',
            'meta_title' => 'Meta Title',
            'meta_description' => 'Meta Description',
            'meta_keywords' => 'Meta Keywords',
            'activity' => 'На сайте',
            'menu' => 'В меню',
            'sort' => 'Sort',
            'created_at' => 'Добавлена',
            'updated_at' => 'Изменена',
        ];
    }

    /**
     * Gets query for [[Banners]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBanners()
    {
        return $this->hasMany(Banners::class, ['page_id' => 'id']);
    }
}
