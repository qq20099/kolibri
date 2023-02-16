<?php

namespace common\helpers;

use Yii;
use DateTime;
use yii\helpers\ArrayHelper;

/**
 * Class DateHelper
 * @package common\helpers
 */
class DataHelper extends \yii\base\BaseObject
{

    public static function getHotelsCategory()
    {
        $m = \backend\models\CoraltravelHotel::find()->with(['hotelCategory']);
        //$m->andFilterWhere(['hot' => $hot]);
        //$m->where(['IS NOT', '{{%coraltravel_country}}.Name', NULL]);
        $m->joinWith(['hotelCategory']);
        $m->groupBy('HotelCategory');
        $m->orderBy('{{%coraltravel_hotel_category}}.ShortName');
        $model = $m->asArray()->all();
        /*echo "<pre>";
        //print_r($model);die();
        print_r(\yii\helpers\ArrayHelper::map(\yii\helpers\ArrayHelper::getColumn($model, 'place.area.region.country'), 'ID', 'Name'));
        echo "</pre>";
        die();*/
        return $model;
    }

    public static function getHotelsCountry()
    {
        $m = \backend\models\CoraltravelHotel::find()->with(['place.area.region.country']);
        //$m->andFilterWhere(['hot' => $hot]);
        $m->where(['IS NOT', '{{%coraltravel_country}}.Name', NULL]);
        $m->joinWith(['place.area.region.country']);
        $m->groupBy('{{%coraltravel_country}}.ID');
        $m->orderBy('{{%coraltravel_country}}.Name');
        $model = $m->asArray()->all();
        /*echo "<pre>";
        //print_r($model);die();
        print_r(\yii\helpers\ArrayHelper::map(\yii\helpers\ArrayHelper::getColumn($model, 'place.area.region.country'), 'ID', 'Name'));
        echo "</pre>";
        die();*/
        return $model;
    }

    public static function getCountry($hot = 0)
    {
        //$model = \frontend\models\Country::find()->where(['activity' => 1])->asArray()->all();
        $m = \frontend\models\Ticket::find()->with(['hotel', 'hotel.images', 'hotel.raitings', 'hotel.location0', 'hotel.location0.country']);
        $m->andFilterWhere(['hot' => $hot]);
        $model = $m->asArray()->all();
       //print_r($model)
/*       echo "<pre>";
       print_r($model);
       echo "</pre>";
       die();*/
        return $model;
    }

    public static function getPages()
    {
        //$model = \frontend\models\Country::find()->where(['activity' => 1])->asArray()->all();
        $m = \backend\models\Pages::find()->orderBy(['title' => SORT_ASC]);

        $model = $m->asArray()->all();
        return $model;
    }

    public static function dateConvert($date)
    {
      $BD = explode('/', $date);
      $date = $BD[2].$BD[1].$BD[0];
      return $date;
    }

}