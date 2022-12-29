<?php
namespace frontend\widgets\filtersform;

use yii\base\Widget;
use frontend\models\SearchForm;
use frontend\models\SearchTours;
use yii\helpers\ArrayHelper;
use common\helpers\DataHelper;
use Yii;

class FiltersFormWidget extends Widget {

    public $index;

    public function run()
    {
        $courses = [];
        $model = new SearchTours();
        $model->scenario = $model::SCENARIO_FIND_BY_COUNTRY;


        $params = Yii::$app->request->queryParams;
        $model->load($params);
        $model->validate();

        $html = $this->render('_form', [
            'model' => $model,
            'rating' => $model->getHotelRatingForFilter(),
            'service' => $model->getServiceForFilter(),
            'hotel' => $model->getHotelForFilter(),
            'region' => $model->getRegionsForCountry(),
        ]);
        return $html;
    }

}