<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class OrderForm extends Orders
{
    /*public $name;
    public $phone;
    public $email;*/
    public $email;
   // public $tour_id;
    public $politic;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            /*['name', 'trim'],
            ['name', 'required'],
            ['name', 'string', 'min' => 2, 'max' => 150],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 150],

            ['phone', 'trim'],
            //['phone', 'required'],
            ['phone', 'string', 'max' => 150],*/
            ['email', 'email'],
            [['tour_id', 'politic'], 'required'],
            [['tour_id'], 'integer'],
            [['politic'], 'compare', 'compareValue' => 1, 'message' => 'Jums ir jāpiekrīt noteikumiem'],
            [['comment', 'link'], 'string'],
        ];
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        if ($this->tour_id) {
            $tours = Tours::findOne($this->tour_id);//->asArray();
            $model = new OrderItems();

            $tours->id = null;
            OrderItems::populateRecord($model, $tours);
            $model->order_id = $this->id;
            $model->trigger(OrderItems::EVENT_AFTER_FIND);
            $model->setIsNewRecord(true);
            $model->save(false);
        }
    }

    public function attributeLabels()
    {
        return [
            'name' => Yii::t('app', 'Name'),
            'phone' => Yii::t('app', 'Phone'),
            'comment' => 'Rakstiet jūsu ziņu šeit...',
        ];
    }

    public function add()
    {
        return true;
    }
}
