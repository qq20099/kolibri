<?php
namespace frontend\widgets\orderform;

use yii\base\Widget;
use frontend\models\OrderForm;
use yii\helpers\ArrayHelper;
use common\helpers\DataHelper;
use Yii;

class OrderFormWidget extends Widget {

    public $index;

    public function run()
    {
        $courses = [];
        $model = new OrderForm();

        $html = $this->render('index', [
            'model' => $model,
            'class' => ($this->index) ? '' : ' page',
        ]);
        return $html;
    }

}