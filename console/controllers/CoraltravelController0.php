<?php

namespace console\controllers;

use Yii;
use frontend\models\CoraltravelCountry;
use frontend\models\CountryCountry;
use frontend\models\Country;

use console\models\CoraltravelRegion;

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

class CoraltravelController extends \yii\console\Controller
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

    public function actionCountry()
    {
        $tr = new GoogleTranslateForFree();
        $data = Yii::$app->api->getListCountry();

        if ($data['status'] != 'success')
          return;

        foreach ($data['data'] as $value) {

            $name = $tr->translate($this->source, $this->target, $value['Name'], $this->attempts);

            if (!$name)
              continue;

            $country = Country::find()
            ->where(['iso_code' => $value['ISOCode']])
            ->andWhere(['title' => $name])
            ->one();

            if (!$country) {
                $country = new Country();
            }

            if (!$value['Name'])
              continue;

            $country->title = $name;
            $country->iso_code = $value['ISOCode'];
            $country->activity = 1;

            if ($country->save()) {

                $coraltravelCountry = CoraltravelCountry::findOne($value['ID']);

                if (!$coraltravelCountry)
                  $coraltravelCountry = new CoraltravelCountry();

                $coraltravelCountry->attributes = $value;

                $coraltravelCountry->IsMarket = (int)$value['IsMarket'];
                $coraltravelCountry->IsDestination = (int)$value['IsDestination'];

                /*if (!$value['IsMarket']) {
                  $coraltravelCountry->IsMarket = 0;
                  echo "Ma = ".$coraltravelCountry->IsMarket."\r\n";
                }
                if (!$value['IsDestination']) {
                  $coraltravelCountry->IsDestination = 0;
                  echo "De = ".$coraltravelCountry->IsDestination."\r\n";
                }*/

                if ($coraltravelCountry->save()) {
                    $countryCountry = CountryCountry::find()
                    ->where(['operator' => 'coraltravel'])
                    ->andWhere(['op_country_id' => $coraltravelCountry->ID])
                    ->one();

                    if (!$countryCountry)
                      $countryCountry = new CountryCountry();

                    $countryCountry->operator = 'coraltravel';
                    $countryCountry->op_country_id = $coraltravelCountry->ID;
                    $countryCountry->country_id = $country->id;
                    if (!$countryCountry->save()) {
                        echo "\r\nCountryCountry\r\n";
                        print_r($countryCountry->getErrors());
                        echo "\r\n";
                    }
                } else {
                    echo "\r\nCoraltravelCountry\r\n";
                    print_r($coraltravelCountry->getErrors());
                    echo "\r\n";
                }
            } else {
                echo "\r\nCountry\r\n";
                print_r($country->getErrors());
                print_r($country);
                echo "\r\n";
            }
        }
//die();
            /*$model = new CoraltravelCountry();
            $model->attributes = $value;

            if ($model->IsMarket)
              $model->IsMarket = 0;
            if ($model->IsDestination)
              $model->IsDestination = 0;

            if ($model->save()) {
                $country = Country::findOne(['iso_code' => $model->ISOCode]);
                if (!$country) {
                    $country = new Country();

                    $name = $tr->translate($this->source, $this->target, $model->Name, $this->attempts);

                    if (!$name)
                      continue;


                    if ($country->save()) {
                        $countryCountry = new CountryCountry();
                        $countryCountry->operator = 'coraltravel';
                        $countryCountry->op_country_id = $model->ID;
                        $countryCountry->country_id = $country->id;
                        $countryCountry->save();
                    }
                }
            }*/
        //}
    }

    public function actionRegion()
    {
        $tr = new GoogleTranslateForFree();
        $data = Yii::$app->api->getListRegion();

        if ($data['status'] != 'success')
          return;

        foreach ($data['data'] as $value) {

            $name = $tr->translate($this->source, $this->target, $value['Name'], $this->attempts);

            if (!$name || !$value['CountryID']) {
                echo "N = ".$name."\r\n";
                echo "CountryID = ".$value['CountryID']."\r\n";
                continue;
            }

            $region = Region::findOne(['title' => $name]);

            if (!$region)
              $region = new Region();

            $coraltravelCountry = CoraltravelCountry::findOne([$value['CountryID']]);

            if (!$coraltravelCountry) {
                echo "CountryID = ".$value['CountryID']."\r\n";
                continue;
            }

            $region->title = $name;
            $region->country_id = $coraltravelCountry->country->id;
            $region->activity = 1;

            if ($region->save()) {
                $coraltravelRegion = CoraltravelRegion::findOne($value['ID']);

                if (!$coraltravelRegion)
                  $coraltravelRegion = new CoraltravelRegion();
                                                                      //RegionRegion
                $coraltravelRegion->attributes = $value;

                if ($coraltravelRegion->save()) {

                    /*$region->title = $name;
                    $region->country_id = $country->country_id;
                    $region->activity = 1;*/

                    $regionRegion = RegionRegion::find()
                    ->where(['operator' => 'coraltravel'])
                    ->andWhere(['op_region_id' => $coraltravelRegion->ID])
                    ->one();

                    if (!$regionRegion)
                      $regionRegion = new RegionRegion();

                    $regionRegion->operator = 'coraltravel';
                    $regionRegion->op_region_id = $coraltravelRegion->ID;
                    $regionRegion->region_id = $region->id;

                    if (!$regionRegion->save()) {
                        echo "\r\n--RegionRegion--\r\n";
                        print_r($regionRegion->getErrors());
                        echo "\r\n";
                    }
                } else {
                    echo "\r\n--CoraltravelRegion--\r\n";
                    print_r($coraltravelRegion->getErrors());
                    echo "\r\n";
                }
            } else {
                echo "\r\n--Region--\r\n";
                print_r($region->getErrors());
                echo "\r\n";
            }
        }
    }

    public function actionArea()
    {
        $tr = new GoogleTranslateForFree();
        $data = Yii::$app->api->getListArea();

        if ($data['status'] != 'success')
          return;

        foreach ($data['data'] as $value) {

            $name = $tr->translate($this->source, $this->target, $value['Name'], $this->attempts);

            if (!$name || !$value['RegionID']) {
                echo "N = ".$name."\r\n";
                echo "RegionID = ".$value['RegionID']."\r\n";
                continue;
            }

            $area = Area::findOne(['title' => $name]);

            if (!$area)
              $area = new Area();

            $coraltravelRegion = CoraltravelRegion::findOne([$value['RegionID']]);

            if (!$coraltravelRegion) {
                echo "RegionID = ".$value['RegionID']."\r\n";
                continue;
            }

            $area->title = $name;
            $area->region_id = $coraltravelRegion->region->id;
            $area->activity = 1;

            if ($area->save()) {
                $coraltravelArea = CoraltravelArea::findOne($value['ID']);

                if (!$coraltravelArea)
                  $coraltravelArea = new CoraltravelArea();

                $coraltravelArea->attributes = $value;

                if ($coraltravelArea->save()) {

                    /*$region->title = $name;
                    $region->country_id = $country->country_id;
                    $region->activity = 1;*/

                    $areaArea = AreaArea::find()
                    ->where(['operator' => 'coraltravel'])
                    ->andWhere(['op_area_id' => $coraltravelArea->ID])
                    ->one();

                    if (!$araeArea)
                      $areaArea = new AreaArea();

                    $areaArea->operator = 'coraltravel';
                    $areaArea->op_area_id = $coraltravelArea->ID;
                    $areaArea->area_id = $area->id;

                    if (!$areaArea->save()) {
                        echo "\r\n--RegionRegion--\r\n";
                        print_r($areaArea->getErrors());
                        echo "\r\n";
                    }
                } else {
                    echo "\r\n--CoraltravelRegion--\r\n";
                    print_r($coraltravelArea->getErrors());
                    echo "\r\n";
                }
            } else {
                echo "\r\n--Region--\r\n";
                print_r($area->getErrors());
                echo "\r\n";
            }
        }
    }

    public function actionPlace()
    {
        $tr = new GoogleTranslateForFree();
        $data = Yii::$app->api->getListPlace();

        if ($data['status'] != 'success')
          return;

        foreach ($data['data'] as $value) {

            $name = $tr->translate($this->source, $this->target, $value['Name'], $this->attempts);

            if (!$name || !$value['AreaID']) {
                echo "N = ".$name."\r\n";
                echo "AreaID = ".$value['AreaID']."\r\n";
                continue;
            }

            $place = Place::findOne(['title' => $name]);

            if (!$place)
              $place = new Place();

            $coraltravelArea = CoraltravelArea::findOne([$value['AreaID']]);
            //$area_id = self::getPlaceId($value['AreaName']);

            if (!$coraltravelArea) {
                echo "AreaID = ".$value['AreaID']."\r\n";
                continue;
            }

            $place->title = $name;
            $place->area_id = $coraltravelArea->area->id;
            $place->activity = 1;

            if ($place->save()) {
                $coraltravelPlace = CoraltravelPlace::findOne($value['ID']);

                if (!$coraltravelPlace)
                  $coraltravelPlace = new CoraltravelPlace();

                $coraltravelPlace->attributes = $value;

                if ($coraltravelPlace->save()) {
                    $placePlace = PlacePlace::find()
                    ->where(['operator' => 'coraltravel'])
                    ->andWhere(['op_place_id' => $coraltravelPlace->ID])
                    ->one();

                    if (!$placePlace)
                      $placePlace = new PlacePlace();

                    $placePlace->operator = 'coraltravel';
                    $placePlace->op_place_id = $coraltravelPlace->ID;
                    $placePlace->place_id = $place->id;

                    if (!$placePlace->save()) {
                        echo "\r\n--AreaArea--\r\n";
                        print_r($placePlace->getErrors());
                        echo "\r\n";
                    }
                } else {
                    echo "\r\n--CoraltravelPlace--\r\n";
                    print_r($coraltravelPlace->getErrors());
                    echo "\r\n";
                }
            } else {
                echo "\r\n--Place--\r\n";
                print_r($place->getErrors());
                echo "\r\n";
            }
        }
    }

    public function actionGeography()
    {
        $tr = new GoogleTranslateForFree();
        $data = Yii::$app->api->getListGeography();

        if ($data['status'] != 'success')
          return;

        foreach ($data['data'] as $value) {

            /*$name = $tr->translate($this->source, $this->target, $value['Name'], $this->attempts);
            $place_id = self::getPlaceId($value['PlaceName']);
            $area_id = self::getPlaceId($value['AreaName']);
            $region_id = self::getPlaceId($value['RegionName']);
            $country_id = self::getPlaceId($value['CountryName']);*/

            $coraltravelGeography = CoraltravelGeography::find()
            ->where(['CountryID' => $value['CountryID']])
            ->andWhere(['RegionID' => $value['RegionID']])
            ->andWhere(['AreaID' => $value['AreaID']])
            ->andWhere(['PlaceID' => $value['PlaceID']])
            ->one();

            if (!$coraltravelGeography)
              $coraltravelGeography = new CoraltravelGeography();

            $coraltravelGeography->attributes = $value;

            if (!$coraltravelGeography->save()) {
                echo "\r\n--Geography--\r\n";
                print_r($coraltravelGeography->getErrors());
                print_r($coraltravelGeography);
                echo "\r\n";
            }
        }
    }

    public function actionCurrency()
    {
        $tr = new GoogleTranslateForFree();
        $data = Yii::$app->api->getListCurrency();

        if ($data['status'] != 'success')
          return;

        foreach ($data['data'] as $value) {

            $name = $tr->translate($this->source, $this->target, $value['Name'], $this->attempts);

            if (!$name) {
                echo "N = ".$name."\r\n";
                continue;
            }

            $currency = Currency::findOne(['code' => $value['SName']]);

            if (!$currency)
              $currency = new Currency();

            $currency->title = $name;
            $currency->iso_code = $value['ISOCode'];
            $currency->code = $value['SName'];
            $currency->activity = 1;

            if ($currency->save()) {
                $coraltravelCurrency = CoraltravelCurrency::findOne([$value['ID']]);

                if (!$coraltravelCurrency)
                  $coraltravelCurrency = new CoraltravelCurrency();

                $coraltravelCurrency->attributes = $value;

                if ($coraltravelCurrency->save()) {
                    $currencyCurrency = CurrencyCurrency::find()
                    ->where(['operator' => 'coraltravel'])
                    ->andWhere(['op_currency_id' => $coraltravelCurrency->ID])
                    ->one();

                    if (!$currencyCurrency)
                      $currencyCurrency = new CurrencyCurrency();

                    $currencyCurrency->operator = 'coraltravel';
                    $currencyCurrency->op_currency_id = $coraltravelCurrency->ID;
                    $currencyCurrency->currency_id = $currency->id;

                    if (!$currencyCurrency->save()) {
                        echo "\r\n--CurrencyCurrency--\r\n";
                        print_r($currencyCurrency->getErrors());
                        echo "\r\n";
                    }
                } else {
                    echo "\r\n--CoraltravelCurrency--\r\n";
                    print_r($coraltravelCurrency->getErrors());
                    echo "\r\n";
                }
            } else {
                echo "\r\n--Currency--\r\n";
                print_r($currency->getErrors());
                echo "\r\n";
            }
        }
    }

    public function actionHotelCategory()
    {
        $tr = new GoogleTranslateForFree();
        $data = Yii::$app->api->getListHotelCategory();

        if ($data['status'] != 'success')
          return;

        foreach ($data['data'] as $value) {

            $name = $tr->translate($this->source, $this->target, $value['Name'], $this->attempts);
            $ShortName = $tr->translate($this->source, $this->target, $value['ShortName'], $this->attempts);

            if (!$name) {
                echo "N = ".$name."\r\n";
                continue;
            }

            $hotelCategory = HotelCategory::findOne(['title' => $name]);

            if (!$hotelCategory)
              $hotelCategory = new HotelCategory();

            $hotelCategory->title = $name;
            $hotelCategory->short_title = $ShortName;
            $hotelCategory->activity = 1;

            if ($hotelCategory->save()) {
                $coraltravelHotelCategory = CoraltravelHotelCategory::findOne($value['ID']);

                if (!$coraltravelHotelCategory)
                  $coraltravelHotelCategory = new CoraltravelHotelCategory();

                $coraltravelHotelCategory->attributes = $value;

                if ($coraltravelHotelCategory->save()) {
                    $hotelCategoryHotel = HotelCategoryHotel::find()
                    ->where(['operator' => 'coraltravel'])
                    ->andWhere(['op_category_id' => $coraltravelHotelCategory->ID])
                    ->one();

                    if (!$hotelCategoryHotel)
                      $hotelCategoryHotel = new HotelCategoryHotel();

                    $hotelCategoryHotel->operator = 'coraltravel';
                    $hotelCategoryHotel->op_category_id = $coraltravelHotelCategory->ID;
                    $hotelCategoryHotel->category_id = $hotelCategory->id;

                    if (!$hotelCategoryHotel->save()) {
                        echo "\r\n--hotelCategoryHotel--\r\n";
                        print_r($hotelCategoryHotel->getErrors());
                        echo "\r\n";
                    }
                } else {
                    echo "\r\n--CoraltravelPlace--\r\n";
                    print_r($coraltravelHotelCategory->getErrors());
                    echo "\r\n";
                }
            } else {
                echo "\r\n--Place--\r\n";
                print_r($hotelCategory->getErrors());
                echo "\r\n";
            }
        }
    }

    public function actionHotelCategoryGroup()
    {
        $tr = new GoogleTranslateForFree();
        $data = Yii::$app->api->getListHotelCategoryGroup();

        if ($data['status'] != 'success')
          return;

        foreach ($data['data'] as $value) {

            $categoryGroup= CoraltravelHotelCategoryGroup::findOne($value['ID']);

            if (!$categoryGroup)
              $categoryGroup = new CoraltravelHotelCategoryGroup();

            $categoryGroup->ID = $value['ID'];
            $categoryGroup->Name = $value['Name'];
            $categoryGroup->SName = $value['SName'];

            if ($categoryGroup->save()) {
                if ($value['HotelCategoryList']) {
                    foreach ($value['HotelCategoryList'] as $val) {
                        $model = CoraltravelHotelCathotGroupHotel::find()
                        ->where(['group_id' => $categoryGroup->ID])
                        ->andWhere(['category_id' => $val['ID']])
                        ->one();

                        if (!$model)
                          $model = new CoraltravelHotelCathotGroupHotel();

                        $model->category_id = $val['ID'];
                        $model->group_id = $categoryGroup->ID;

                        if (!$model->save()) {
                            echo "\r\n--Model--\r\n";
                            if (isset($model->getErrors()['category_id'])) {
                                $coraltravelHotelCategory = new CoraltravelHotelCategory();
                                $coraltravelHotelCategory->attributes = $val;

                                if ($coraltravelHotelCategory->save()) {
                                    $model->save();
                                }

                            }
                        }
                    }
                }

            } else {
                echo "\r\n--categoryGroup--\r\n";
                print_r($categoryGroup->getErrors());
                print_r($categoryGroup);
                echo "\r\n";
            }
        }
    }

    public function actionHotelConcept()
    {
        $tr = new GoogleTranslateForFree();
        $data = Yii::$app->api->getListHotelConcept();

        if ($data['status'] != 'success')
          return;

        foreach ($data['data'] as $value) {

            $concept = CoraltravelHotelConcept::findOne($value['ID']);

            if (!$concept)
              $concept = new CoraltravelHotelConcept();

            $concept->ID = $value['ID'];
            $concept->Name = $value['Name'];

            if (!$concept->save()) {
                echo "\r\n--categoryGroup--\r\n";
                print_r($concept->getErrors());
                print_r($concept);
                echo "\r\n";
            }
        }
    }

    public function actionRoomCategory()
    {
        $tr = new GoogleTranslateForFree();
        $data = Yii::$app->api->getListRoomCategory();

        if ($data['status'] != 'success')
          return;

        foreach ($data['data'] as $value) {

            $model = CoraltravelRoomCategory::findOne($value['ID']);

            if (!$model)
              $model = new CoraltravelRoomCategory();

            $model->ID = $value['ID'];
            $model->Name = $value['Name'];
            $model->LName = $value['LName'];

            if (!$model->save()) {
                print_r($model);
            }
        }
    }

    public function actionRoomCategoryGroup()
    {
        $tr = new GoogleTranslateForFree();
        $data = Yii::$app->api->getListRoomCategoryGroup();

        if ($data['status'] != 'success')
          return;

        foreach ($data['data'] as $value) {

            $roomGroup = CoraltravelRoomCategoryGroup::findOne($value['ID']);

            if (!$roomGroup)
              $roomGroup = new CoraltravelRoomCategoryGroup();

            $roomGroup->ID = $value['ID'];
            $roomGroup->Name = $value['Name'];
            $roomGroup->SName = $value['SName'];

            if ($roomGroup->save()) {
                if ($value['RoomCategoryList']) {
                    foreach ($value['RoomCategoryList'] as $val) {
                        $model = CoraltravelRoomCatroomGroupRoom::find()
                        ->where(['group_id' => $roomGroup->ID])
                        ->andWhere(['category_id' => $val['ID']])
                        ->one();

                        if (!$model)
                          $model = new CoraltravelRoomCatroomGroupRoom();

                        $model->category_id = $val['ID'];
                        $model->group_id = $roomGroup->ID;

                        if (!$model->save()) {
                            echo "\r\n--Model--\r\n";
                            if (isset($model->getErrors()['category_id'])) {
                                $roomCategory = new CoraltravelRoomCategory();
                                $roomCategory->attributes = $val;

                                if ($roomCategory->save()) {
                                    $model->save();
                                }
                            }
                        }
                    }
                }
            } else {
                echo "\r\n--categoryGroup--\r\n";
                print_r($roomGroup->getErrors());
                print_r($roomGroup);
                echo "\r\n";
            }
        }
    }

    public function actionRoomFilterGroup()
    {
        $data = Yii::$app->api->getListRoomFilterGroup();

        if ($data['status'] != 'success')
          return;

        foreach ($data['data'] as $value) {
            $model = CoraltravelRoomFilterGroup::findOne($value['ID']);

            if (!$model)
              $model = new CoraltravelRoomFilterGroup();

            $model->attributes = $value;
            $model->CancelStatus = (int)$value['CancelStatus'];

            if (!$model->save()) {
                echo "\r\n--Model--\r\n";
                print_r($model->getErrors());
                print_r($model);
                echo "\r\n";
            }
        }
    }

    public function actionRoom()
    {
        $data = Yii::$app->api->getListRoom();

        if ($data['status'] != 'success')
          return;

        foreach ($data['data'] as $value) {
            $model = CoraltravelRoom::findOne($value['ID']);

            if (!$model)
              $model = new CoraltravelRoom();

            $model->attributes = $value;
            $model->Hotel = (int)$value['Hotel'];
            $model->isIRO = (int)$value['isIRO'];
            $model->CategoryID = (int)$value['RoomCategory']['ID'];

            if (!$model->save()) {
                echo "\r\n--Model--\r\n";
                print_r($model->getErrors());
                print_r($model);
                echo "\r\n";
            }
        }
    }

    public function actionHotel()
    {
        $data = Yii::$app->api->getListHotel();

        if ($data['status'] != 'success')
          return;

        foreach ($data['data'] as $value) {
            $model = CoraltravelHotel::findOne($value['ID']);

            if (!$model)
              $model = new CoraltravelHotel();

            $model->attributes = $value;
            $model->OperatorSaleCategory = (int)$value['OperatorSaleCategory'];
            $model->disableOnB2C = (int)$value['disableOnB2C'];
            $model->tripAdvisorCommentCount = (int)$value['tripAdvisorCommentCount'];
            $model->dontShowTripAdvisorComments = (int)$value['dontShowTripAdvisorComments'];
            $model->GiataCode = (int)$value['GiataCode'];

            if (!$value['tripAdvisorPoint'])
              $model->tripAdvisorPoint = 0.0;

            $model->Latitude = trim($model->Latitude, '.');
            $model->Latitude = trim($model->Latitude, ',');

            $model->Longitude = trim($model->Longitude, '.');
            $model->Longitude = trim($model->Longitude, ',');

            if (!preg_match('/^-?\d{1,2}\.\d{0,15}$/', $model->Latitude))
              $model->Latitude = 0;
            if (!preg_match('/^-?\d{1,2}\.\d{0,15}$/', $model->Longitude))
              $model->Longitude = 0;

            if (!$model->Latitude)
              $model->Latitude = 0.0;

            if (!$model->Longitude)
              $model->Longitude = 0.0;

            if (!$model->save()) {
                echo "\r\n--Model--\r\n";
                print_r($model->getErrors());
                print_r($model);
                echo "\r\n";
                die();
            }
        }
    }

    public function actionMealCategory()
    {
        $data = Yii::$app->api->getListMealCategory();

        if ($data['status'] != 'success')
          return;

        foreach ($data['data'] as $value) {
            $model = \frontend\models\CoraltravelMealCategory::findOne($value['ID']);

            if (!$model)
              $model = new \frontend\models\CoraltravelMealCategory();

            $model->attributes = $value;

            if (!$model->save()) {
                echo "\r\n--Model--\r\n";
                print_r($model->getErrors());
                print_r($model);
                echo "\r\n";
            }
        }
    }

    public function actionMeal()
    {
        $data = Yii::$app->api->getListMeal();

        if ($data['status'] != 'success')
          return;

        foreach ($data['data'] as $value) {
            $model = \frontend\models\CoraltravelMeal::findOne($value['ID']);

            if (!$model)
              $model = new \frontend\models\CoraltravelMeal();

            $model->attributes = $value;
            $model->InfoSheetMeal = (string)$value['InfoSheetMeal'];
            $model->ConceptTiming = (string)$value['ConceptTiming'];

            if ($model->save()) {
                if ($value['MealCategory']) {
                    $mealCategory = \frontend\models\CoraltravelMealCategoryMeal::find()
                     ->where(['meal_id' => $model->ID])
                     ->andWhere(['category_id' => $value['MealCategory']['ID']])
                     ->one();

                     if (!$mealCategory)
                       $mealCategory = new \frontend\models\CoraltravelMealCategoryMeal();

                     $mealCategory->category_id = $value['MealCategory']['ID'];
                     $mealCategory->meal_id = $model->ID;

                     if (!$mealCategory->save()) {
                         echo "\r\n--mealCategory--\r\n";
                         print_r($mealCategory->getErrors());
                         print_r($mealCategory);
                         echo "\r\n";
                         /*if (isset($mealCategory->getErrors()['category_id'])) {
                             $roomCategory = new CoraltravelRoomCategory();
                             $roomCategory->attributes = $val;

                             if ($roomCategory->save()) {
                                 $model->save();
                             }
                         }*/
                     }
                }
            } else {
                echo "\r\n--Model--\r\n";
                print_r($model->getErrors());
                print_r($model);
                echo "\r\n";
            }
        }
    }

    public function actionAcc()
    {
        $tr = new GoogleTranslateForFree();
        $data = Yii::$app->api->getListAcc();

        if ($data['status'] != 'success')
          return;

        foreach ($data['data'] as $value) {

            $model = \frontend\models\CoraltravelAcc::findOne($value['ID']);

            if (!$model)
              $model = new \frontend\models\CoraltravelAcc();

            $model->ID = $value['ID'];
            $model->Name = $value['Name'];
            $model->LName = $value['LName'];
            $model->AdultCount = (int)$value['AdultCount'];
            $model->ChildCount = (int)$value['ChildCount'];

            if (!$model->save()) {
                print_r($model);
            }
        }
    }

    public function actionSeatClass()
    {
        $tr = new GoogleTranslateForFree();
        $data = Yii::$app->api->getListSeatClass();

        if ($data['status'] != 'success')
          return;

        foreach ($data['data'] as $value) {

            $model = \frontend\models\CoraltravelSeatClass::findOne($value['ID']);

            if (!$model)
              $model = new \frontend\models\CoraltravelSeatClass();

            $model->ID = $value['ID'];
            $model->Name = $value['Name'];
            $model->LName = $value['LName'];
            $model->IsDefault = (int)$value['IsDefault'];
            $model->IsUsed = (int)$value['IsUsed'];

            if (!$model->save()) {
                print_r($model);
            }
        }
    }

    public function actionFlightSupplier()
    {
        $data = Yii::$app->api->getListFlightSupplier();

        if ($data['status'] != 'success')
          return;

        foreach ($data['data'] as $value) {

            $model = \frontend\models\CoraltravelFlightSupplier::findOne($value['ID']);

            if (!$model)
              $model = new \frontend\models\CoraltravelFlightSupplier();

            $model->ID = $value['ID'];
            $model->Name = trim($value['Name']);
            $model->Lname = trim($value['Lname']);
            $model->IsUsed = (int)$value['IsUsed'];
            $model->TransportType = (int)$value['TransportType'];
            $model->CancelStatus = (int)$value['CancelStatus'];

            $model->Logo = trim($value['Logo']);
            $model->Code = trim($value['Code']);
            $model->AccountingCode = trim($value['AccountingCode']);

            if (!$model->save()) {
                print_r($model);
            }
        }
    }

    public function actionAirport()
    {
        $data = Yii::$app->api->getListToAirport();

        if ($data['status'] != 'success')
          return;

        foreach ($data['data'] as $value) {

            $model = \frontend\models\CoraltravelAirport::findOne($value['ID']);

            if (!$model)
              $model = new \frontend\models\CoraltravelAirport();

            $model->attributes = $value;
            $model->CancelStatus = (int)$value['CancelStatus'];

            if (!$model->save()) {
                print_r($model->getErrors());
                print_r($model);
                die();
            }
        }
    }

    public function actionToCountry()
    {
        $data = Yii::$app->api->getListToCountry();

        if ($data['status'] != 'success')
          return;

        foreach ($data['data'] as $value) {

            $model = \frontend\models\CoraltravelToCountry::findOne($value['ID']);

            if (!$model)
              $model = new \frontend\models\CoraltravelToCountry();

            $model->attributes = $value;

            if (!$model->save()) {
                print_r($model->getErrors());
                print_r($model);
                die();
            }
        }
    }

}
