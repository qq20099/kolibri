<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

/**
 * SearchTicket represents the model behind the search form of `frontend\models\Ticket`.
 */
class SearchTours extends Tours
{
    const SCENARIO_FIND_BY_COUNTRY = 'find_by_country';
    const SCENARIO_FIND_BY_FORM = 'find_by_form';
    const SCENARIO_FIND_BY_FILTER = 'find_by_filter';

    public $country_id;
    public $area_id;
    public $all_rows;

    public $from_area;
    public $nights;
    public $date_from;
    public $region_id;
    public $adult;
    public $child;
    public $ages;
    public $rating;
    public $service;
    public $hotels;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['from_area'], 'required'],
            [['country_id',], 'required', 'on' => self::SCENARIO_FIND_BY_COUNTRY],
            [['date_from', 'nights'], 'required', 'on' => self::SCENARIO_FIND_BY_FORM],
            [['date_from', 'nights', 'id', 'main', 'adult', 'from_area', 'child'], 'integer'],
            [['region_id', 'rating', 'service', 'hotels'], 'each', 'rule' => ['integer']],
            //['region_id', 'each', 'rule' => ['integer']],
            [['country_id', 'area_id'], 'integer', 'min' => 1],
            ['country_id', 'default', 'value' => 12],
            ['from_area', 'default', 'value' => 3345],
            ['adult', 'default', 'value' => 2, 'on' => self::SCENARIO_FIND_BY_FORM],
            [['all_rows'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    /*public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }*/

    public function init()
    {
        parent::init();

        if (!isset($this->country_id) && $this->scenario == self::SCENARIO_FIND_BY_FORM)
          $this->country_id = 12; //Egipet


    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        //$query = self::find()->with(['hotel', 'hotel.images', 'hotel.raitings']);//, 'hotel.location0.country']);
        $query = self::find()
        ->with(['hotel', 'toCountry', 'meal', 'area', 'hotelCategory'])
        //->where(['>', 'FlightDate', strtotime(date('Y-m-d', time()).' 00:00:00')])
        ->orderBy(['FlightDate' => SORT_ASC]);
        //, 'hotel.images', 'hotel.raitings']);
        //$query->joinWith(['hotel.location0']);
        //$query->joinWith(['hotel.location0.country']);
          //->where(['hot' => 1]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> [
                'defaultOrder' => [
                    //'FlightDate' => SORT_DESC
                    'PackagePrice' => SORT_ASC
                ]
            ],
            'pagination' => [
                'pageSize' => 18,
            ],
        ]);

        $this->load($params);


        /*echo "\r\nL = ".$this->load($params);
        echo "\r\nV = ".$this->validate();
        echo "\r\n";
        echo "<pre>";
          print_r($params);
          print_r($this->getErrors());
        echo "</pre>";
        echo "\r\n";
        die();*/

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if ($this->date_from)
          $this->date_from = $this->date_from + Yii::$app->params['h'];

        $query->andFilterWhere([
            'id' => $this->id,
            'main' => $this->main,
            'ToCountryID' => $this->country_id,
            //'AreaID' => $this->area_id,
            'HotelNight' => $this->nights,
            'FlightDate' => $this->date_from,
            'Adult' => $this->adult,
            'Child' => $this->child
        ]);
        $query->andFilterWhere(['IN', 'AreaID', $this->region_id]);
        $query->andFilterWhere(['IN', 'HotelID', $this->hotels]);
        // grid filtering conditions
        /*$query->andFilterWhere([
            'id' => $this->id,
            'person' => $this->person,
            'date' => $this->date,
            'days' => $this->days,
            'pitanie' => $this->pitanie,
            'price' => $this->price,
            'hotel_id' => $this->hotel_id,
            'hot' => $this->hot,
            '{{%location}}.country_id' => $this->country_id,
            '{{%location}}.id' => $this->location_id,
        ]);*/

        //echo $query->prepare(\Yii::$app->db->queryBuilder)->createCommand()->rawSql;die();
        //Yii::$app->cache->set('query', $query);

        return $dataProvider;
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

        asort($data);
        return $data;
    }

    public function getNights()
    {
        $regionFilter = [];
                                    //echo $this->date_from + Yii::$app->params['h'];
        $q = \frontend\models\Tours::find()
        ->select('HotelNight, HotelNight as nval')
        ->with(['hotel', 'toCountry', 'meal', 'place.area.region.country', 'hotelCategory'])
        //->with(['hotel', 'toCountry', 'meal', 'area.region.country', 'hotelCategory'])
        ->where(['FlightDate' => $this->date_from]) // + Yii::$app->params['h']])
        ->andWhere(['Adult' => $this->adult])
        ->andFilterWhere(['Child' => $this->child])
        ->andWhere(['ToCountryID' => $this->country_id])
        //->andWhere(['{{%coraltravel_country}}.ID' => $this->country_id])
        ->joinWith('toCountry')
        //->joinWith('area.region.country')
        //->orderBy(['{{%coraltravel_country}}.Name' => SORT_ASC])
        ->groupBy('HotelNight')
        ->orderBy(['HotelNight' => SORT_ASC])
        //->groupBy('{{%coraltravel_region}}.ID')
        ->asArray();
        $model = $q->all();

        /*echo "<pre>";
        print_r($model);
        print_r($this);
        echo "</pre>";
        die();*/
        //sort($model);
        //echo $q->prepare(\Yii::$app->db->queryBuilder)->createCommand()->rawSql;die();
        $data = ($model) ? \yii\helpers\ArrayHelper::map($model, 'HotelNight', 'nval') : [];

        return $data;
    }

    public function getNights1()
    {
        $regionFilter = [];

        $model = \frontend\models\Tours::find()
        ->select('HotelNight, HotelNight as nval')
        ->with(['hotel', 'toCountry', 'meal', 'place.area.region.country', 'hotelCategory'])
        //->with(['hotel', 'toCountry', 'meal', 'area.region.country', 'hotelCategory'])
        ->where(['FlightDate' => $this->date_from + Yii::$app->params['h']])
        ->andWhere(['Adult' => $this->adult])
        ->andFilterWhere(['Child' => $this->child])
        ->andWhere(['ToCountryID' => $this->country_id])
        //->andWhere(['{{%coraltravel_country}}.ID' => $this->country_id])
        ->joinWith('toCountry')
        //->joinWith('area.region.country')
        //->orderBy(['{{%coraltravel_country}}.Name' => SORT_ASC])
        ->groupBy('HotelNight')
        //->groupBy('{{%coraltravel_region}}.ID')
        ->asArray()
        ->all();

        /*$data = [];
        $t = \yii\helpers\ArrayHelper::getColumn($model, 'place.area');
        foreach ($t as $value) {
            $data[$value['region']['country']['Name']][$value['ID']] = $value['Name'];
        }*/

        sort($model);
        return $model;
    }

    public function getRegionsForCountry()
    {
        //$this->country_id = 12;

        $model = \frontend\models\Tours::find()
        ->with(['hotel', 'toCountry', 'meal', 'place.area.region.country', 'hotelCategory'])
        //->with(['hotel', 'toCountry', 'meal', 'area.region.country', 'hotelCategory'])
        ->where(['>', 'FlightDate', strtotime(date('Y-m-d', time()).' 00:00:00')])
        ->andWhere(['{{%coraltravel_country}}.ID' => $this->country_id])
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

        asort($data);
        return $data;
    }

    public function getCountry()
    {
        $regionFilter = [];

        //$this->getAvailableDate(true);

        $q = \frontend\models\Tours::find()
        ->with(['hotel', 'toCountry', 'meal', 'area', 'hotelCategory'])
        ->where(['>=', 'FlightDate', strtotime(date('Y-m-d', time()).' 00:00:00')])
        ->andWhere(['IN', 'FlightDate', $this->getAvailableDate(true)])
        ->joinWith('toCountry')
        ->orderBy(['{{%coraltravel_country}}.Name' => SORT_ASC])
        ->groupBy('ToCountryID')
        ->asArray();
        $model = $q->all();

        if ($model) {
            $t = \yii\helpers\ArrayHelper::getColumn($model, 'toCountry');
            $countryFilter = \yii\helpers\ArrayHelper::map($t, 'ID', 'Name');

            if (count($countryFilter) > 1) {
                //$countryFilter[0] = 'Izvēlies valsti';
                asort($countryFilter);
            } else {
                $countryFilter = [];
            }
        }
        //echo $q->prepare(\Yii::$app->db->queryBuilder)->createCommand()->rawSql;//die("KKK");
//print_r($countryFilter);die();
        return $countryFilter;
    }

    private function getAvailableDate($all_country = false)
    {
        $d = strtotime(date('Y-m-d', time()).' 00:00:00');
        $q = \frontend\models\CoraltravelAvailableDateItems::find()
        ->where(['>=', '{{%coraltravel_package_available_date}}.PackageDate', $d]);

        if (!$all_country)
          $q->andWhere(['ToCountryID' => $this->country_id]);

        $q->andFilterWhere(['IN', 'ToAreaID', $this->region_id])
        ->with('package')
        ->joinWith('package')
        //->groupBy(['{{%coraltravel_package_available_date}}.PackageDate', 'ToCountryID'])
        ->asArray();
        $model = $q->all();

        //echo "JJ = ".$q->prepare(\Yii::$app->db->queryBuilder)->createCommand()->rawSql."\n";//die();
        $pack = \yii\helpers\ArrayHelper::getColumn($model, 'package.PackageDate');

        return $pack;
    }

    public function getToursAvailableDate()
    {

        /*$model = \frontend\models\Tours::find()
         ->select(['FROM_UNIXTIME(pd.PackageDate, "%Y-%m-%d") as PackDate'])
        //->with(['hotel', 'toCountry', 'meal', 'area', 'hotelCategory'])
        ->leftJoin('coraltravel_available_date_items pdi', 'pdi.ToCountryID=tours.ToCountryID')
        ->leftJoin('coraltravel_package_available_date pd', 'pd.id=pdi.package_id')

        //->joinWith('package')
        //->orderBy(['{{%coraltravel_country}}.Name' => SORT_ASC])
        ->where(['>=', 'FlightDate', $d])
        ->andWhere(['tours.ToCountryID' => $this->country_id])
        ->andWhere(['>=', 'pd.PackageDate', $d])
        ->groupBy(['tours.ToCountryID'])
        ->asArray()
        ->all();*/
        //print_r($pack);
        $q = \frontend\models\Tours::find()
         //->select(['PackageNight, FROM_UNIXTIME(FlightDate, "%Y-%m-%d") as PackDate'])
         ->select(['FROM_UNIXTIME(FlightDate, "%Y-%m-%d") as PackDate', 'FlightDate as flatdat', 'MIN(PackagePrice) as minprice'])
         ->where(['ToCountryID' => $this->country_id])
         ->andWhere(['IN', 'FlightDate', $this->getAvailableDate()])
         ->andWhere(['Adult' => $this->adult])
         ->andFilterWhere(['Child' => $this->child])
         ->andFilterWhere(['IN', 'AreaID', $this->region_id])
         ->groupBy('FlightDate')
         ->asArray();
        $model = $q->all();

        //echo $q->prepare(\Yii::$app->db->queryBuilder)->createCommand()->rawSql."\n";die("KKK");
        //print_r($model);
        $date = [];

        if ($model) {
            $price = \yii\helpers\ArrayHelper::map($model, 'PackDate', 'minprice');
            $date = \yii\helpers\ArrayHelper::getColumn($model, 'PackDate');
            $date = ($date) ? array_unique($date) : [];
        }

        if ($date)
          sort($date);

        return ['date' => $date, 'price' => $price];
    }

    public function getPeople()
    {
        $model = \frontend\models\Tours::find()
         ->select(['MAX(Adult) AS Adult', 'MAX(Child) AS Child'])
         ->where(['ToCountryID' => $this->country_id])
         ->andWhere(['IN', 'FlightDate', $this->getAvailableDate()])
         ->andFilterWhere(['IN', 'AreaID', $this->region_id])
         ->asArray()
         ->one();

        //print_r($model);
        $date = [];

        /*if ($model) {
            $date = \yii\helpers\ArrayHelper::getColumn($model, 'PackDate');
            $date = ($date) ? array_unique($date) : [];
        }

        if ($date)
          sort($date);

        return $date;*/
        return $model;
    }

    public function getHotelRatingForFilter()
    {
        $query = self::find()
        ->select('FLOOR(tripAdvisorPoint) AS tripAdvisorPoint')
        ->where(['>', 'FLOOR(tripAdvisorPoint)', 0])
        ->joinWith(['hotel'])
        ->orderBy(['tripAdvisorPoint' => SORT_DESC]);

        if ($this->date_from)
          $this->date_from = $this->date_from + Yii::$app->params['h'];

        $query->andFilterWhere([
            'id' => $this->id,
            'main' => $this->main,
            'ToCountryID' => $this->country_id,
            //'AreaID' => $this->area_id,
            'HotelNight' => $this->nights,
            'FlightDate' => $this->date_from,
            'Adult' => $this->adult,
            'Child' => $this->child
        ]);
        $query->andFilterWhere(['IN', 'AreaID', $this->region_id]);
        $query->groupBy('FLOOR({{%coraltravel_hotel}}.tripAdvisorPoint)');
        if ($query->count()) {
            $data = $query->asArray()->all();
            $r = ArrayHelper::getColumn($data, 'tripAdvisorPoint');
            return $r;
        }
        return false;
    }

    public function getHotelForFilter()
    {
        $query = self::find()
        ->select('{{%coraltravel_hotel}}.ID, {{%coraltravel_hotel}}.Name')
        ->joinWith(['hotel'])
        ->orderBy(['Name' => SORT_ASC]);

        if ($this->date_from)
          $this->date_from = $this->date_from + Yii::$app->params['h'];

        $query->andFilterWhere([
            'id' => $this->id,
            'main' => $this->main,
            'ToCountryID' => $this->country_id,
            //'AreaID' => $this->area_id,
            'HotelNight' => $this->nights,
            'FlightDate' => $this->date_from,
            'Adult' => $this->adult,
            'Child' => $this->child
        ]);
        $query->andFilterWhere(['IN', 'AreaID', $this->region_id]);
        $query->groupBy('{{%coraltravel_hotel}}.ID');

        if ($query->count()) {
            $data = $query->asArray()->all();
            $r = ArrayHelper::map($data, 'ID', 'Name');
            /*echo "----<pre>";
            print_r($query->count());
            print_r($data);
            echo "</pre>";
            die();*/
            return $r;
        }
        return false;
    }

    public function getServiceForFilter()
    {
        $query = self::find()
        ->where(['NOT', ['{{%coraltravel_meal}}.SName' => NULL]])
        ->joinWith(['meal']);

        if ($this->date_from)
          $this->date_from = $this->date_from + Yii::$app->params['h'];

        $query->andFilterWhere([
            'id' => $this->id,
            'main' => $this->main,
            'ToCountryID' => $this->country_id,
            //'AreaID' => $this->area_id,
            'HotelNight' => $this->nights,
            'FlightDate' => $this->date_from,
            'Adult' => $this->adult,
            'Child' => $this->child
        ]);
        $query->andFilterWhere(['IN', 'AreaID', $this->region_id]);
        $query->groupBy('{{%coraltravel_meal}}.Name');

        if ($query->count()) {
            $data = $query->asArray()->all();
            $r = ArrayHelper::getColumn($data, 'meal');
            $r0 = ArrayHelper::map($r, 'ID', 'SName');
            $r = ArrayHelper::map($r, 'ID', 'Name');
            $data = [];
            foreach ($r0 as $key => $val) {
                $data[$key] = $val.' - '.$r[$key];
            }
            return $data;
        }
        return false;
    }

    public function getToursAvailableDate1()
    {
       /* $model = \frontend\models\Tours::find()
        //->with(['hotel', 'toCountry', 'meal', 'area', 'hotelCategory'])
        ->leftJoin('coraltravel_package_available_date pa', 'pa.PackageDate=tours.FlightDate')
        ->leftJoin('coraltravel_available_date_items pai', 'pai.package_id=pa.id')
        //->joinWith('package')
        //->orderBy(['{{%coraltravel_country}}.Name' => SORT_ASC])
        ->where(['>=', 'FlightDate', strtotime(date('Y-m-d', time()).' 00:00:00')])
        ->andWhere(['tours.ToCountryID' => $this->country_id])
        ->andWhere(['pai.ToCountryID' => $this->country_id])
        ->groupBy(['tours.ToCountryID', 'FlightDate'])
        ->asArray()
        ->all();*/

        $d = strtotime(date('Y-m-d', time()).' 00:00:00');
        $model = \frontend\models\Tours::find()
         ->select(['FROM_UNIXTIME(pd.PackageDate, "%Y-%m-%d") as PackDate'])
        //->with(['hotel', 'toCountry', 'meal', 'area', 'hotelCategory'])
        ->leftJoin('coraltravel_available_date_items pdi', 'pdi.ToCountryID=tours.ToCountryID')
        ->leftJoin('coraltravel_package_available_date pd', 'pd.id=pdi.package_id')

        //->joinWith('package')
        //->orderBy(['{{%coraltravel_country}}.Name' => SORT_ASC])
        ->where(['>=', 'FlightDate', $d])
        ->andWhere(['tours.ToCountryID' => $this->country_id])
        ->andWhere(['>=', 'pd.PackageDate', $d])
        ->groupBy(['tours.ToCountryID'])
        ->asArray()
        ->all();

        //print_r($model);
        $date = \yii\helpers\ArrayHelper::getColumn($model, 'PackDate');
        $date = ($date) ? array_unique($date) : [];

        if ($date)
          sort($date);
/*SELECT pdi.*, pd.*, from_unixtime(pd.PackageDate, '%Y-%m-%d') as d
FROM `tours` t
left join coraltravel_available_date_items pdi on t.ToCountryID=pdi.ToCountryID
left join coraltravel_package_available_date pd on pd.id=pdi.package_id /*and pd.PackageDate=t.FlightDate* /

WHERE t.`ToCountryID` = 42
and pd.PackageDate>=1671660000
and t.FlightDate>=1671660000
group by t.`ToCountryID`*/
        /*SELECT pdi.*, pd.*, from_unixtime(pd.PackageDate, '%Y-%m-%d') as d
FROM `coraltravel_available_date_items` pdi
left join coraltravel_package_available_date pd on pd.id=pdi.package_id
left join tours t on t.ToCountryID=pdi.ToCountryID
WHERE pdi.`ToCountryID` = 42
and pd.PackageDate>=1671660000
and t.FlightDate>=1671660000
group by t.FlightDate*/
        return $date;
    }

}
