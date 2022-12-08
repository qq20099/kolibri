<?php

namespace frontend\controllers;

use frontend\models\Ticket;
use Yii;

class HotelController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $searchModel = new \frontend\models\SearchHotel();

        $params = Yii::$app->request->queryParams;
//        print_r($params);die();

        $cookies = Yii::$app->request->cookies;
        $hot_sort_country = $cookies->getValue('hot_sort_country', 0);

        if (!isset($params['SearchHotel']['country_id']) && $hot_sort_country) {
            $params['SearchHotel']['country_id'] = $hot_sort_country;
        }

        $dataProvider = $searchModel->search($params);

        $cookies = Yii::$app->response->cookies;

        if ($params['SearchHotel']['country_id'] > 0) {
            $cookies->add(new \yii\web\Cookie([
                'name' => 'hot_sort_country',
                'value' => (int)$searchModel->country_id
            ]));
            $hot_sort_country = $searchModel->country_id;
        } else {
            $cookies->remove('hot_sort_country');
            $hot_sort_country = 0;
        }

        return $this->render('index', compact('dataProvider', 'searchModel', 'hot_sort_country'));
    }

    public function actionView($id)
    {
         $model = Ticket::find()
           ->with([
             'hotel', 'hotel.images',
             'hotel.raitings', 'hotel.location0',
             'hotel.location0.country',
             'attributes0'
           ])
           ->where('id = :id', [':id' => $id])
           ->one();

        return $this->render('view', compact('model'));
    }

}
