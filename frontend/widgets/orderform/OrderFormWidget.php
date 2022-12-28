<?php
namespace frontend\widgets\orderform;

use yii\base\Widget;
use frontend\models\OrderForm;
use frontend\models\Client;
use yii\helpers\ArrayHelper;
use common\helpers\DataHelper;
use Yii;

class OrderFormWidget extends Widget {

    public $index;

    public function run()
    {
        $courses = [];
        $model = new OrderForm();
        $client = new Client();

        $html = $this->render('index', [
            'model' => $model,
            'client' => $client,
            'class' => ($this->index) ? '' : ' page',
        ]);
        return $html;
    }

}