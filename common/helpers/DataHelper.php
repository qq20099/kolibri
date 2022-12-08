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

    public static function dateConvert($date)
    {
      $BD = explode('/', $date);
      $date = $BD[2].$BD[1].$BD[0];
      return $date;
    }

}