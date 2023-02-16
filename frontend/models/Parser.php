<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "parser".
 *
 * @property int $id
 * @property int $hotel_id
 * @property string|null $title
 * @property string $html
 * @property string|null $description
 * @property string $link
 * @property string|null $img
 * @property string $page
 * @property string|null $errors
 */
class Parser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'parser';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hotel_id', 'html', 'link', 'page'], 'required'],
            [['hotel_id'], 'integer'],
            [['html', 'description', 'img', 'page', 'errors'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['title', 'description'], 'filter', 'filter' => 'trim'],
            [['link'], 'string', 'max' => 400],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hotel_id' => 'Hotel ID',
            'title' => 'Title',
            'html' => 'Html',
            'description' => 'Description',
            'link' => 'Link',
            'img' => 'Img',
            'page' => 'Page',
            'errors' => 'Errors',
        ];
    }
}
