<?php

namespace console\controllers;

use Yii;
use frontend\models\CoraltravelCountry;
use frontend\models\CountryCountry;
use frontend\models\Country;

use frontend\models\CoraltravelRegion;
use frontend\models\RegionRegion;
use frontend\models\Region;

use frontend\models\CoraltravelArea;
use frontend\models\AreaArea;
use frontend\models\Area;

use frontend\models\CoraltravelPlace;
use frontend\models\PlacePlace;
use frontend\models\Place;

use frontend\models\CoraltravelGeography;

use frontend\models\CoraltravelCurrency;
use frontend\models\CurrencyCurrency;
use frontend\models\Currency;

use frontend\models\CoraltravelHotelCategory;
use frontend\models\HotelCategoryHotel;
use frontend\models\HotelCategory;

use frontend\models\CoraltravelHotelCategoryGroup;
use frontend\models\CoraltravelHotelCathotGroupHotel;

use frontend\models\CoraltravelHotelConcept;
use frontend\models\CoraltravelRoomCategory;

use frontend\models\CoraltravelRoomCategoryGroup;
use frontend\models\CoraltravelRoomCatroomGroupRoom;

use frontend\models\CoraltravelRoomFilterGroup;

use frontend\models\CoraltravelRoom;

use frontend\models\CoraltravelHotel;

use Dejurin\GoogleTranslateForFree;

use yii\helpers\ArrayHelper;

class CronController extends \yii\console\Controller
{
    private $source = 'en';
    private $target = 'lv';
    private $attempts = 5;
    private $operator = 'coraltravel';

    private static function getCountryId($name)
    {
        $tr = new GoogleTranslateForFree();
        $name = $tr->translate($this->source, $this->target, $name, $this->attempts);
        $model = Country::find()->where(['title' => $name])->one();
        return (int)$model->id;
    }

    private static function getRegionId($name)
    {
        $tr = new GoogleTranslateForFree();
        $model = Region::find()->where(['title' => $name])->one();
        return $model->id;
    }

    private static function getAreaId($name)
    {
        $tr = new GoogleTranslateForFree();
        $name = $tr->translate($this->source, $this->target, $name, $this->attempts);
        $model = Area::find()->where(['title' => $name])->one();
        return (int)$model->id;
    }

    private static function getHotelCategoryByName($name)
    {
        $model = CoraltravelHotelCategory::find()
          ->where(['Name' => $name])
          ->orWhere(['LocalName' => $name])
          ->orWhere(['ShortName' => $name])
          ->one();
        return $model;
    }

    private static function getPlaceByName($name)
    {
        $model = CoraltravelPlace::find()->where(['Name' => $name])->one();
        return $model;
    }

    private static function getPlaceId($name)
    {
        $tr = new GoogleTranslateForFree();
        $name = $tr->translate($this->source, $this->target, $name, $this->attempts);
        $model = Place::find()->where(['title' => $name])->one();
        return (int)$model->id;
    }

    private static function getHotelCategoryId($name)
    {
        $tr = new GoogleTranslateForFree();
        $name = $tr->translate($this->source, $this->target, $name, $this->attempts);
        $model = HotelCategory::find()->where(['title' => $name])->one();
        return (int)$model->id;
    }

    public function getCountry()
    {
        $date = strtotime(date('Y-m-d'));
        $subQuery = (new \yii\db\Query())->select('ToCountryID')->from('hot_deals')->groupBy('ToCountryID');
        $data = \frontend\models\CoraltravelCountry::find()
        ->select('ID')
        //->where(['FromArea' => 3345])
        //->where(['NOT IN', 'ID', $subQuery])
        //->orWhere(['ID' => 42])
        //->andWhere(['>=', 'PackageDate', $date])
        //->with('coraltravelAvailableDateItems')
        //->indexBy('ID')
        ->asArray()
        ->all();
        return \yii\helpers\ArrayHelper::getColumn($data, 'ID');
        print_r(\yii\helpers\ArrayHelper::getColumn($data, 'ID'));
        /*$r = \yii\helpers\ArrayHelper::getColumn($data, 'coraltravelAvailableDateItems');
        return \yii\helpers\ArrayHelper::map($r, 'ToAreaID', 'ToCountryID');*/
    }

