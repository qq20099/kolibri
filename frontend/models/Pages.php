<?php

namespace frontend\models;

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
            [['title', 'menu_title', 'url', 'created_at', 'updated_at'], 'required'],
            [['anons', 'content', 'meta_description'], 'string'],
            [['activity', 'menu', 'sort', 'created_at', 'updated_at'], 'integer'],
            [['title', 'url', 'meta_title', 'meta_keywords'], 'string', 'max' => 255],
            ['main', 'safe'],
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
            'url' => Yii::t('app', 'Url'),
            'anons' => Yii::t('app', 'Anons'),
            'content' => Yii::t('app', 'Content'),
            'meta_title' => Yii::t('app', 'Meta Title'),
            'meta_description' => Yii::t('app', 'Meta Description'),
            'meta_keywords' => Yii::t('app', 'Meta Keywords'),
            'activity' => Yii::t('app', 'Activity'),
            'menu' => Yii::t('app', 'Menu'),
            'sort' => Yii::t('app', 'Sort'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public function getBanners()
    {
        return $this->hasMany(Banners::class, ['page_id' => 'id']);
    }

    public static function getMainPage()
    {
        return self::find()->where(['main' => 1])->with('banners')->one();
    }

    public static function getPageByUrl($url)
    {
        return self::find()->where('url = :url', [':url' => $url])->with('banners')->one();
    }

}
