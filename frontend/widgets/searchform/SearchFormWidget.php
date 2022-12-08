<?php
namespace frontend\widgets\searchform;

use yii\base\Widget;
use frontend\models\SearchForm;
use yii\helpers\ArrayHelper;
use common\helpers\DataHelper;
use Yii;

class SearchFormWidget extends Widget {

    public $index;

    public function run()
    {
        $courses = [];
        $model = new SearchForm();

        $html = $this->render('index', [
            'model' => $model,
            'class' => ($this->index) ? '' : ' page',
        ]);
        return $html;
    }

}