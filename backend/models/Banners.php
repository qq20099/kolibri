<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "banners".
 *
 * @property int $id
 * @property string $title
 * @property int $page_id
 *
 * @property Pages $page
 */
class Banners extends \yii\db\ActiveRecord
{
    public $delimg;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'banners';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['page_id'], 'required'],
            [['page_id'], 'integer'],
            [['title', 'subtitle', 'img'], 'string', 'max' => 255],
            [['btn_text'], 'string', 'max' => 50],
            [['link'], 'string'],
            [['page_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pages::class, 'targetAttribute' => ['page_id' => 'id']],
            [['delimg'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'img' => 'Изображение',
            'title' => 'Заголовок 1',
            'subtitle' => 'Заголовок 2',
            'btn_text' => 'Кнопка',
            'page_id' => 'Страница',
            'link' => 'Ссылка',
        ];
    }

    /**
     * Gets query for [[Page]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPage()
    {
        return $this->hasOne(Pages::class, ['id' => 'page_id']);
    }

    public function afterSave($insert, $changedAttributes) {
        parent::afterSave($insert, $changedAttributes);
        if ($this->img && is_file(Yii::getAlias('@uploadsTmpDir'.'/'.$this->img))) {
            $path = Yii::getAlias('@bannersDir'.'/'.$this->page_id); //$this->img);

            if (!is_dir($path))
              mkdir($path, 0777, true);

            rename(Yii::getAlias('@uploadsTmpDir'.'/'.$this->img), $path.'/'.$this->img);

        }
        $delimg = explode('|', $this->delimg);
        if ($delimg) {
            foreach ($delimg as $value){
                if (is_file(Yii::getAlias('@frontend').'/web'.$value))
                  unlink(Yii::getAlias('@frontend').'/web'.$value);
            }
        }
    }

    public function afterDelete()
    {
        parent::afterDelete();
        $path = Yii::getAlias('@bannersDir'.'/'.$this->id);
        \yii\helpers\FileHelper::removeDirectory($path);
    }
}
