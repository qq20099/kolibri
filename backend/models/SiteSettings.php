<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "site_settings".
 *
 * @property int $id
 * @property string $name
 * @property string|null $val
 * @property string $label
 * @property string|null $target
 */
class SiteSettings extends \yii\db\ActiveRecord
{
    public $settings;
    public $in_maintenance;
    public $maintenance_message;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'site_settings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['settings', 'value'], 'safe'],
            [['name', 'maintenance_message'], 'string'],
            [['in_maintenance'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'value' => Yii::t('app', 'Value'),
        ];
    }

    public function beforeSave($insert)
    {
        $this->value = $this->value ? serialize($this->value) : '';
        return parent::beforeSave($insert);
    }

    public function afterFind()
    {
        $this->value = $this->value ? (object)unserialize($this->value) : array();
        /*echo "<pre>";
        print_r($this->value);
        echo "</pre>";
        die();*/
        return parent::afterFind();
    }

}
