<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%config}}".
 *
 * @property int $id
 * @property string $name
 * @property string $val
 * @property string $label
 * @property int $category
 * @property string $type
 */
class Config extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%config}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'label', 'category', 'type'], 'required'],
            [['val', 'type', 'category'], 'string'],
            [['name', 'label'], 'string', 'max' => 255],
            ['name', 'trim'],
            ['name', 'unique', 'targetClass' => '\common\models\Config', 'message' => Yii::t('app', 'The field must be unique.')],
            ['name', 'match', 'pattern' => '/^[a-z]\w*$/i', 'message'=>Yii::t('app','Only English letters, numbers and underscore.')],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app.config', 'Name'),
            'val' => Yii::t('app.config', 'Value'),
            'label' => Yii::t('app.config', 'Label'),
            'category' => Yii::t('app.config', 'Category'),
            'type' => Yii::t('app.config', 'Type'),
        ];
    }
}
