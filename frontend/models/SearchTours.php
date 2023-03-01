<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\Expression;

/**
 * SearchTicket represents the model behind the search form of `frontend\models\Ticket`.
 */
class SearchTours extends Tours
{
    const SCENARIO_FIND_BY_COUNTRY = 'find_by_country';
    const SCENARIO_FIND_BY_FORM = 'find_by_form';
    const SCENARIO_FIND_FOR_HOTEL = 'find_for_hotel';
    const SCENARIO_FIND_BY_MAIN = 'find_for_main_page';

    public $country_id;
    public $area_id;
    public $all_rows;

    public $from_area;
    public $nights;
    public $date_from;
    public $region_id;
    public $hotel_id;
    public $adult;
    public $child;
    public $ages;

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
            [['region_id', 'hotel_id'], 'each', 'rule' => ['integer']],
            [['country_id', 'area_id'], 'integer', 'min' => 1],
            [['ages'], 'string', 'max' => 20],
            ['country_id', 'default', 'value' => 12, 'on' => self::SCENARIO_FIND_BY_FORM],
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
        $query = $this->getQuery();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> [
                'defaultOrder' => [
                    'FlightDate' => SORT_ASC,
                    'PackagePrice' => SORT_ASC
                ]
            ],
            'pagination' => [
                'pageSize' => 18,
                'pageSizeParam' => false,
                'forcePageParam' => false,
            ],
        ]);

        $this->load($params);

        /*
        echo "\r\nL = ".$this->load($params);
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
            //print_r($this->errors);die();
            return $dataProvider;
        }

        if (!$this->hotel_id) {
            //$query->groupBy('HotelID, FlightDate');
            $query->groupBy('HotelID');
        } else {
            $query->groupBy('HotelID');
            $query->orderBy('tours.PackagePrice, tours.FlightDate');
        }

        if ($this->date_from)
          $this->date_from = $this->date_from + Yii::$app->params['h'];


        $query->andFilterWhere([
            'id' => $this->id,
            'main' => $this->main,
            'ToCountryID' => $this->country_id,
            //'AreaID' => $this->area_id,
            'HotelNight' => $this->nights,
            //'FlightDate' => $this->date_from,
            'Adult' => $this->adult,
            'Child' => $this->child
        ]);
        $d = ($this->date_from) ? date('Y-m-d', $this->date_from) : '';
        $query->andFilterWhere(["(date_format(FROM_UNIXTIME(FlightDate), '%Y-%m-%d'))" => $d]);
        $query->andFilterWhere(['IN', 'AreaID', $this->region_id]);
        $query->andFilterWhere(['IN', 'HotelID', $this->hotel_id]);

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
/*echo "<pre>";
print_r($this);
echo "</pre>";*/
//die();
        //echo $query->prepare(\Yii::$app->db->queryBuilder)->createCommand()->rawSql;die();
        return $dataProvider;
    }

    public function getQuery()
    {
        $d = date('Y-m-d');
        $subQuery = self::find()
        ->select(['id', 'PackagePrice', 'MIN(PackagePrice) minPrice'])
        //->where(['>', 'FlightDate', strtotime(date('Y-m-d', time()).' 00:00:00')])
        ->where([">", "(date_format(FROM_UNIXTIME(FlightDate), '%Y-%m-%d'))", new Expression(new Expression('DATE(NOW())'))])
        ->andWhere(['activity' => 1])
        ->groupBy('HotelID');
        //->orderBy('FlightDate, PackagePrice');
        $subQuery->andFilterWhere(['IN', 'AreaID', $this->region_id]);

        $query = self::find()->leftJoin('(' .
                      $subQuery->prepare(Yii::$app->db->queryBuilder)
                               ->createCommand()
                               ->rawSql
                  . ') p', 'p.id = tours.id AND p.minPrice=tours.PackagePrice')
        //->where(['>', 'FlightDate', strtotime(date('Y-m-d', time()).' 00:00:00')])
        //->where([">", "(date_format(FROM_UNIXTIME(FlightDate), '%Y-%m-%d'))", $d])
        ->where([">", "(date_format(FROM_UNIXTIME(FlightDate), '%Y-%m-%d'))", new Expression('DATE(NOW())')])
        ->andWhere(['activity' => 1])
        ->with(['hotel', 'toCountry', 'meal', 'area', 'hotel.category'])
        ->orderBy('{{%tours}}.FlightDate, {{%tours}}.PackagePrice');

        return $query;
    }

    public function getRegions()
    {
        $regionFilter = [];

        $q = \frontend\models\Tours::find()
        ->select([
            '{{%tours}}.id',
            '{{%coraltravel_geography}}.AreaID',
            '{{%coraltravel_geography}}.AreaName',
            '{{%coraltravel_geography}}.CountryName'
        ])
        //->with(['hotel', 'toCountry', 'meal', 'place.area.region.country', 'hotelCategory', 'geography'])
        ->with(['geography'])
        //->with(['hotel', 'toCountry', 'meal', 'area.region.country', 'hotelCategory'])
        //->where(['>', 'FlightDate', strtotime(date('Y-m-d', time()).' 00:00:00')])
        ->where([">", "(date_format(FROM_UNIXTIME(FlightDate), '%Y-%m-%d'))", new Expression('DATE(NOW())')])
        ->andWhere(['activity' => 1])
        ->joinWith('geography')
        //->joinWith('area.region.country')
        ->orderBy(['{{%coraltravel_geography}}.CountryName, {{%coraltravel_geography}}.AreaName' => SORT_ASC])
        ->groupBy('{{%tours}}.AreaID')
        //->groupBy('{{%coraltravel_region}}.ID')
        ->asArray();
        $model = $q->all();
/*echo "<pre>";
print_r($model);
echo "</pre>";
echo $q->prepare(\Yii::$app->db->queryBuilder)->createCommand()->rawSql;die("fff");*/
        $data = [];
        //$t = \yii\helpers\ArrayHelper::getColumn($model, 'place.area');
        //$t = \yii\helpers\ArrayHelper::getColumn($model, 'geography');
        foreach ($model as $value) {
            $data[$value['CountryName']][$value['AreaID']] = $value['AreaName'];
            //$data[$value['region']['country']['Name']][$value['ID']] = $value['Name'];
        }
/*echo "<pre>";
print_r($data);
echo "</pre>";*/
        //asort($data);

        /*echo "<pre>";
        print_r($data);
        echo "</pre>";
        die();*/
        return $data;
    }

    public function getNights22()
    {
        $d = strtotime(date('Y-m-d', time()).' 00:00:00') + Yii::$app->params['h'];
        $query = $this->getQuery()
        ->select(['tours.PackageNights'])
        ->where(['>', 'FlightDate', $d])
        ->groupBy(['PackageNights']);
       // $model = $query->asArray()->all();

        echo $query->prepare(\Yii::$app->db->queryBuilder)->createCommand()->rawSql;die();
        return $model;

        return $data;
    }

    public function getNights()
    {
        $regionFilter = [];
        $d = strtotime(date('Y-m-d 00:00:00')) + Yii::$app->params['h'];
        $d = date('Y-m-d');
        //$df = (isset($this->date_from)) ? date('Y-m-d', $this->date_from) : '';
        $df = (isset($this->date_from)) ? Yii::$app->formatter->asDate($this->date_from) : '';
                                    //echo $this->date_from + Yii::$app->params['h'];
        $q = \frontend\models\Tours::find()
        ->select('HotelNight, HotelNight as nval')
        ->with(['hotel', 'toCountry', 'meal', 'place.area.region.country', 'hotelCategory'])
        //->with(['hotel', 'toCountry', 'meal', 'area.region.country', 'hotelCategory'])
        //->where(['>', 'FlightDate', $d])
        //->where([">", "(date_format(FROM_UNIXTIME(FlightDate), '%Y-%m-%d'))", $d])
        ->where([">", "(date_format(FROM_UNIXTIME(FlightDate), '%Y-%m-%d'))", new Expression('DATE(NOW())')])
        ->andWhere(['activity' => 1])
        //->andFilterWhere([new \yii\db\Expression('from_unixtime(FlightDate, "%Y-%m-%d")') => $df])
        ->andFilterWhere(["(date_format(FROM_UNIXTIME(FlightDate), '%Y-%m-%d'))" => $df])
        ->andFilterWhere(['Adult' => $this->adult])
        ->andFilterWhere(['Child' => $this->child])
        ->andFilterWhere(['ToCountryID' => $this->country_id])
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
        //die(Yii::getAlias('@uploadsTmpDir').'sql.txt');
        file_put_contents(Yii::getAlias('@uploadsTmpDir').'/sql.txt', $q->prepare(\Yii::$app->db->queryBuilder)->createCommand()->rawSql."\r\n", FILE_APPEND);
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
        $subQuery = $this->getQuery();///->asArray();
        $query = \frontend\models\CoraltravelGeography::find()
        ->from(['g.AreaID', 'g.AreaName'])
        ->from('{{%coraltravel_geography}} g')
        ->innerJoin('(' .
                      $subQuery->prepare(Yii::$app->db->queryBuilder)
                               ->createCommand()
                               ->rawSql
                  . ') t', 't.AreaID = g.AreaID')
        //->where(['>', 'FlightDate', strtotime(date('Y-m-d', time()).' 00:00:00')])
        ->filterWhere(['CountryID' => $this->country_id])
        //->andWhere(['activity' => 1])
        //->with(['hotel', 'toCountry', 'meal', 'area', 'hotel.category'])
        ->orderBy('AreaName')
        ->groupBy('AreaID');
//echo $query->prepare(\Yii::$app->db->queryBuilder)->createCommand()->rawSql;die("");
        /*$query->select('{{%coraltravel_geography}}.*');
        $query->joinWith('geography');
        $query->groupBy('{{%coraltravel_geography}}.AreaID');*/
        $model = $query->all();

//print_r($model);
        $data = [];

        foreach ($model as $value) {
            $data[$value['AreaID']] = $value['AreaName'];
        }

        //echo $query->prepare(\Yii::$app->db->queryBuilder)->createCommand()->rawSql;die(" KKK");
        //echo $q->prepare(\Yii::$app->db->queryBuilder)->createCommand()->rawSql;//die("KKK");
//print_r($countryFilter);;
        //die();
        return $data;
    }

    public function getRegionsForCountry1()
    {
        //$this->country_id = 12;

        /*$q = \frontend\models\Tours::find()
        ->with(['hotel', 'toCountry', 'meal', 'place.area.region.country', 'hotelCategory'])
        //->with(['hotel', 'toCountry', 'meal', 'area.region.country', 'hotelCategory'])
        ->where(['>', 'FlightDate', strtotime(date('Y-m-d', time()).' 00:00:00')])
        ->andWhere(['activity' => 1])
        ->andFilterWhere(['Adult' => $this->Adult])
        ->andWhere(['{{%coraltravel_country}}.ID' => $this->country_id])
        ->andWhere(['IS NOT', '{{%coraltravel_place}}.Name', NULL])
        ->joinWith('toCountry')
        ->joinWith('place.area.region.country')
        //->joinWith('area.region.country')
        ->orderBy(['{{%coraltravel_country}}.Name' => SORT_ASC])
        //->groupBy('RegionID')
        //->groupBy('{{%coraltravel_region}}.ID')
        ->asArray();
        $model = $q->all();*/

        $subQuery = self::find()
        ->select(['id', 'PackagePrice'])
        ->where(['>', 'FlightDate', strtotime(date('Y-m-d', time()).' 00:00:00')])
        ->andWhere(['activity' => 1])
        ->andFilterWhere(['FlightDate' => $this->date_from])
        ->andFilterWhere(['ToCountryID' => $this->country_id])
        ->andFilterWhere(['Adult' => $this->adult])
        ->andFilterWhere(['Child' => $this->child])
        ->andWhere(['IN', 'FlightDate', $this->getAvailableDate()])
        ->groupBy('FlightDate');

        //$query = CoraltravelArea::find()
        $query = Tours::find()
        ->select(['{{%coraltravel_area}}.ID', '{{%coraltravel_area}}.Name'])
        ->leftJoin('('.
                      $subQuery->prepare(Yii::$app->db->queryBuilder)
                               ->createCommand()
                               ->rawSql
                  .') p', 'p.id = tours.id')
        ->where(['>', 'FlightDate', strtotime(date('Y-m-d', time()).' 00:00:00')])
        ->andWhere(['activity' => 1])
        ->andFilterWhere(['ToCountryID' => $this->country_id])
        ->andFilterWhere(['Adult' => $this->adult])
        ->andFilterWhere(['Child' => $this->child])
        ->with(['area.region'])
        //->joinWith(['area'])
        ->joinWith(['area.region'])
        ->groupBy('{{%coraltravel_area}}.ID')
        ->orderBy('{{%coraltravel_area}}.Name')
        ->asArray();
        $model = $query->all();
//print_r($model);die();
        $data = [];
        //$t = \yii\helpers\ArrayHelper::getColumn($model, 'place.area');
        foreach ($model as $value) {
            //$data[$value['region']['country']['Name']][$value['ID']] = $value['Name'];
            $data[$value['ID']] = $value['Name'];
        }

        //asort($data);
        /*echo "\r\nrefc\r\n<pre>";
        print_r($data);
        print_r($model);
        echo "</pre>";
        die();*/
        //echo $query->prepare(\Yii::$app->db->queryBuilder)->createCommand()->rawSql;//die("KKK");
        //echo $q->prepare(\Yii::$app->db->queryBuilder)->createCommand()->rawSql;//die("KKK");
//print_r($countryFilter);;
        //die();
        return $data;
    }

    public function getCountryForFilter()
    {
        $countryFilter = [];

        //$this->getAvailableDate(true);

        $q = \frontend\models\Tours::find()
        ->with(['hotel', 'toCountry', 'meal', 'area', 'hotelCategory'])
        //->where(['>', 'FlightDate', strtotime(date('Y-m-d', time()).' 00:00:00')])
        ->where([">", "(date_format(FROM_UNIXTIME(FlightDate), '%Y-%m-%d'))", new Expression('DATE(NOW())')])
        ->andWhere(['activity' => 1])
        ->andWhere(['IN', 'FlightDate', $this->getAvailableDate()])
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
                //$countryFilter = [];
            }
        }
        //echo $q->prepare(\Yii::$app->db->queryBuilder)->createCommand()->rawSql;//die("KKK");
