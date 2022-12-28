<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SearchForm extends Model
{
    public $from_area;
    public $nights;
    public $date_from;
    public $country_id;
    public $region_id;
    public $adult;
    public $child;
    public $ages;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['adult', 'required'],
            [['country_id', 'region_id', 'nights', 'adult', 'child', 'nights', 'from_area'], 'integer'],
            [['ages'], 'safe'],

            ['date_from', 'date'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Ім\'я',
            'phone' => 'Телефон',
            'branch_id' => 'Автошкола',
            'course_id' => 'Курс',
        ];
    }

    public function getRegions()
    {
        $regionFilter = [];

        $model = \frontend\models\Tours::find()
        ->with(['hotel', 'toCountry', 'meal', 'place.area.region.country', 'hotelCategory'])
        //->with(['hotel', 'toCountry', 'meal', 'area.region.country', 'hotelCategory'])
        ->where(['>', 'FlightDate', strtotime(date('Y-m-d', time()).' 00:00:00')])
        ->andWhere(['main' => 1])
        ->joinWith('toCountry')
        //->joinWith('area.region.country')
        ->orderBy(['{{%coraltravel_country}}.Name' => SORT_ASC])
        //->groupBy('RegionID')
        //->groupBy('{{%coraltravel_region}}.ID')
        ->asArray()
        ->all();

        $data = [];
        $t = \yii\helpers\ArrayHelper::getColumn($model, 'place.area');
        foreach ($t as $value) {
            $data[$value['region']['country']['Name']][$value['ID']] = $value['Name'];

        }
        //$data[0] = 'All reģions';
        asort($data);
        return $data;
        echo "<pre>";
        print_r($data);
        print_r($t);
        //print_r($model);
        echo "</pre>";
        die();
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

            $t = \yii\helpers\ArrayHelper::getColumn($model, 'area');
            $regionFilter = \yii\helpers\ArrayHelper::map($t, 'ID', 'Name');

            if (count($regionFilter) > 1) {
                $regionFilter[0] = 'Reģions';
                asort($regionFilter);
                //array_unshift($countryFilter, 'All');
            } else {
                $regionFilter = [];
            }
        }
        return $regionFilter;
    }

    public function getCountry()
    {
        $regionFilter = [];

        $model = \frontend\models\Tours::find()
        ->with(['hotel', 'toCountry', 'meal', 'area', 'hotelCategory'])
        ->where(['>', 'FlightDate', strtotime(date('Y-m-d', time()).' 00:00:00')])
        ->joinWith('toCountry')
        ->orderBy(['{{%coraltravel_country}}.Name' => SORT_ASC])
        ->groupBy('ToCountryID')
        ->asArray()
        ->all();

        if ($model) {
            $t = \yii\helpers\ArrayHelper::getColumn($model, 'toCountry');
            $countryFilter = \yii\helpers\ArrayHelper::map($t, 'ID', 'Name');

            if (count($countryFilter) > 1) {
                $countryFilter[0] = 'Izvēlies valsti';
                asort($countryFilter);
            } else {
                $countryFilter = [];
            }
        }

        return $countryFilter;


    }
}
