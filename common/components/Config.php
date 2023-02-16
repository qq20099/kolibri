<?php
	namespace common\components;
 
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
 
class Config extends Component {
 
    private $_attributes;
    private $_labels;
    //public $data;
    
    public function getInData($nam){
        return \common\models\Config::find()->where(['name' => $nam])->one()->val;
    }
 
    /**
     * @inheritdoc
     */
    public function init() {
        parent::init();
        $this->_attributes = ArrayHelper::map(\common\models\Config::find()->all(), 'name', 'val');
        $this->_labels = ArrayHelper::map(\common\models\Config::find()->all(), 'name', 'label');
    }
 
    public function __get($name) {
        if (array_key_exists($name, $this->_attributes))
            return $this->_attributes[$name];

        return parent::__get($name);
    }

    public function label($name) {
        if (array_key_exists($name, $this->_labels))
            return $this->_labels[$name];

        return parent::__get($name);
    }
} 