//print_r($countryFilter);die();
        return $countryFilter;
    }

    public function getCountry()
    {
        $countryFilter = [];

        //$this->getAvailableDate(true);

        /*$q = \frontend\models\Tours::find()
        ->with(['hotel', 'toCountry', 'meal', 'area', 'hotelCategory'])
        ->where(['>', 'FlightDate', strtotime(date('Y-m-d', time()).' 00:00:00')])
        ->andWhere(['activity' => 1])
        ->andWhere(['IN', 'FlightDate', $this->getAvailableDate(true)])
        ->joinWith('toCountry')
        ->orderBy(['{{%coraltravel_country}}.Name' => SORT_ASC])
        ->groupBy('ToCountryID')
        ->asArray();
        $model = $q->all();*/

        $subQuery = $this->getQuery();///->asArray();
        $query = \frontend\models\CoraltravelGeography::find()
        ->from('{{%coraltravel_geography}} g')
        ->innerJoin('(' .
                      $subQuery->prepare(Yii::$app->db->queryBuilder)
                               ->createCommand()
                               ->rawSql
                  . ') t', 't.AreaID = g.AreaID')
        //->where(['IN', 'FlightDate', $this->getAvailableDate(true)])
        //->filterWhere(['CountryID' => $this->country_id])
        //->andWhere(['activity' => 1])
        //->with(['hotel', 'toCountry', 'meal', 'area', 'hotel.category'])
        ->orderBy('CountryName')
        ->groupBy('CountryID');
//echo $query->prepare(\Yii::$app->db->queryBuilder)->createCommand()->rawSql;die("---");
        /*$query->select('{{%coraltravel_geography}}.*');
        $query->joinWith('geography');
        $query->groupBy('{{%coraltravel_geography}}.AreaID');*/
        $model = $query->all();

//print_r($model);
        $data = [];

        foreach ($model as $value) {
            $countryFilter[$value['CountryID']] = $value['CountryName'];
        }

        /*if ($model) {
            $t = \yii\helpers\ArrayHelper::getColumn($model, 'toCountry');
            $countryFilter = \yii\helpers\ArrayHelper::map($t, 'ID', 'Name');

            if (count($countryFilter) > 1) {
                //$countryFilter[0] = 'Izvēlies valsti';
                asort($countryFilter);
            } else {
                //$countryFilter = [];
            }
        }*/
        //echo $query->prepare(\Yii::$app->db->queryBuilder)->createCommand()->rawSql;die("KKK");
//print_r($countryFilter);die();
        return $countryFilter;
    }

    public function getCountry1()
    {
        $countryFilter = [];

        //$this->getAvailableDate(true);

        $q = \frontend\models\Tours::find()
        ->with(['hotel', 'toCountry', 'meal', 'area', 'hotelCategory'])
        ->where(['>', 'FlightDate', strtotime(date('Y-m-d', time()).' 00:00:00')])
        ->andWhere(['activity' => 1])
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
                //$countryFilter = [];
            }
        }
        //echo $q->prepare(\Yii::$app->db->queryBuilder)->createCommand()->rawSql;die("KKK");
