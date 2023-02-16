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
    public $ages;


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
            [['tour_id', 'politic', 'email'], 'required'],
            [['tour_id'], 'integer'],
            [['politic'], 'compare', 'compareValue' => 1, 'message' => 'Jums ir jāpiekrīt noteikumiem'],
            [['comment', 'link', 'ages'], 'string'],
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
            $model->ChildAges = $this->ages;
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

    public function adminMail($client)
    {
        $r = Yii::$app->mailer->compose('new_order_admin', ['data' => $client, 'order' => $this]);
        $r->setTo(Yii::$app->params['adminEmail'])
        ->setFrom(Yii::$app->params['senderEmail']);
        $r->setSubject('Jauns pasūtījums Admin');
        return $r->send();
    }

    public function clientMail($client)
    {
        $r = Yii::$app->mailer->compose('new_order_client', ['data' => $client, 'order' => $this]);
        $r->setTo($client->email)
        ->setFrom(Yii::$app->params['senderEmail']);
        $r->setSubject('Jauns pasūtījums');
        return $r->send();
    }

    public function getTour22()
    {

        /*$model = \frontend\models\Tours::findOne($this->tour_id);
        return $model;*/
    }
}
