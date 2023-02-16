<?php

namespace console\controllers;

use Yii;

use console\models\CronLog;

use frontend\models\CoraltravelRoomFilterGroup;

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
        self::setCountry();
    }

    public function actionRegion()
    {
        self::setRegion();
    }

    public function actionArea()
    {
        self::setArea();
    }

    public function actionPlace()
    {
        self::setPlace();
    }

    public function actionGeography()
    {
        self::setGeography();
    }

    public function actionCurrency()
    {
        self::setCurrency();
    }

    public function actionHotelCategory()
    {
        self::setHotelCategory();
    }

    public function actionHotelCategoryGroup()
    {
        self::setHotelCategoryGroup();
    }

    public function actionHotelConcept()
    {
        self::setHotelConcept();
    }

    public function actionRoomCategory()
    {
        self::setRoomCategory();
    }

    public function actionRoomCategoryGroup()
    {
        self::setRoomCategoryGroup();
    }

    public function actionRoomFilterGroup()
    {
        self::setRoomFilterGroup();
    }

    public function actionRoom()
    {
        self::setRoom();
    }

    public function actionHotel()
    {
        self::setHotel();
    }

    public function actionAllMeal()
    {
        self::setMealCategory();
        self::setMeal();
    }

    public function actionMealCategory()
    {
        self::setMealCategory();
    }
    
    public function actionMeal()
    {
        self::setMeal();
    }

    public function actionAcc()
    {
        self::setAcc();
    }

    public function actionSeatClass()
    {
        self::setSeatClass();
    }

    public function actionFlightSupplier()
    {
        self::setFlightSupplier();
    }

    public function actionAirport()
    {
        self::setAirport();
    }

    public function actionToCountry()
    {
        self::setToCountry();
    }

    private static function addLog($model, $t)
    {
        $data = [];
        $log = new CronLog();
        $data['errors'] = \yii\helpers\Json::encode($model->getErrors());
        $data['data'] = \yii\helpers\Json::encode($model);
        $data['type'] = $t;
        $log::add($data);
    }

    private static function setRegion()
    {
        $data = Yii::$app->api->getListRegion();

        if ($data['status'] != 'success')
          return;

        if ($data['data']) {
            foreach ($data['data'] as $value) {
                $model = \console\models\CoraltravelRegion::findOne($value['ID']);

                if (!$model)
                  $model = new \console\models\CoraltravelRegion();

                $model->attributes = $value;

                if ($value['ID'] == 151)
                  print_r($value);

                if (!$model->save()) {
                    self::addLog($model, 'region');
                }
            }
        }
    }

    private static function setCountry()
    {
        $data = Yii::$app->api->getListCountry();

        if ($data['status'] != 'success' || !$data['data'])
          return;

        foreach ($data['data'] as $value) {
            $model = \console\models\CoraltravelCountry::findOne($value['ID']);

            if (!$model)
              $model = new \console\models\CoraltravelCountry();

            $model->attributes = $value;

            $model->IsMarket = (int)$value['IsMarket'];
            $model->IsDestination = (int)$value['IsDestination'];

            if (!$model->save()) {
                self::addLog($model, 'country');
            }
        }
    }

    private static function setArea()
    {
        $data = Yii::$app->api->getListArea();

        if ($data['status'] != 'success' || !$data['data'])
          return;

        foreach ($data['data'] as $value) {
            $model = \console\models\CoraltravelArea::findOne($value['ID']);

            if (!$model)
              $model = new \console\models\CoraltravelArea();

            $model->attributes = $value;

            if (!$model->save()) {
                self::addLog($model, 'area');
            }
        }
    }

    private static function setPlace()
    {
        $data = Yii::$app->api->getListPlace();

        if ($data['status'] != 'success' || !$data['data'])
          return;

        foreach ($data['data'] as $value) {
            $model = \console\models\CoraltravelPlace::findOne($value['ID']);

            if (!$model)
              $model = new \console\models\CoraltravelPlace();

            $model->attributes = $value;

            if (!$model->save()) {
                self::addLog($model, 'place');
            }
        }
    }

    private static function setGeography()
    {
        $data = Yii::$app->api->getListGeography();

        if ($data['status'] != 'success' || !$data['data'])
          return;

        foreach ($data['data'] as $value) {

            /*$name = $tr->translate($this->source, $this->target, $value['Name'], $this->attempts);
            $place_id = self::getPlaceId($value['PlaceName']);
            $area_id = self::getPlaceId($value['AreaName']);
            $region_id = self::getPlaceId($value['RegionName']);
            $country_id = self::getPlaceId($value['CountryName']);*/

            $model = \console\models\CoraltravelGeography::find()
            ->where(['CountryID' => $value['CountryID']])
            ->andWhere(['RegionID' => $value['RegionID']])
            ->andWhere(['AreaID' => $value['AreaID']])
            ->andWhere(['PlaceID' => $value['PlaceID']])
            ->one();

            if (!$model)
              $model = new \console\models\CoraltravelGeography();

            $model->attributes = $value;

            if (!$model->save()) {
                self::addLog($model, 'Geography');
            }
        }
    }

    private static function setCurrency()
    {
        $data = Yii::$app->api->getListCurrency();

        if ($data['status'] != 'success' || !$data['data'])
          return;

        foreach ($data['data'] as $value) {
            $model = \console\models\CoraltravelCurrency::findOne([$value['ID']]);

            if (!$model)
              $model = new \console\models\CoraltravelCurrency();

            $model->attributes = $value;

            if (!$model->save()) {
                self::addLog($model, 'Currency');
            }
        }
    }

    private static function setHotelCategory()
    {
        $data = Yii::$app->api->getListHotelCategory();

        if ($data['status'] != 'success' || !$data['data'])
          return;

        foreach ($data['data'] as $value) {
            $model = \console\models\CoraltravelHotelCategory::findOne($value['ID']);

            if (!$model)
              $model = new \console\models\CoraltravelHotelCategory();

            $model->attributes = $value;

            if (!$model->save()) {
                self::addLog($model, 'Hotel Category');
            }
        }
    }

    private static function setHotelCategoryGroup()
    {
        $data = Yii::$app->api->getListHotelCategoryGroup();

        if ($data['status'] != 'success' || !$data['data'])
          return;

        foreach ($data['data'] as $value) {

            $categoryGroup = \console\models\CoraltravelHotelCategoryGroup::findOne($value['ID']);

            if (!$categoryGroup)
              $categoryGroup = new \console\models\CoraltravelHotelCategoryGroup();

            $categoryGroup->ID = $value['ID'];
            $categoryGroup->Name = $value['Name'];
            $categoryGroup->SName = $value['SName'];

            if ($categoryGroup->save()) {
                if ($value['HotelCategoryList']) {
                    foreach ($value['HotelCategoryList'] as $val) {
                        $model = \console\models\CoraltravelHotelCathotGroupHotel::find()
                        ->where(['group_id' => $categoryGroup->ID])
                        ->andWhere(['category_id' => $val['ID']])
                        ->one();

                        if (!$model)
                          $model = new \console\models\CoraltravelHotelCathotGroupHotel();

                        $model->category_id = $val['ID'];
                        $model->group_id = $categoryGroup->ID;

                        if (!$model->save()) {
                            if (isset($model->getErrors()['category_id'])) {
                                $coraltravelHotelCategory = new \console\models\CoraltravelHotelCategory();
                                $coraltravelHotelCategory->attributes = $val;

                                if ($coraltravelHotelCategory->save()) {
                                    if (!$model->save()) {
                                        self::addLog($model, 'Hotel Category Group Hotel');
                                    }
                                } else {
                                    self::addLog($coraltravelHotelCategory, 'Hotel Category gr');
                                }

                            } else {
                                self::addLog($model, 'Hotel Category Group Hotel');
                            }
                        }
                    }
                }

            } else {
                self::addLog($categoryGroup, 'Hotel Category Group');
            }
        }
    }

    private static function setHotelConcept()
    {
        $data = Yii::$app->api->getListHotelConcept();

        if ($data['status'] != 'success' || !$data['data'])
          return;

        foreach ($data['data'] as $value) {

            $model = \console\models\CoraltravelHotelConcept::findOne($value['ID']);

            if (!$model)
              $model = new \console\models\CoraltravelHotelConcept();

            $model->ID = $value['ID'];
            $model->Name = $value['Name'];

            if (!$model->save()) {
                self::addLog($model, 'Hotel Concept');
            }
        }
    }

    private static function setRoomCategory()
    {
        $data = Yii::$app->api->getListRoomCategory();

        if ($data['status'] != 'success' || !$data['data'])
          return;

        foreach ($data['data'] as $value) {

            $model = \console\models\CoraltravelRoomCategory::findOne($value['ID']);

            if (!$model)
              $model = new \console\models\CoraltravelRoomCategory();

            $model->ID = $value['ID'];
            $model->Name = $value['Name'];
            $model->LName = $value['LName'];

            if (!$model->save()) {
                self::addLog($model, 'Room Category');
            }
        }
    }

    private static function setRoomCategoryGroup()
    {
        $data = Yii::$app->api->getListRoomCategoryGroup();

        if ($data['status'] != 'success' || !$data['data'])
          return;

        foreach ($data['data'] as $value) {

            $roomGroup = \console\models\CoraltravelRoomCategoryGroup::findOne($value['ID']);

            if (!$roomGroup)
              $roomGroup = new \console\models\CoraltravelRoomCategoryGroup();

            $roomGroup->ID = $value['ID'];
            $roomGroup->Name = $value['Name'];
            $roomGroup->SName = $value['SName'];

            if ($roomGroup->save()) {
                if ($value['RoomCategoryList']) {
                    foreach ($value['RoomCategoryList'] as $val) {
                        $roomCategory = \console\models\CoraltravelRoomCategory::findOne($val['ID']);

                        if (!$roomCategory) {
                            $roomCategory = new \console\models\CoraltravelRoomCategory();
                            $roomCategory->attributes = $val;

                            if (!$roomCategory->save()) {
                                self::addLog($roomCategory, 'Room Category');
                            }
                        }
                        $category_id = $roomCategory->ID;
                        $group_id = $roomGroup->ID;

                        $catGroup = \console\models\CoraltravelRoomCatroomGroupRoom::find()
                         ->where(['category_id' => $category_id])
                         ->andWhere(['group_id' => $group_id])
                         ->one();

                        if (!$catGroup)
                          $catGroup = new \console\models\CoraltravelRoomCatroomGroupRoom();

                          if (!$catGroup->save()) {
                              self::addLog($roomCategory, 'Room Category Group Category');
                          }
                    }
                }
            } else {
                self::addLog($roomGroup, 'Room Category Group');
            }
        }
    }

    private static function setRoomFilterGroup()
    {
        $data = Yii::$app->api->getListRoomFilterGroup();

        if ($data['status'] != 'success' || !$data['data'])
          return;

        foreach ($data['data'] as $value) {
            $model = \console\models\CoraltravelRoomFilterGroup::findOne($value['ID']);

            if (!$model)
              $model = new \console\models\CoraltravelRoomFilterGroup();

            $model->attributes = $value;
            $model->CancelStatus = (int)$value['CancelStatus'];

            if (!$model->save()) {
                self::addLog($model, 'Room Filter Group');
            }
        }
    }

    private static function setRoom()
    {
        $data = Yii::$app->api->getListRoom();

        if ($data['status'] != 'success' || !$data['data'])
          return;

        foreach ($data['data'] as $value) {
            $model = \console\models\CoraltravelRoom::findOne($value['ID']);

            if (!$model)
              $model = new \console\models\CoraltravelRoom();

            $model->attributes = $value;
            $model->Hotel = (int)$value['Hotel'];
            $model->isIRO = (int)$value['isIRO'];
            $model->CategoryID = (int)$value['RoomCategory']['ID'];

            if (!$model->save()) {
                self::addLog($model, 'room');
            }
        }
    }

    private static function setHotel()
    {
        $data = Yii::$app->api->getListHotel();

        if ($data['status'] != 'success' || !$data['data'])
          return;

        foreach ($data['data'] as $value) {
            $model = \console\models\CoraltravelHotel::findOne($value['ID']);

            if (!$model)
              $model = new \console\models\CoraltravelHotel();

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
                self::addLog($model, 'hotel');
            }
        }
    }

    private static function setMealCategory()
    {
        $data = Yii::$app->api->getListMealCategory();

        if ($data['status'] != 'success' || !$data['data'])
          return;

        foreach ($data['data'] as $value) {
            $model = \console\models\CoraltravelMealCategory::findOne($value['ID']);

            if (!$model)
              $model = new \console\models\CoraltravelMealCategory();

            $model->attributes = $value;

            if (!$model->save()) {
                self::addLog($model, 'Meal Category');
            }
        }
    }

    private static function setMeal()
    {
        $data = Yii::$app->api->getListMeal();

        if ($data['status'] != 'success' || !$data['data'])
          return;

        foreach ($data['data'] as $value) {
            $model = \console\models\CoraltravelMeal::findOne($value['ID']);

            if (!$model)
              $model = new \console\models\CoraltravelMeal();

            $model->attributes = $value;
            $model->InfoSheetMeal = (string)$value['InfoSheetMeal'];
            $model->ConceptTiming = (string)$value['ConceptTiming'];

            if ($model->save()) {
                self::addLog($model, 'Meal');
            }
        }
    }

    private static function setAcc()
    {
        $data = Yii::$app->api->getListAcc();

        if ($data['status'] != 'success' || !$data['data'])
          return;

        foreach ($data['data'] as $value) {

            $model = \console\models\CoraltravelAcc::findOne($value['ID']);

            if (!$model)
              $model = new \console\models\CoraltravelAcc();

            $model->ID = $value['ID'];
            $model->Name = $value['Name'];
            $model->LName = $value['LName'];
            $model->AdultCount = (int)$value['AdultCount'];
            $model->ChildCount = (int)$value['ChildCount'];

            if (!$model->save()) {
                self::addLog($model, 'acc');
            }
        }
    }

    private static function setSeatClass()
    {
        $data = Yii::$app->api->getListSeatClass();

        if ($data['status'] != 'success' || !$data['data'])
          return;

        foreach ($data['data'] as $value) {

            $model = \console\models\CoraltravelSeatClass::findOne($value['ID']);

            if (!$model)
              $model = new \console\models\CoraltravelSeatClass();

            $model->ID = $value['ID'];
            $model->Name = $value['Name'];
            $model->LName = $value['LName'];
            $model->IsDefault = (int)$value['IsDefault'];
            $model->IsUsed = (int)$value['IsUsed'];

            if (!$model->save()) {
                self::addLog($model, 'Seat Class');
            }
        }
    }

    private static function setFlightSupplier()
    {
        $data = Yii::$app->api->getListFlightSupplier();

        if ($data['status'] != 'success' || !$data['data'])
          return;

        foreach ($data['data'] as $value) {

            $model = \console\models\CoraltravelFlightSupplier::findOne($value['ID']);

            if (!$model)
              $model = new \console\models\CoraltravelFlightSupplier();

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
                self::addLog($model, 'Flight Supplier');
            }
        }
    }

    private static function setAirport()
    {
        $data = Yii::$app->api->getListToAirport();

        if ($data['status'] != 'success' || !$data['data'])
          return;

        foreach ($data['data'] as $value) {

            $model = \console\models\CoraltravelAirport::findOne($value['ID']);

            if (!$model)
              $model = new \console\models\CoraltravelAirport();

            $model->attributes = $value;
            $model->CancelStatus = (int)$value['CancelStatus'];

            if (!$model->save()) {
                self::addLog($model, 'Airport');
            }
        }
    }

    private static function setToCountry()
    {
        $data = Yii::$app->api->getListToCountry();

        if ($data['status'] != 'success' || !$data['data'])
          return;

        foreach ($data['data'] as $value) {

            $model = \frontend\models\CoraltravelToCountry::findOne($value['ID']);

            if (!$model)
              $model = new \frontend\models\CoraltravelToCountry();

            $model->attributes = $value;

            if (!$model->save()) {
                self::addLog($model, 'To Country');
            }
        }
    }
}