//print_r($countryFilter);die();
        return $countryFilter;
    }

    private function getAvailableDate($all_country = false)
    {
        $d = strtotime(date('Y-m-d', time()).' 00:00:00');
        $q = \frontend\models\CoraltravelAvailableDateItems::find()
        ->where(['>', '{{%coraltravel_package_available_date}}.PackageDate', $d]);

        if (!$all_country)
          $q->andWhere(['ToCountryID' => $this->country_id]);

        if (!$all_country)
          $q->andFilterWhere(['IN', 'ToAreaID', $this->region_id]);

        $q->with('package')
        ->joinWith('package')
        //->groupBy(['{{%coraltravel_package_available_date}}.PackageDate', 'ToCountryID'])
        ->asArray();
        $model = $q->all();

        //echo "AD = ".$q->prepare(\Yii::$app->db->queryBuilder)->createCommand()->rawSql."\n";die("fgf");
        $pack = \yii\helpers\ArrayHelper::getColumn($model, 'package.PackageDate');

        return $pack;
    }

    public function getToursAvailableDate()
    {
        $price = [];
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
         ->select(['FROM_UNIXTIME(FlightDate, "%Y-%m-%d") as PackDate', 'FlightDate as flatdat', 'ROUND(MIN(PackagePrice)) as minprice'])
         ->where(['ToCountryID' => $this->country_id])
         ->andWhere(['activity' => 1])
         ->andFilterWhere(['IN', 'FlightDate', $this->getAvailableDate()])
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

    public function getDate()
    {
        $d = strtotime(date('Y-m-d', time()).' 00:00:00') + Yii::$app->params['h'];
        $query = $this->getQuery()
        ->select(['FROM_UNIXTIME(FlightDate, "%Y-%m-%d") as date', 'tours.PackagePrice'])
        //->where(['>', 'FlightDate', $d])
        ->where([">", "(date_format(FROM_UNIXTIME(FlightDate), '%Y-%m-%d'))", new Expression('DATE(NOW())')])
        ->andFilterwhere(['Adult' => $this->adult])
        ->andFilterwhere(['ToCountryID' => $this->country_id])
        ->andFilterwhere(['IN', 'AreaID', $this->region_id])
        ->groupBy(['FlightDateSource']);
        $model = $query->asArray()->all();
        return $model;
        //echo $query->prepare(\Yii::$app->db->queryBuilder)->createCommand()->rawSql;die("---");
    }

    public function getPeople()
    {
        /*$q = \frontend\models\Tours::find()
         ->select(['MAX(Adult) AS Adult', 'MAX(Child) AS Child'])
         ->where(['ToCountryID' => $this->country_id])
         ->andWhere(['activity' => 1])
         ->andFilterWhere(['IN', 'FlightDate', $this->getAvailableDate()])
         ->andFilterWhere(['IN', 'AreaID', $this->region_id])
         ->andFilterWhere(['FlightDate' => $this->date_from])
         ->asArray();

        $model = $q->one();*/

        $query = $this->getQuery()
        ->select(['MAX(Adult) AS Adult', 'MAX(Child) AS Child'])

        ;///->asArray();
        /*$query = \frontend\models\Tours::find()
        ->select(['MAX(Adult) AS Adult', 'MAX(Child) AS Child'])
        ->from('{{%tours}} to')
        ->innerJoin('(' .
                      $subQuery->prepare(Yii::$app->db->queryBuilder)
                               ->createCommand()
                               ->rawSql
                  . ') t', 't.AreaID = to.AreaID')
        //->where(['IN', 'FlightDate', $this->getAvailableDate(true)])
        ->filterWhere(['CountryID' => $this->country_id])
        ->andFilterWhere(['IN', 'AreaID', $this->region_id])
        //->andWhere(['activity' => 1])
        //->with(['hotel', 'toCountry', 'meal', 'area', 'hotel.category'])
        ->orderBy('CountryName')
        ->groupBy('CountryID');
echo $subQuery->prepare(Yii::$app->db->queryBuilder)
                               ->createCommand()
                               ->rawSql;die("---");
echo $query->prepare(\Yii::$app->db->queryBuilder)->createCommand()->rawSql;die("---");*/
        $model = $query->all();

        //echo "AD = ".$q->prepare(\Yii::$app->db->queryBuilder)->createCommand()->rawSql."\n";die();
        //print_r($model);

        return $model;
    }

    public function getPeople1()
    {
        $q = \frontend\models\Tours::find()
         ->select(['MAX(Adult) AS Adult', 'MAX(Child) AS Child'])
         ->where(['ToCountryID' => $this->country_id])
         ->andWhere(['activity' => 1])
         ->andFilterWhere(['IN', 'FlightDate', $this->getAvailableDate()])
         ->andFilterWhere(['IN', 'AreaID', $this->region_id])
         ->andFilterWhere(['FlightDate' => $this->date_from])
         ->asArray();

        $model = $q->one();

        //echo "AD = ".$q->prepare(\Yii::$app->db->queryBuilder)->createCommand()->rawSql."\n";die();
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
        //->where(['>=', 'FlightDate', $d])
        ->where([">=", "(date_format(FROM_UNIXTIME(FlightDate), '%Y-%m-%d'))", new Expression('DATE(NOW())')])
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