    //public function actionGetCountryForDate()
    private static function getCountryForDate()
    {
        $date = strtotime(date('Y-m-d').' 00:00:00');
        $data = \frontend\models\CoraltravelPackageAvailableDate::find()
        ->where(['FromArea' => 3345])
        //->andWhere(['>=', 'PackageDate', $date])
        ->with('coraltravelAvailableDateItems')
        ->asArray()
        ->all();

        return $data;
        $result = [];
        $r = \yii\helpers\ArrayHelper::getColumn($data, 'coraltravelAvailableDateItems');
        print_r($data);
        if ($r) {
            foreach ($r as $value) {
                $result = $result + ArrayHelper::map($value, 'ToAreaID', 'ToCountryID');
            }
        }

        return $result;

        ///$f = \yii\helpers\ArrayHelper::map($r, 'ToAreaID', 'ToCountryID');
        //print_r($result);
        //print_r($f);
        //die();
        return \yii\helpers\ArrayHelper::map($r, 'ToAreaID', 'ToCountryID');
        //print_r(\yii\helpers\ArrayHelper::getColumn($data, 'coraltravelAvailableDateItems.ToCountryID'));
    }

    public function actionGetPackageAvailableDate()
    {
        $data = Yii::$app->api->getListPackageAvailableDate();
        //print_r($data);

        if ($data['status'] == 'success') {
            foreach ($data['data'] as $value) {
                //$dat = strtotime($value['PackageDate']);
                $dat = strtotime(date('Y-m-d', strtotime($value['PackageDate']).' 00:00:00'));

                $model = \frontend\models\CoraltravelPackageAvailableDate::find()
                ->where(['FromArea' => $value['FromArea']])
                ->andWhere(['PackageDate' => $dat])
                ->one();

                if (!$model)
                  $model = new \frontend\models\CoraltravelPackageAvailableDate();

                $model->attributes = $value;
                $model->PackageDate = $dat;
                $model->PackageDateSource = $value['PackageDate'];

                if ($model->save()) {
                    if ($value['ToCountryList']) {
                        foreach ($value['ToCountryList'] as $k => $val) {
                            $item = new \frontend\models\CoraltravelAvailableDateItems();
                            $item->package_id = $model->id;
                            $item->ToCountryID = $val;
                            $item->ToAreaID = $value['ToAreaList'][$k];
                            try {
                                if (!$item->save()) {
                                    print_r($item->getErrors());
                                    print_r($item);
                                    echo "\r\n";
                                }
                            } catch (\Exception $e) {
                                //print_r($e);
                            }
                        }
                    }
                } else {
                    print_r($model->getErrors());
                    print_r($model);
                    die();
                }

            }
        }
    }

    public function actionGetTours()
    {
        $country = self::getCountryForDate();
        if ($country) {
            foreach ($country as $areaID => $value) {
                $post = [];
                $post['PackageDate'] = date('Y-m-d', $value['PackageDate']);
                if ($value['coraltravelAvailableDateItems']) {
                    foreach ($value['coraltravelAvailableDateItems'] as $val) {
                        $post['ToCountryID'] = $val['ToCountryID'];
                        $post['ToAreaID'] = $val['ToAreaID'];
                        $this->tour($post);
                        //print_r($post);
                    }
                }
                //$this->tours($post);
            }
        }

    }

