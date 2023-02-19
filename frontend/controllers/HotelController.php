<?php

namespace frontend\controllers;

use Yii;
use frontend\models\CoraltravelHotel;
use yii\web\NotFoundHttpException;

class HotelController extends AppController
{
    public function actionIndex()
    {
        $countryFilter = [];

        $model = \frontend\models\Tours::find()
        ->with(['hotel', 'toCountry', 'meal', 'area', 'hotelCategory'])
        ->where(['>', 'FlightDate', strtotime(date('Y-m-d', time()).' 00:00:00')])
        ->joinWith('toCountry')
        ->orderBy(['{{%coraltravel_country}}.Name' => SORT_ASC])
        ->groupBy('ToCountryID')
        ->asArray()
        ->all();

        $searchModel = new \frontend\models\SearchTours();

        if (Yii::$app->request->isAjax)
          $searchModel->scenario = $searchModel::SCENARIO_FIND_BY_COUNTRY;

        if ($searchModel->scenario == $searchModel::SCENARIO_FIND_BY_FORM && !isset($searchModel->adult)) {
            $searchModel->adult = 2;
        }

        $params = Yii::$app->request->queryParams;


        $cookies = Yii::$app->request->cookies;
        $hot_sort_country = $cookies->getValue('hot_sort_country', 0);

        if (!isset($params['SearchTours']['country_id']) && $hot_sort_country) {
            $params['SearchTours']['country_id'] = $hot_sort_country;
        }

        $dataProvider = $searchModel->search($params);

        if (isset($searchModel->country_id) && isset($searchModel->region_id) && $searchModel->region_id) {
            $c = \frontend\models\CoraltravelGeography::find()->where(['CountryID' => $searchModel->country_id])
            //->with(['area'])
            ->groupBy('AreaID')
            ->asArray()
            ->all();

            $r = ArrayHelper::getColumn($c, 'AreaID');

            if (array_diff($searchModel->region_id, $r)) {
                throw new NotFoundHttpException(Yii::t(
                    'app', 'Page not found'
                ));
            }
        }

        $cookies = Yii::$app->response->cookies;

        if (isset($params['SearchTours']['country_id']) && $params['SearchTours']['country_id'] > 0) {
            $cookies->add(new \yii\web\Cookie([
                'name' => 'hot_sort_country',
                'value' => (int)$searchModel->country_id
            ]));
            $hot_sort_country = $searchModel->country_id;
        } else {
            $cookies->remove('hot_sort_country');
            $hot_sort_country = 0;
        }

        /*echo "<pre>";
        //print_r($dataProvider->getModels());
        print_r($params);
        echo "</pre>";
        die();*/

        $countryFilter = $searchModel->getCountryForFilter();

            if (isset($countryFilter) && count($countryFilter) > 1) {
                $countryFilter[0] = 'All';
                asort($countryFilter);
                //array_unshift($countryFilter, 'All');
            } else {
               // $countryFilter = [];
            }

        $pages = new \frontend\models\Pages();
        $page = $pages->getPageByUrl('tours');
/*echo "<pre>";
print_r($countryFilter);
//print_r($page);
echo "</pre>";
die();*/
        $this->setMetaTags(
          $page->meta_title,
          $page->meta_keywords,
          $page->meta_description
        );

        return $this->render('index', compact(
            'dataProvider',
            'searchModel',
            'hot_sort_country',
            'page',
            'countryFilter',
            'params'
        ));
    }

    public function actionView($id)
    {
        /*$q = \frontend\models\Tours::find()->where(['Child' => 1])
        ->andWhere(['!=', 'ChildAges', ''])
        ->andWhere(['!=', 'ChildAges', '0,,,']);
        echo $q->count();
        $model = $q->all();

        foreach ($model as $value){
            echo "<pre>";
            print_r($value);
            echo "</pre>";
            die();
            $value->ChildAges;
        }
        die();*/

        /*$model = Ticket::find()
           ->with([
             'hotel', 'hotel.images',
             'hotel.raitings', 'hotel.location0',
             'hotel.location0.country',
             'attributes0'
           ])
           ->where('id = :id', [':id' => $id])
           ->one();*/
        $model = CoraltravelHotel::find()
          ->with(['tours', 'geography', 'place.area.region.country']) //, 'toCountry', 'meal', 'place.area.region.country', 'room', 'hotel.category'])
          ->where('ID = :id', [':id' => $id])
          ->one();

        if (empty($model))
          throw new NotFoundHttpException();

        $searchModel = new \frontend\models\SearchTours();

        $params = Yii::$app->request->queryParams;
        $params['SearchTours']['hotel_id'][] = $id;
        $params['SearchTours']['country_id'] = $model->place->area->region->country->ID;

        $dataProvider = $searchModel->search($params);

        $dataProvider->query->orderBy('PackagePrice');
        /*$dataProvider->sort = [
                'defaultOrder' => [
                    //'FlightDate' => SORT_ASC
                    'PackagePrice1' => SORT_ASC
                ]
            ];*/

        /*echo "<pre>";
        print_r($dataProvider->getModels());
        //print_r(\Yii::$app->request->queryParams);
        echo "</pre>";
        die();*/
        //print_r($model->hotel->getI());
        /*foreach ($model->hotel->getI() as $value) {
            $im = new \frontend\models\Images();
            $im->hotel_id = $model->HotelID;
            $im->title = basename($value);
            $im->save();
            //print_r($im->getErrors());die();
        }
        die();*/

        /*$pages = new Pages();
        $page = $pages->getPageByUrl('tours');
        */
        $this->setMetaTags(
          $model->Name.' '.$model->category->ShortName.' - '.$model->geography->CountryName.', '.$model->geography->AreaName,
          implode(',', [$model->Name.' '.$model->category->ShortName, $model->geography->CountryName, $model->geography->RegionName, $model->geography->AreaName, $model->geography->PlaceName]),
          implode(' ', [$model->Name.' '.$model->category->ShortName, $model->geography->CountryName, $model->geography->RegionName, $model->geography->AreaName, $model->geography->PlaceName])
        );
   /*echo "<pre>";
   print_r($model);
   echo "</pre>";
   die();*/
        return $this->render('view', [
          'model' => $model,
          'related' => $dataProvider->getModels(),
        ]);
    }

}
