<?php
namespace frontend\widgets\searchform;

use yii\base\Widget;
use frontend\models\SearchForm;
use frontend\models\SearchTours;
use yii\helpers\ArrayHelper;
use common\helpers\DataHelper;
use Yii;

class SearchFormWidget extends Widget {

    public $index;

    public function run()
    {
        $courses = [];
        //$model = new SearchForm();
        //$model = new SearchTours(['scenario' => SearchTours::SCENARIO_FIND_BY_COUNTRY]);
        $model = new SearchTours();
        $model->scenario = $model::SCENARIO_FIND_BY_COUNTRY;


        $params = Yii::$app->request->queryParams;
        $model->load($params);
        $model->validate();
/*        echo "<pre>";//adult
print_r($model->getErrors());
print_r($params);
print_r($model);

echo "</pre>";
die();*/
        $html = $this->render('index', [
            'model' => $model,
        ]);
        return $html;
    }

}