    private function tour($arr)
    {
        for ($j=1; $j<4; $j++) {
            $post = [
                'ToArea' => $arr['ToAreaID'],
                'ToCountry' => $arr['ToCountryID'],
                'BeginDate' => $arr['PackageDate'],
                'EndDate' => $arr['PackageDate'],
                'Adult' => $j,
            ];
            for ($i=0; $i<4; $i++) {
                $post['Child'] = $i;
                $page = 0;
                while ($page == 0 || ($data['data'] && $data['status'] == 'success' && $page < 3)) {
                    if (!$page)
                      ;//Yii::$app->db->createCommand()->truncateTable('hot_deals')->execute();

                    $page++;
                    echo "Status = ".$data['status']." Country = ".$arr['ToCountryID'];
                    echo " AreaID = ".$arr['ToAreaID'];
                    echo " Adult = ".$j." Child = ".$i;
                    echo " Page = ".$page;
                    echo " COUNT = ".(($data['data']) ? count($data['data']) : 0);
                    echo "\r\n\r\n";

                    $posy['StartIndex'] = $page;

                    try {
                        $data = Yii::$app->api->getPackageSearch(self::tourParams($post));

                        if ($countryID != 12)
                          ;//print_r($data['data']);

                        foreach ($data['data'] as $value) {
                            $model = new \frontend\models\Tours();
                            $model->attributes = $value;
                            //$HotelCategoryID = self::getHotelCategoryByName($value['HotelCategoryName'])->ID;
                            //$model->HotelCategoryID = ($HotelCategoryID) ? $HotelCategoryID : 0;
                            //$PlaceID = self::getPlaceByName($value['PlaceName'])->ID;
                            //$model->PlaceID = ($PlaceID) ? $PlaceID : 0;
                            $model->FlightDate = strtotime(date('Y-m-d', strtotime($value['FlightDate']).' 00:00:00'));
                            $model->HotelCheckInDate = strtotime(date('Y-m-d', strtotime($value['HotelCheckInDate']).' 00:00:00'));
                            $model->FlightDateSource = $value['FlightDate'];
                            $model->HotelCheckInDateSource = $value['HotelCheckInDate'];

                            //$model->FlightDate = strtotime(date('Y-m-d', $value['FlightDate']).' 00:00:00');
                            //$model->HotelCheckInDate = strtotime($value['HotelCheckInDate']);
                            /*$model->EarlyBookingEndDate = ($value['EarlyBookingEndDate'])
                              ? strtotime($value['EarlyBookingEndDate']) : 0;*/

                            $model->EarlyBookingEndDate = ($value['EarlyBookingEndDate']) ? strtotime(date('Y-m-d', strtotime($value['EarlyBookingEndDate']).' 00:00:00')) : 0;
                            $model->HotelAllotmentStatus = (int)$value['HotelAllotmentStatus'];
                            $model->HotelStopSaleStatus = (int)$value['HotelStopSaleStatus'];
                            $model->SaleStatus = (int)$value['SaleStatus'];
                            try {
                                if (!$model->save()) {
                                    print_r($model->getErrors());
                                    print_r($model);
                                    die();
                                }
                            } catch (\Exception $e) {
                                //print_r($e);
                            }
                        }
                    } catch (\Exception $e) {
                        print_r($e->getMessage());
                        break;
                    }
                    sleep(1);
                }
                sleep(2);
            }
            sleep(5);
        }
        sleep(3);
    }

