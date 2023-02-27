<?php

namespace frontend\controllers;

use frontend\models\SearchTours;
use frontend\models\Pages;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use Yii;

class ToursController extends AppController
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

        $searchModel = new SearchTours();

        if (Yii::$app->request->isAjax)
          $searchModel->scenario = $searchModel::SCENARIO_FIND_BY_COUNTRY;

        if ($searchModel->scenario == $searchModel::SCENARIO_FIND_BY_FORM && !isset($searchModel->adult)) {
            $searchModel->adult = 2;
        }

        $params = Yii::$app->request->queryParams;


        $cookies = Yii::$app->request->cookies;
        $hot_sort_country = $cookies->getValue('hot_sort_country', 0);

        if (!isset($params['SearchTours']['country_id']) && $hot_sort_country) {
            //$params['SearchTours']['country_id'] = $hot_sort_country;
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
        if ($model) {

            /*$t = \yii\helpers\ArrayHelper::getColumn($model, 'toCountry');
            $countryFilter = \yii\helpers\ArrayHelper::map($t, 'ID', 'Name');

            if (count($countryFilter) > 1) {
                $countryFilter[0] = 'All';
                asort($countryFilter);
                //array_unshift($countryFilter, 'All');
            } else {
                $countryFilter = [];
            }*/
        }

        $countryFilter = $searchModel->getCountryForFilter();

            if (isset($countryFilter) && count($countryFilter) > 1) {
                $countryFilter[0] = 'All';
                asort($countryFilter);
                //array_unshift($countryFilter, 'All');
            } else {
               // $countryFilter = [];
            }

        $pages = new Pages();
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
        /*$model = Ticket::find()
           ->with([
             'hotel', 'hotel.images',
             'hotel.raitings', 'hotel.location0',
             'hotel.location0.country',
             'attributes0'
           ])
           ->where('id = :id', [':id' => $id])
           ->one();*/
        $model = \frontend\models\Tours::find()
          ->with(['hotel', 'toCountry', 'meal', 'place.area.region.country', 'room', 'hotel.category'])
          ->where('id = :id', [':id' => $id])
          ->one();

        //print_r($model->hotel->getI());
        /*foreach ($model->hotel->getI() as $value) {
            $im = new \frontend\models\Images();
            $im->hotel_id = $model->HotelID;
            $im->title = basename($value);
            $im->save();
            //print_r($im->getErrors());die();
        }
        die();*/

        $pages = new Pages();
        $page = $pages->getPageByUrl('tours');

        $this->setMetaTags(
          $model->hotel->Name.' '.$model->hotel->category->ShortName,
          $page->meta_keywords,
          $page->meta_description
        );

        return $this->render('view', [
          'model' => $model,
          'related' => $model->getRelatedTours(),
        ]);
    }

    public function actionNov()
    {
        $xmlurl = 'https://www.novaturas.lv/iframe_site2/kolibritravel/lv/index/promogroup/group/weekoffers/format/xml';
        $xmlurl = 'https://www.novatours.lv/iframe_site2/kolibritravel/lv/index/promogroup/group/weekoffers/format/xml';

        //$xml = file_get_contents($xmlurl);
        $xml = simplexml_load_file($xmlurl);
        /*echo "<pre>";
        print_r($xml);
        echo "</pre>";
        die();*/
        return $this->render('nov', compact('xml'));
    }

    public function actionNights()
    {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $model = new SearchTours();
            if ($model->load($this->request->post())) {
               $data = (!$model->date_from) ? [] : $model->getNights();
            } else {

            }

            return ['nights' => array_values($data)];
              //$data = ArrayHelper::getColumn($data, 'HotelNight');

            //return $this->renderAjax('spec_nights', compact('model', 'data'));
        }
    }

    public function actionNights1()
    {
        if (Yii::$app->request->isAjax) {
            $model = new SearchTours();
            if ($model->load($this->request->post())) {
               $data = (!$model->date_from) ? [] : $model->getNights();
            } else {

            }

            //print_r($data);
              //$data = ArrayHelper::getColumn($data, 'HotelNight');

            return $this->renderAjax('spec_nights', compact('model', 'data'));
        }
    }

    public function actionSpecification00()
    {
        if (Yii::$app->request->isAjax) {
            $d = strtotime(date('Y-m-d', time()).' 00:00:00');
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $model = new \frontend\models\SearchTours();
            if ($model->load($this->request->post())) {
                //print_r($model->getToursAvailableDate());die();
               $data = (!$model->region_id) ? $model->getRegionsForCountry() : [];
            } else {

            }

            /*$q = \frontend\models\CoraltravelAvailableDateItems::find()
             //->select('FROM_UNIXTIME(PackageDate, "%Y-%m-%d") as PackageDate ')
             //->select(new \yii\db\Expression("FROM_UNIXTIME(PackageDate,'%Y-%m-%d') as PackageDate"))
             ->select(['*, FROM_UNIXTIME({{%coraltravel_package_available_date}}.PackageDate, "%Y-%m-%d") as PackDate']);
             $q->where(['>=', 'PackageDate', $d]);

             if (!$model->region_id)
               $q->andWhere(['{{%coraltravel_available_date_items1}}.ToCountryID' => $model->country_id]);

             //$q->where(['{{%coraltravel_available_date_items}}.ToCountryID' => $model->country_id]);

             //$q->where(['FlightDate', time()]);  FlightDate

             $q->andFilterWhere(['IN', 'ToAreaID', $model->region_id])
             ->with(['package.tours'])
             //->with(['package', 'package.tours'])
             //->joinWith('package')
             ->joinWith('package.tours');
            $dateItems = $q->all();

//print_r($dateItems);
//print_r($data);
//print_r($model);
//die();

            $date = ArrayHelper::getColumn($dateItems, 'PackDate');
            $date = ($date) ? array_unique($date) : [];

            if ($date)
              sort($date);*/

            //print_r($dateItems);
            //print_r($dat);

            return $this->asJson([
                'regions' => ($data) ? $this->renderAjax('spec_country', compact('model', 'data')) : '',
                'date' => $model->getToursAvailableDate(),
            ]);
        }
    }

    /*public function actionGetCountry()
    {

    }*/

    public function actionGetRegions()
    {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $searchTours = new \frontend\models\SearchTours();

            if ($searchTours->load($this->request->post())) {
               $data = (!$searchTours->region_id) ? $searchTours->getRegionsForCountry() : [];
            } else {
            }

            return [
                'regions' => ($data) ? $data : [],
                'show_region' => ($searchTours->region_id) ? true : false,
            ];
        } die("GGG");
    }

    public function actionSpecification()
    {
        if (Yii::$app->request->isAjax) {
            $d = strtotime(date('Y-m-d', time()).' 00:00:00');
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $searchTours = new \frontend\models\SearchTours();

            if ($searchTours->load($this->request->post())) {
                //print_r($searchTours->getToursAvailableDate());die();
               //$data = (!$searchTours->region_id) ? $searchTours->getRegionsForCountry() : [];
               $searchTours->getPeople();
            } else {
                print_r($searchTours->getErrors());

            }

            /*$q = \frontend\models\CoraltravelAvailableDateItems::find()
             //->select('FROM_UNIXTIME(PackageDate, "%Y-%m-%d") as PackageDate ')
             //->select(new \yii\db\Expression("FROM_UNIXTIME(PackageDate,'%Y-%m-%d') as PackageDate"))
             ->select(['*, FROM_UNIXTIME({{%coraltravel_package_available_date}}.PackageDate, "%Y-%m-%d") as PackDate']);
             $q->where(['>=', 'PackageDate', $d]);

             if (!$model->region_id)
               $q->andWhere(['{{%coraltravel_available_date_items1}}.ToCountryID' => $model->country_id]);

             //$q->where(['{{%coraltravel_available_date_items}}.ToCountryID' => $model->country_id]);

             //$q->where(['FlightDate', time()]);  FlightDate

             $q->andFilterWhere(['IN', 'ToAreaID', $model->region_id])
             ->with(['package.tours'])
             //->with(['package', 'package.tours'])
             //->joinWith('package')
             ->joinWith('package.tours');
            $dateItems = $q->all();

//print_r($dateItems);*/
/*print_r($data);
print_r($searchTours);*/
//print_r($model);
//die();
/*
            $date = ArrayHelper::getColumn($dateItems, 'PackDate');
            $date = ($date) ? array_unique($date) : [];

            if ($date)
              sort($date);*/

            //print_r($dateItems);
            //print_r($dat);

            //$result = (!$searchTours->region_id) ? $searchTours->getToursAvailableDate(true) : $searchTours->getToursAvailableDate();
            $result = $searchTours->getDate();
//print_r($result);
            $d = ArrayHelper::getColumn($result, 'date');
            $p = ArrayHelper::getColumn($result, 'PackagePrice');

            $price = ArrayHelper::map($result, 'date', 'PackagePrice');

            return [
                //'regions' => ($data) ? $data : [], //$this->renderAjax('spec_region', compact('searchTours', 'data')) : '',
                'date' => ($d) ? array_unique($d) : [], //$result['date'],
                'price' => $price, //$result['price'],
                'people' => $searchTours->getPeople(),
                'show_region' => ($searchTours->region_id) ? true : false,
            ];
        }
    }

    public function actionPrices()
    {
        if (Yii::$app->request->isAjax) {
            $country_id = $_POST['country'];
            $d = strtotime(date('Y-m-d', time()).' 00:00:00');
        $q = \frontend\models\Tours::find()
         ->select(['FROM_UNIXTIME(FlightDate, "%Y-%n-%j") as PackDate', 'FlightDate as flatdat', 'MIN(PackagePrice) as minprice'])
         ->where(['ToCountryID' => $country_id])
         ->andWhere(['>=', 'FlightDate', $d])
         //->andWhere(['Adult' => $this->adult])
         //->andFilterWhere(['Child' => $this->child])
         //->andFilterWhere(['IN', 'AreaID', $this->region_id])
         ->groupBy('FlightDate')
         ->asArray();
        $model = $q->all();

        //echo $q->prepare(\Yii::$app->db->queryBuilder)->createCommand()->rawSql."\n";die("KKK");
        //print_r($model);
        $date = [];

        if ($model) {
            $price = \yii\helpers\ArrayHelper::map($model, 'PackDate', 'minprice');
            //$date = \yii\helpers\ArrayHelper::getColumn($model, 'PackDate');
            //$date = ($date) ? array_unique($date) : [];
        }
        return $this->renderAjax('_calendar_css', compact('price'));
        //return \yii\helpers\Json::encode(['data' => $price]);
        }
    }

    public function actionSpecification2()
    {
        if (Yii::$app->request->isAjax) {
            $d = strtotime(date('Y-m-d', time()).' 00:00:00');
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $model = new \frontend\models\SearchTours();
            if ($model->load($this->request->post())) {
                //print_r($model->getToursAvailableDate());die();
               $data = (!$model->region_id) ? $model->getRegionsForCountry() : [];
            } else {

            }

            /*$q = \frontend\models\CoraltravelAvailableDateItems::find()
             //->select('FROM_UNIXTIME(PackageDate, "%Y-%m-%d") as PackageDate ')
             //->select(new \yii\db\Expression("FROM_UNIXTIME(PackageDate,'%Y-%m-%d') as PackageDate"))
             ->select(['*, FROM_UNIXTIME({{%coraltravel_package_available_date}}.PackageDate, "%Y-%m-%d") as PackDate']);
             $q->where(['>=', 'PackageDate', $d]);

             if (!$model->region_id)
               $q->andWhere(['{{%coraltravel_available_date_items1}}.ToCountryID' => $model->country_id]);

             //$q->where(['{{%coraltravel_available_date_items}}.ToCountryID' => $model->country_id]);

             //$q->where(['FlightDate', time()]);  FlightDate

             $q->andFilterWhere(['IN', 'ToAreaID', $model->region_id])
             ->with(['package.tours'])
             //->with(['package', 'package.tours'])
             //->joinWith('package')
             ->joinWith('package.tours');
            $dateItems = $q->all();

//print_r($dateItems);
//print_r($data);
//print_r($model);
//die();

            $date = ArrayHelper::getColumn($dateItems, 'PackDate');
            $date = ($date) ? array_unique($date) : [];

            if ($date)
              sort($date);*/

            //print_r($dateItems);
            //print_r($dat);

            return $this->asJson([
                'regions' => ($data) ? $this->renderAjax('spec_country', compact('model', 'data')) : '',
                'date' => $model->getToursAvailableDate(),
            ]);
        }

    }

    public function actionSpecification1()
    {
        if (Yii::$app->request->isAjax) {
            $d = strtotime(date('Y-m-d', time()));
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $model = new \frontend\models\SearchTours();
            if ($model->load($this->request->post())) {
               $data = (!$model->region_id) ? $model->getRegionsForCountry() : [];
            } else {

            }

            $q = \frontend\models\CoraltravelAvailableDateItems::find()
             //->select('FROM_UNIXTIME(PackageDate, "%Y-%m-%d") as PackageDate ')
             //->select(new \yii\db\Expression("FROM_UNIXTIME(PackageDate,'%Y-%m-%d') as PackageDate"))
             ->select(['*, FROM_UNIXTIME({{%coraltravel_package_available_date}}.PackageDate, "%Y-%m-%d") as PackDate']);
             $q->where(['>=', 'PackageDate', $d]);

             if (!$model->region_id)
               $q->andWhere(['{{%coraltravel_available_date_items1}}.ToCountryID' => $model->country_id]);

             //$q->where(['{{%coraltravel_available_date_items}}.ToCountryID' => $model->country_id]);

             //$q->where(['FlightDate', time()]);  FlightDate

             $q->andFilterWhere(['IN', 'ToAreaID', $model->region_id])
             ->with(['package.tours'])
             //->with(['package', 'package.tours'])
             //->joinWith('package')
             ->joinWith('package.tours');
            $dateItems = $q->all();

//print_r($dateItems);
//print_r($data);
//print_r($model);
//die();

            $date = ArrayHelper::getColumn($dateItems, 'PackDate');
            $date = ($date) ? array_unique($date) : [];

            if ($date)
              sort($date);

            //print_r($dateItems);
            //print_r($dat);

            return $this->asJson([
                'regions' => ($data) ? $this->renderAjax('spec_country', compact('model', 'data')) : '',
                'date' => $date,
            ]);
        }

    }

}
