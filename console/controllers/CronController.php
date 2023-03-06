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

use console\models\CronTours;
use console\models\CronToursItems;

use Dejurin\GoogleTranslateForFree;

use yii\helpers\ArrayHelper;

use frontend\models\Tours;

use console\models\CronLog;

class CronController extends \yii\console\Controller
{
    private $source = 'en';
    private $target = 'lv';
    private $attempts = 5;
    private $operator = 'coraltravel';
    private $cron_id;
    private $duplicates;
    private $upd;
    private $add;

    public function init()
    {
        ini_set('memory_limit', '4096M');
    }

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
        $subQuery = (new \yii\db\Query())
        ->select('ToCountryID')
        ->from('hot_deals')
        ->groupBy('ToCountryID');

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
        /*$r = \yii\helpers\ArrayHelper::getColumn($data, 'coraltravelAvailableDateItems');
        return \yii\helpers\ArrayHelper::map($r, 'ToAreaID', 'ToCountryID');*/
    }

    public function getCountryByPackageId($package_id)
    {
        $q = \frontend\models\CoraltravelPackageAvailableDate::find()
        ->where(['id' => $package_id])
        ->with('coraltravelAvailableDateItems')
        ->asArray();
        $model = $q->all();
        return $model;
    }

    //public function actionGetCountryForDate()
    private static function getCountryForDate($full = true)
    {
        $date = strtotime(date('Y-m-d 00:00:00'));
        //$date = Yii::$app->formatter->asTimestamp(date('Y-m-d 00:00:00'));

        $q = \frontend\models\CoraltravelPackageAvailableDate::find()
        ->where(['FromArea' => 3345])
        //->andWhere(['>', 'PackageDate', $date])
        ->andWhere([">", "(date_format(FROM_UNIXTIME(PackageDate), '%Y-%m-%d'))", new \yii\db\Expression('DATE(NOW())')])
        ->andWhere(["<", "(date_format(FROM_UNIXTIME(PackageDate), '%Y-%m-%d'))", new \yii\db\Expression('DATE(DATE_ADD(NOW(), INTERVAL 6 MONTH))')])
        ->with('coraltravelAvailableDateItems')
        ->asArray();

        if ($full === false) {
            /*$sql = (new \yii\db\Query())
            ->select('package_id')
            ->from('cron_tours_items')
            ->where(['status' => [4, 9]])
            ->andWhere(['>', 'package_id', 0]);
            $q->andWhere(['NOT IN', 'id', $sql])
            ->limit(1);*/
        } else {
            $q->joinWith('coraltravelAvailableDateItems')
            ->orderBy(['{{%coraltravel_available_date_items}}.ToCountryId' => SORT_DESC, 'PackageDate' => SORT_ASC]);
        }
        //->orderBy(['id' => SORT_DESC])
        //->limit(2)
        //echo $q->prepare(\Yii::$app->db->queryBuilder)->createCommand()->rawSql;die();

        $data = $q->all();

        return $data;
        $result = [];
        $r = \yii\helpers\ArrayHelper::getColumn($data, 'coraltravelAvailableDateItems');

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
        \frontend\models\CoraltravelPackageAvailableDate::deleteAll([
            "<=",
            "(date_format(FROM_UNIXTIME(PackageDate), '%Y-%m-%d'))", new \yii\db\Expression('DATE(NOW())')
        ]);
        if ($data['status'] == 'success') {
            foreach ($data['data'] as $value) {
                //$dat = strtotime($value['PackageDate']);
                //$dat = strtotime(date('Y-m-d', strtotime($value['PackageDate']).' 00:00:00'));
                $dat = date('Y-m-d', strtotime($value['PackageDate']));

                $model = \frontend\models\CoraltravelPackageAvailableDate::find()
                ->where(['FromArea' => $value['FromArea']])
                //->andWhere(['PackageDate' => $dat])
                //->andWhere(["(date_format(FROM_UNIXTIME(PackageDate), '%Y-%m-%d'))" => new \yii\db\Expression('DATE(NOW())')])
                ->andWhere(["(date_format(FROM_UNIXTIME(PackageDate), '%Y-%m-%d'))" => $dat])
                ->one();

                if (!$model)
                  $model = new \frontend\models\CoraltravelPackageAvailableDate();

                $dat = Yii::$app->formatter->asTimestamp($value['PackageDate']);

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
                                    echo "\r\nitem\r\n";
                                }
                            } catch (\Exception $e) {
                                //print_r($e);
                            }
                        }
                    }
                } else {
                    print_r($model->getErrors());
                    echo "\r\nactionGetPackageAvailableDate\r\n";
                }

            }
        }
    }

    public static function country()
    {
        $date = strtotime(date('Y-m-d 00:00:00'));
        //$date = Yii::$app->formatter->asTimestamp(date('Y-m-d 00:00:00'));

        $q = \frontend\models\CoraltravelPackageAvailableDate::find()
        ->where(['FromArea' => 3345])
        //->andWhere(['>', 'PackageDate', $date])
        ->andWhere([">", "(date_format(FROM_UNIXTIME(PackageDate), '%Y-%m-%d'))", new \yii\db\Expression('DATE(NOW())')])
        ->with('coraltravelAvailableDateItems')
        ->asArray();

        if ($full === false) {
            $sql = (new \yii\db\Query())
            ->select('package_id')
            ->from('cron_tours_items')
            ->where(['status' => [4, 9]])
            ->andWhere(['>', 'package_id', 0]);
            $q->andWhere(['NOT IN', 'id', $sql])
            ->limit(1);
        }
        //->orderBy(['id' => SORT_DESC])
        //->limit(2)
        //echo $q->prepare(\Yii::$app->db->queryBuilder)->createCommand()->rawSql;die();

        $data = $q->all();
        return $data;
    }

    public function actionGetToursByArea()
    {
        echo "Start: ".Yii::$app->formatter->asDatetime(time())."\r\n";
        $hour = 4;
        $package_id = 0;
        $date = Yii::$app->formatter->asTimestamp(date('Y-m-d 00:00:00'));
        //$date = Yii::$app->formatter->date();
        //die($date);
        $connection = Yii::$app->db;
        /*$connection->createCommand()->update('tours', ['activity' => 0], 'FlightDate <= '.$date)
        ->execute();*/

        $q = CronTours::find()
        ->where(['!=', 'status', CronToursItems::STATUS_END])
        ->andWhere(['type' => 'area'])
        ->with('cronToursItems');
        $model = $q->one();
        //echo $q->prepare(\Yii::$app->db->queryBuilder)->createCommand()->rawSql;die("---");
        /*echo (time() - $model->updated_at)/3600;
        echo "\r\n";
        echo date('d.m.Y H:i:s', $model->updated_at);
        echo "\r\n";
        echo $model->id;
        echo "\r\n";*/
        //die();
        if ($q->count()) {
            if ((time() - $model->updated_at)/3600 > $hour) {
                //$item = $model->getCronToursItems()->select('package_id')->where(['!=', 'status', 9])
                $item = $model->getCronToursItems()
                ->select([
                    'id AS item_id',
                    'package_id',
                    'ToCountry AS ToCountryID',
                    'Adult',
                    'Child',
                ])
                ->where(['!=', 'status', CronToursItems::STATUS_END])
                ->andWhere(['>', '(unix_timestamp(NOW()) - `updated_at`)/3600', $hour])
                ->asArray()
                ->all();
                //echo $item->prepare(\Yii::$app->db->queryBuilder)->createCommand()->rawSql;die("---");

                if (!empty($item)) {
                    $model->status = CronToursItems::STATUS_SUCCESS;
                    ///$model->save();
                    $package_id = ArrayHelper::getValue($item[0], 'package_id');
                    $country = self::getCountryByPackageId($package_id);

                    if ($country) {
                        $country[0]['coraltravelAvailableDateItems'] = $item;
                    }
                } else {
                    $model->status = CronToursItems::STATUS_END;
                    ///$model->save();
                    unset($model);
                    $country = self::getCountryForDate(false);
                }
            } else {
                unset($model);
                $country = self::getCountryForDate(false);
            }
        } else {
            unset($model);
            $country = self::getCountryForDate(false);
        }

        if ($country) {
            if (empty($model)) {
                $model = new CronTours();
                $model->title = 'Tours';
                $model->type = 'area';
                ///$model->save();
            }

            Tours::deleteAll(["<=", "(date_format(FROM_UNIXTIME(FlightDate), '%Y-%m-%d'))", new \yii\db\Expression('DATE(NOW())')]);

            $this->cron_id = $model->id;

            try {
                foreach ($country as $areaID => $value) {
                    $post = [];
                    //$post['PackageDate'] = date('Y-m-d', $value['PackageDate']);
                    $post['PackageDate'] = Yii::$app->formatter->asDate($value['PackageDate']);
                    $post['StartDate'] = $value['PackageDate'];
                    $post['BeginDate'] = $post['PackageDate'];
                    $post['EndDate'] = $post['PackageDate'];
                    $post['package_id'] = $value['id'];

                    //$post['cron_id'] = $model->id;
                    if ($value['coraltravelAvailableDateItems']) {
                        if ($package_id) {
                            foreach ($value['coraltravelAvailableDateItems'] as $val) {
                                $post['Adult'] = $val['Adult'];
                                $post['Child'] = $val['Child'];
                                $post['ToCountry'] = $val['ToCountryID'];
                                $post['item_id'] = $val['item_id'];
                                $post['ToArea'] = 0;
                                //print_r($post);
                                ///$this->tour($post);
                            }
                        } else {
                            $ToCountryID = ArrayHelper::getColumn($value['coraltravelAvailableDateItems'], 'ToCountryID');

                            if ($ToCountryID) {
                                foreach ($ToCountryID as $val) {
                                    $post['ToCountry'] = $val;
                                    $post['ToArea'] = 0;

                                    for ($j = 1; $j <= Yii::$app->params['Adult']; $j++) {
                                        $post['Adult'] = $j;

                                        for ($i = 0; $i < Yii::$app->params['Child']; $i++) {
                                            $post['Child'] = $i;
                                            ///$this->tour($post);
                                        }
                                    }
                                }
                            }
                        }
                    }

                    $cron = CronToursItems::find()
                    ->where(['cron_id' => $this->cron_id])
                    ->andWhere(['!=', 'status', CronToursItems::STATUS_END]);

                    if (!$cron->count()) {
                        $model->status = CronToursItems::STATUS_END;
                    }
                    ///$model->save();
                }
            } catch (\Exception $e) {
                $model->status = CronToursItems::STATUS_ERROR;
                ///$model->save();
                echo $e->getMessage();
                echo "\r\n";
            }
        }
        echo "End: ".Yii::$app->formatter->asDatetime(time())."\r\n";
    }

    public function actionGetTours()
    {
        $date = Yii::$app->formatter->asTimestamp(date('Y-m-d 00:00:00'));
        //$date = Yii::$app->formatter->date();
        //die($date);
        //$connection = Yii::$app->db;
        /*$connection->createCommand()->update('tours', ['activity' => 0], 'FlightDate <= '.$date)
        ->execute();*/

        $country = self::getCountryForDate();
        
        if ($country) {
            $q = CronTours::find()
            ->where(['status' => 0])
            ->andWhere(['type' => 'full']);
            $model = $q->one();

            if (empty($model)) {
                $model = new CronTours();
                $model->title = 'Tours';
                $model->type = 'full';
                $model->save();

            } else {
                //echo $q->prepare(\Yii::$app->db->queryBuilder)->createCommand()->rawSql;die();
                //echo $model->id."\r\n";
                return "Cron already running";
            }

            //Tours::deleteAll(['<=', 'FlightDate', $date]);
            Tours::deleteAll(["<=", "(date_format(FROM_UNIXTIME(FlightDate), '%Y-%m-%d'))", new \yii\db\Expression('DATE(NOW())')]);

            $this->cron_id = $model->id;

//print_r($country);die();
            try {
                foreach ($country as $areaID => $value) {
                    $post = [];
                    //$post['PackageDate'] = date('Y-m-d', $value['PackageDate']);
                    $post['PackageDate'] = Yii::$app->formatter->asDate($value['PackageDate']);
                    $post['StartDate'] = $value['PackageDate'];
                    $post['BeginDate'] = $post['PackageDate'];
                    $post['EndDate'] = $post['PackageDate'];
                    $post['package_id'] = $value['id'];
                    //$post['cron_id'] = $model->id;

                            $ToCountryID = ArrayHelper::getColumn($value['coraltravelAvailableDateItems'], 'ToCountryID');

                            if ($ToCountryID) {
                                $ToCountryID = array_unique($ToCountryID);
                                foreach ($ToCountryID as $val) {

                    //if ($value['coraltravelAvailableDateItems']) {
                        //foreach ($value['coraltravelAvailableDateItems'] as $val) {
                            $post['ToCountry'] = $val; //$val['ToCountryID'];
                            //$post['ToArea'] = $val['ToAreaID'];
                            for ($j = 1; $j <= Yii::$app->params['Adult']; $j++) {
                                $post['Adult'] = $j;

                                for ($i=0; $i <= Yii::$app->params['Child']; $i++) {
                                    $post['Child'] = $i;
                                    //print_r($post);
                                    $this->tour($post);
                                }
                            }
                        }
                        $model->status = CronToursItems::STATUS_END;
                        ///$model->save();
                    }
                    //$this->tours($post);
                }
            } catch (\Exception $e) {
                $model->status = CronToursItems::STATUS_ERROR;
                ///$model->save();
                echo $e->getMessage();
                echo "\r\n";
            }
        }
    }

    private function tour($arr)
    {
        $pid = 0;
        $start = 0;
        $da = [];
        $data = [];
        $this->duplicates = 0;
        $this->upd = 0;
        $this->add = 0;
        $count = 0;

        if ($arr['item_id']) {
            $q = CronToursItems::find()
            //->where(['!=', 'status', 9])
            ->where(['>', 'id', 0])
            ->andWhere(['cron_id' => $this->cron_id])
            ->andWhere(['id' => $arr['item_id']])
            //->andWhere(['BeginDate' => $arr['StartDate']])
            ->andWhere(['ToCountry' => $arr['ToCountry']])
            //->andWhere(['ToArea' => $arr['ToArea']])
            ->andWhere(['Adult' => $arr['Adult']])
            ->andWhere(['Child' => $arr['Child']]);
            $cronToursItems = $q->one();
            $count = (int)$cronToursItems->rows;
            $this->duplicates = (int)$cronToursItems->duplicates;
            $this->upd = (int)$cronToursItems->update_rows;
            $this->add = (int)$cronToursItems->insert_rows;
        } else {
            $q = CronToursItems::find()
            //->where(['!=', 'status', 9])
            ->where(['>', 'id', 0])
            //->andWhere(['cron_id' => $this->cron_id])
            ->andWhere(['ToCountry' => $arr['ToCountry']])
            ->andWhere(['Adult' => $arr['Adult']])
            ->andWhere(['Child' => $arr['Child']])
            ->orderBy(['updated_at' => SORT_DESC])
            ->limit(1);
            //echo $q->prepare(\Yii::$app->db->queryBuilder)->createCommand()->rawSql;die();
            $cronToursItems = $q->one();
            if (!empty($cronToursItems) && $cronToursItems->isSkip()) {
                //print_r($cronToursItems);
                return;
            }
        }

        //echo $q->prepare(\Yii::$app->db->queryBuilder)->createCommand()->rawSql;die(" ---");

        if (isset($cronToursItems) && !empty($cronToursItems) && $cronToursItems->status == 9)
          return;


        $page = (isset($cronToursItems) && $cronToursItems->Page) ? $cronToursItems->Page : 1;

        if (!$cronToursItems) {
            $cronToursItems = new CronToursItems();
            $cronToursItems->attributes = $arr;
            $cronToursItems->BeginDate = $arr['StartDate'];
            $cronToursItems->cron_id = $this->cron_id;
            $cronToursItems->package_id = $arr['package_id'];
            $cronToursItems->status = $cronToursItems::STATUS_START;
        } else {
            //$page = $cronToursItems->Page;
            //$this->duplicates = $cronToursItems->duplicates;
            //$this->upd = $cronToursItems->update_rows;
            //$this->add = $cronToursItems->insert_rows;
        }

        $post = [
            //'ToArea' => $arr['ToArea'],
            'ToCountry' => $arr['ToCountry'],
            'BeginDate' => $arr['BeginDate'],
            'EndDate' => $arr['EndDate'],
            'Adult' => $arr['Adult'],
            'Child' => $arr['Child'],
            'StartIndex' => $page,
        ];

        while ($start == 0 || (isset($data) && !empty($data['data']) && isset($data['status']) && $data['status'] == 'success')) {
            $start = 1;
            $data = [];

            //echo "Status = ".$data['status']." Country = ".$post['ToCountry'];
            /*echo " AreaID = ".$post['ToArea'];
            echo " Adult = ".$post['Adult']." Child = ".$post['Child'];
            echo " Page = ".$post['StartIndex'];
            echo " COUNT = ".$count;
            echo "\r\n\r\n";*/

            try {
                $data = Yii::$app->api->getPackageSearch(self::tourParams($post));

                if ($count == 0) {
                    $count = ((isset($data['data']) && $data['data']) ? count($data['data']) : 0);
                }

                if (!empty($data['data'])) {
                    if ($post['StartIndex'] == 1)
                      $cronToursItems->data = \yii\helpers\Json::encode(self::tourParams($post));

                    foreach ($data['data'] as $value) {
                        $update = true;

                        $FlightDate = strtotime(date('Y-m-d 00:00:00', strtotime($value['FlightDate'])));
                        $HotelCheckInDate = strtotime(date('Y-m-d 00:00:00', strtotime($value['HotelCheckInDate'])));
                        $EarlyBookingEndDate = ($value['EarlyBookingEndDate']) ? strtotime(date('Y-m-d 00:00:00', strtotime($value['EarlyBookingEndDate']))) : 0;

                        $model = Tours::find()
                        ->andWhere(['FlightDate' => $FlightDate])
                        ->andWhere(['AreaID' => $value['AreaID']])
                        ->andWhere(['HotelNight' => $value['HotelNight']])
                        ->andWhere(['HotelID' => $value['HotelID']])
                        ->andWhere(['MealID' => $value['MealID']])
                        ->andWhere(['RoomID' => $value['RoomID']])
                        ->andWhere(['AccID' => $value['AccID']])
                        ->andWhere(['ToCountryID' => $value['ToCountryID']])
                        ->andWhere(['SeatClassID' => $value['SeatClassID']])
                        ->andWhere(['Adult' => $value['Adult']])
                        ->andWhere(['Child' => $value['Child']])
                        ->andWhere(['ChildAges' => $value['ChildAges']])
                        //->andWhere(['PackagePrice' => $value['PackagePrice']])
                        ->one();

                        if (!$model) {
                            $update = false;
                            $model = new Tours();
                            $model->attributes = $value;
                            $model->FlightDate = $FlightDate;
                            $model->HotelCheckInDate = $HotelCheckInDate;
                            $model->FlightDateSource = $value['FlightDate'];
                            $model->HotelCheckInDateSource = $value['HotelCheckInDate'];
                            $model->EarlyBookingEndDate = $EarlyBookingEndDate;
                            $model->HotelAllotmentStatus = (int)$value['HotelAllotmentStatus'];
                            $model->HotelStopSaleStatus = (int)$value['HotelStopSaleStatus'];
                            $model->SaleStatus = (int)$value['SaleStatus'];
                        } else {
                            $pid = $model->id;
                            $fp = fopen(Yii::getAlias('@uploadsTmpDir').'/cro-'.$pid.'.csv', 'a');
                            if (!is_file(Yii::getAlias('@uploadsTmpDir').'/cro-'.$pid.'.csv')) {
                                foreach ($model as $key => $val) {
                                    $da[$key] = iconv('UTF-8', 'CP1251//IGNORE', $val);
                                }
                                if (fputcsv($fp, array_keys($da), ';')) { }
                            }
                            //if ($pid && $pid == $model->id) {
                                $ak = array_keys($value);
                                $ak[] = 'para';
                                $vvv = $value;
                                $vvv['para'] = \yii\helpers\Json::encode(self::tourParams($post));

                                if (fputcsv($fp, $ak, ';')) { }
                                if (fputcsv($fp, $vvv, ';')) { }

            /*echo "ID = ".$model->id;
            echo " date0 = ".date('d.m.Y H:i:s', $model->created_at);
            echo " date1 = ".date('d.m.Y H:i:s');
            echo " Status = ".$data['status']." Country = ".$post['ToCountry'];
            echo " Adult = ".$post['Adult']." Child = ".$post['Child'];
            echo " Page = ".$post['StartIndex'];
            echo " COUNT = ".$count;
            echo " \r\n\r\n";
            print_r($value);
            echo " \r\n\r\n";
            print_r(self::tourParams($post));
            echo "\r\n\r\n";*/
            //}
            fclose($fp);
                            if ($model->PackagePrice == $value['PackagePrice'] && $model->PackagePriceOld == $value['PackagePriceOld'])
                              continue;
                        }

                        $toursTest = new \console\models\ToursTest();

                        $toursTest->attributes = $value;
                        $toursTest->FlightDate = $FlightDate;
                        $toursTest->HotelCheckInDate = $HotelCheckInDate;
                        $toursTest->FlightDateSource = $value['FlightDate'];
                        $toursTest->HotelCheckInDateSource = $value['HotelCheckInDate'];
                        $toursTest->EarlyBookingEndDate = $EarlyBookingEndDate;
                        $toursTest->HotelAllotmentStatus = (int)$value['HotelAllotmentStatus'];
                        $toursTest->HotelStopSaleStatus = (int)$value['HotelStopSaleStatus'];
                        $toursTest->SaleStatus = (int)$value['SaleStatus'];
                        $toursTest->params = \yii\helpers\Json::encode(self::tourParams($post));

                        if (!$toursTest->save()) {
                            //print_r($toursTest->getErrors());
                            //die();
                        }

                        try {
                            if ($model->save()) {
                                $toursTest->parent_id = $model->id;
                                $toursTest->save(false);

                                if ($update) {
                                    $this->upd++;
                                } else {
                                    $this->add++;

                                    if ($model->ChildAges) {
                                        $age = new \frontend\models\TourChildAges();
                                        $ages = explode(',', $model->ChildAges);

                                        foreach ($ages as $a) {
                                            if (trim($a)) {
                                                $age->tour_id = $model->id;
                                                $age->age = $a;
                                                $age->save();
                                            }
                                        }
                                    }
                                }
                            } else {
                                $this->duplicates++;
                                $errors = ($cronToursItems->errors) ? \yii\helpers\Json::decode($cronToursItems->errors) : [];
                                $cronToursItems->errors = \yii\helpers\Json::encode(
                                  \yii\helpers\ArrayHelper::merge($errors, $model->getErrors()));

                                self::addLog($model, 'tours');
                                file_put_contents(Yii::getAlias('@uploadsTmpDir').'/tours.txt', print_r($value, true)."\r\n\r\n", FILE_APPEND);
                            }
                        } catch (\Exception $e) {
                            self::addLog($e, 'tours-error');
                        }
                    }
                }
                $cronToursItems->Page = $post['StartIndex'];
                $cronToursItems->status = $cronToursItems::STATUS_SUCCESS; //success
                $cronToursItems->rows = (int)$cronToursItems->rows + $count;
            } catch (\Exception $e) {
                $cronTours = CronTours::findOne($this->cron_id);
                $cronTours->status = $cronToursItems::STATUS_ERROR;
                $cronTours->save();

                $cronToursItems->status = $cronToursItems::STATUS_ERROR;
                $cronToursItems->Page = $post['StartIndex'];
                self::addLog($e, 'tours-error');
            } finally {
                $cronToursItems->Page = $post['StartIndex'];
                $cronToursItems->duplicates = $this->duplicates;
                $cronToursItems->insert_rows = $this->add;
                $cronToursItems->update_rows = $this->upd;

                if (!$cronToursItems->save()) {
                    self::addLog($cronToursItems, 'cron-tours-items');
                }
            }
            $post['StartIndex']++;
        }

        if ((!isset($data['data']) || empty($data['data'])) && !empty($data['status']) && $data['status'] == 'success') {
            $cronToursItems->status = $cronToursItems::STATUS_END;
            $cronToursItems->save();
        } else {
            //self::addLog($model, 'tours0');
        }
        sleep(1);
    }

    private static function addLog($model, $t)
    {
        $data = [];
        $log = new CronLog();
        try {
            $data['errors'] = ($t == 'tours-error') ? $model->getMessage() : \yii\helpers\Json::encode($model->getErrors());
            $data['data'] = ($model) ? \yii\helpers\Json::encode($model) : '';
            $data['type'] = $t;
            $log::add($data);
            } catch (\Exception $e) {
                echo "Log: ".$e->getMessage()."\r\n";
                //print_r($e);
            }
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
                        $model = new Tours();
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
                                echo "\r\nTours\r\n";
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
            'ToCountry' => $data['ToCountry'], //'1, 12, 35',
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