    public function actionGetTours1()
    {
        $arr = [];
        $country = self::getCountryForDate();
        print_r($country);die();
        /*$country = self::getCountry();
        $country = array_unique($country);*/

        if ($country) {
            foreach ($country as $areaID => $countryID) {
                $page = 0;
                //while($page == 0 || ($data['status'] == 'success' && $page < 6)) {
                while ($page == 0 || ($data['data'] && $data['status'] == 'success' && $page < 100)) {
                    if (!$page)
                      ;//Yii::$app->db->createCommand()->truncateTable('hot_deals')->execute();

                    $page++;
                    echo "Status = ".$data['status']." Country = ".$countryID." Page = ".$page."\r\n\r\n";

                    try {
                        $post = [
                            'ToArea' => $areaID,
                            'ToCountry' => $countryID,
                            'StartIndex' => $page,
                        ];
                        $data = Yii::$app->api->getPackageSearch(self::tours($post));

                    if ($countryID != 12)
                      ;//print_r($data['data']);

                    foreach ($data['data'] as $value) {
                        $model = new \frontend\models\Tours();
                        $model->attributes = $value;
                        $HotelCategoryID = self::getHotelCategoryByName($value['HotelCategoryName'])->ID;
                        $model->HotelCategoryID = ($HotelCategoryID) ? $HotelCategoryID : 0;
                        $PlaceID = self::getPlaceByName($value['PlaceName'])->ID;
                        $model->PlaceID = ($PlaceID) ? $PlaceID : 0;
                        $model->FlightDate = strtotime($value['FlightDate']);

                        //$model->FlightDate = strtotime(date('Y-m-d', $value['FlightDate']).' 00:00:00');

                        $model->HotelCheckInDate = strtotime($value['HotelCheckInDate']);

                        $model->EarlyBookingEndDate = ($value['EarlyBookingEndDate'])
                         ? strtotime($value['EarlyBookingEndDate']) : 0;

                        $model->HotelAllotmentStatus = (int)$value['HotelAllotmentStatus'];
                        $model->HotelStopSaleStatus = (int)$value['HotelStopSaleStatus'];
                        $model->SaleStatus = (int)$value['SaleStatus'];
                        try {
                            if (!$model->save()) {
                                print_r($model->getErrors());
                                print_r($model);
                                echo "\r\n";
                            }
                        } catch (\Exception $e) {
                            //print_r($e);
                        }
                    }
                    } catch (\Exception $e) {
                        print_r($e->getMessage());
                        break;
                    }
                    sleep(1);
                }
                sleep(3);
            }
        }
    }

    private static function tourParams($data, $page = 1)
    {
        $oldDate = date('Y-m-d');
        $BeginDate = ($data['BeginDate']) ? $data['BeginDate'] : date("Y-m-d", strtotime($oldDate.' - 1 days'));
        $EndDate = ($data['EndDate']) ? $data['EndDate'] : date("Y-m-d", strtotime($oldDate.' + 60 days'));
        $p = [
            'BeginDate' => $BeginDate.'T00:00:00', //'2022-12-18T00:00:00',
            'EndDate' => $EndDate.'T00:00:00',
            //'BeginDate' => '2023-04-01T00:00:00',
            //'EndDate' => '2023-05-01T00:00:00',
            //'FromArea' => '3, 8, 10',
            //'ToArea' => 3370,
            'FromArea' => 3345,
            'ToCountry' => $countryID, //'1, 12, 35',
            //'ToCountry' => 42, //'1, 12, 35',
            //'ToPlace' => '3370, 3371, 3372, 3373, 3374, 3376, 11788, 11789, 12097, 13328, 13679',
            //'ToPlace' => '79, 106',
            'ToPlace' => '',
            //'HotelCategoryGroup' => '4, 5',
            'HotelCategoryGroup' => '',
            //'RoomCategoryGroup' => '1, 2',
            'RoomCategoryGroup' => '',
            //'MealCategory' => '5, 6',
            'MealCategory' => '',
            //'Hotel' => '10726, 300',
            'Hotel' => '',
            'MinPrice' => 0,
            'MaxPrice' => 0,
            'BeginNight' => 0, //7
            'EndNight' => 30,  //15
            'Adult' => 2,
            'Child' => 1,
            'OnlyAvailableFlight' => false,
            'NotShowStopSale' => false,
            'ShowOnlyConfirm' => false,
            'StartIndex' => 1,
            'PageSize' => 100,
            'Currency' => 3,
            'RoomFilterGroup' => 0,
            ///'HotelConcept' => '',
            'Recommended' => false
        ];

        if ($data) {
            foreach ($data as $key => $value) {
                $p[$key] = $value;
            }
        }
        $dd = $json = json_encode($p, JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT);
file_put_contents('D:\OSPanel54\domains\turisty.loc\frontend\web\hd.txt', $dd, FILE_APPEND);
        return $p;
    }

}
