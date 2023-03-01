<?php
/**
 * Created by PhpStorm.
 * User: mihailvysocin
 * Date: 10/23/18
 * Time: 11:08 AM
 */

namespace common\components;


use SimpleXMLElement;
use Yii;
use yii\base\Component;
use yii\base\Exception;
use yii\web\BadRequestHttpException;
use SoapClient;
use yii\httpclient\Client;
use yii\helpers\Json;

/**
 * @inheritdoc
 *
 * @property EasyCreditApi $creditApi
 */
class Api extends Component
{
    private $_client;
    private $language = 'ru';
    private $token;
    public $baseUrl;
    public $login;
    public $password;

/*    public function __construct(array $config = [])
    {
        //$this->setLanguage();
        //$this->setLogin(Yii::$app->params['loans']['login']);
        parent::__construct($config);
    }*/

    /**
     * @throws BadRequestHttpException
     */
/*    private function validateParams()
    {
        foreach ($this->getSoapParams() as $name => $param) {
            if (empty($param)) {
                throw new BadRequestHttpException('bad param: empty ' . $name);
            }
        }
    }*/

    public function getLanguageList()
    {
        $response = $this->createRequest()
          ->setData([
              'Command' => 'GetLanguageList',
              'Token' => null,
              'Parameters' => ''
          ])
          ->send();

        return $this->parseResult($response, __FUNCTION__);
    }

    private function getToken()
    {
        $this->token = Yii::$app->cache->get('token');

        if (!$this->token) {
            $data = $this->login();

            if ($data) {
                $this->token = $data['data']['UserToken'];//$data['UserToken'];
                Yii::$app->cache->set('token', $this->token);
            }
        }
        return $this->token;
    }

    private function login()
    {
        $response = $this->createRequest()
          ->setData([
              'Command' => 'Login',
              'Token' => null,
              'Parameters' => Json::encode([
                  'user' => $this->login,
                  'Password' => $this->password,
                  'Language' => 12,
              ]),
          ])
          ->send();

        return $this->parseResult($response, __FUNCTION__);

/*        $responseData = $response->getData();

          echo "<pre>";
          print_r($responseData);
          echo "</pre>";
                 die();
        if ($responseData['Response'] == 'SUCCESS') {
            return Json::decode($responseData['Details']);
        }

        return false;*/

    }

    //Получает все определения области.
    public function getListArea()
    {
        $response = $this->createRequest()
          ->setData([
              'Command' => 'General.Geography.ListArea',
              'Token' => $this->getToken(),
              'Parameters' => Json::encode([
                  [
                      'Name' => 'FromArea',
                      'Value' => 3345,
                  ]
              ]),
          ])
          ->send();
        return $this->parseResult($response, __FUNCTION__);
    }

    //Получает все определения региона
    public function getListRegion()
    {
        $response = $this->createRequest()
          ->setData([
              'Command' => 'General.Geography.ListRegion',
              'Token' => $this->getToken(),
          ])
          ->send();
        return $this->parseResult($response, __FUNCTION__);
    }

    //Получает все географические определения.
    public function getListGeography()
    {
        /*echo __METHOD__;
        echo "<br>";
        echo __FUNCTION__;
        die();*/
        $response = $this->createRequest()
          ->setData([
              'Command' => 'General.Geography.ListGeography',
              'Token' => $this->getToken(),
          ])
          ->send();
        return $this->parseResult($response, __FUNCTION__);
    }

    //Получает все определения групп категорий отелей.
    public function getListHotelCategoryGroup()
    {
        $response = $this->createRequest()
          ->setData([
              'Command' => 'Accommodation.Hotel.ListHotelCategoryGroup',
              'Token' => $this->getToken(),
          ])
          ->send();
        return $this->parseResult($response, __FUNCTION__);
    }

    //Получает все определения групп фильтров помещений.
    public function getListRoomFilterGroup()
    {
        $response = $this->createRequest()
          ->setData([
              'Command' => 'Accommodation.Room.ListRoomFilterGroup',
              'Token' => $this->getToken(),
          ])
          ->send();
        return $this->parseResult($response, __FUNCTION__);
    }

    //Получает список пакетов, соответствующий критериям поиска.
    public function getPackageSearch($p = [])
    {
        //print_r($p);die();
        //echo 'ToCountry = '.$p['ToCountry']."\r\n";
        $response = $this->createRequest()
          ->setData([
              'Command' => 'Product.Package.PackageSearch',
              'Token' => $this->getToken(),
              'Parameters' => Json::encode(($p) ? $p : self::defDeal())/*Json::encode([
                  'BeginDate' => '2023-04-16T00:00:00',
                  'EndDate' => '2023-05-01T00:00:00',
                  'FromArea' => 3345,
                  'ToCountry' => 1,
                  'ToPlace' => '',
                  //'ToPlace' => '79, 106',
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
                  'BeginNight' => 7,
                  'EndNight' => 10,
                  'Adult' => 2,
                  'Child' => 0,
                  'Child1Age' => 0,
                  'Child2Age' => 0,
                  'Child3Age' => 0,
                  'OnlyAvailableFlight' => false,
                  'NotShowStopSale' => false,
                  'ShowOnlyConfirm' => false,
                  'StartIndex' => 3,
                  'PageSize' => 100,
                  'Currency' => '3',
                  'RoomFilterGroup' => 0,
                  ///'HotelConcept' => '',
                  'Recommended' => false
              ])*/,
          ])
          ->send();
        return $this->parseResult($response, __FUNCTION__);
    }

    //Получает всю доступную информацию о дате для пакета.
    public function getListPackageAvailableDate($d = [])
    {
        $a = [];
        $parameters = [];
        $d =
                       [
                       [
                           "FromArea" => 2671
                       ]
                       ];


        if ($d) {
            foreach ($d as $v) {
                $data[] = (array_combine(['Name', 'Value'], [array_keys($v)[0], array_values($v)[0]]));
            }
            //$parameters['Parameters'] = Json::encode($data);
        }

        $response = $this->createRequest()
          ->setData([
              'Command' => 'Product.Package.ListPackageAvailableDate',
              'Token' => $this->getToken(),
              'Parameters' => Json::encode([
                  [
                      'Name' => 'FromArea',
                      'Value' => 3345,
                  ]
              ]),
          ])
          ->send();
        return $this->parseResult($response, __FUNCTION__);
    }


    public function getListToCountry()
    {
        $response = $this->createRequest()
          ->setData([
              'Command' => 'Product.Package.ListToCountry',
              'Token' => $this->getToken(),
              'Parameters' => Json::encode([
                  [
                      'Name' => 'FromArea',
                      'Value' => 3345,
                  ]
              ]),
          ])
          ->send();
        return $this->parseResult($response, __FUNCTION__);
    }

    //Получает все определения классов мест.
    public function getListSeatClass()
    {
        $response = $this->createRequest()
          ->setData([
              'Command' => 'Flight.General.ListSeatClass',
              'Token' => $this->getToken(),
          ])
          ->send();
        return $this->parseResult($response, __FUNCTION__);
    }

    //Получает все определения размещения
    public function getListAcc()
    {
        $response = $this->createRequest()
          ->setData([
              'Command' => 'Accommodation.General.ListAcc',
              'Token' => $this->getToken(),
          ])
          ->send();
        return $this->parseResult($response, __FUNCTION__);
    }

    //Получает все определения еды.
    public function getListMeal()
    {
        $response = $this->createRequest()
          ->setData([
              'Command' => 'Accommodation.Meal.ListMeal',
              'Token' => $this->getToken(),
          ])
          ->send();
        return $this->parseResult($response, __FUNCTION__);
    }

    //Получает все определения категории еды.
    public function getListMealCategory()
    {
        $response = $this->createRequest()
          ->setData([
              'Command' => 'Accommodation.Meal.ListMealCategory',
              'Token' => $this->getToken(),
          ])
          ->send();
        return $this->parseResult($response, __FUNCTION__);
    }

    //Получает все определения комнаты.
    public function getListRoom()
    {
        $response = $this->createRequest()
          ->setData([
              'Command' => 'Accommodation.Room.ListRoom',
              'Token' => $this->getToken(),
              /*'Parameters' => Json::encode([
                  [
                      'Name' => 'RoomCategory',
                      'Value' => 1,
                  ],
                  [
                      'Name' => 'Name',
                      'Value' => 'SEA SIDE',
                  ]
              ]),*/
          ])
          ->send();
        return $this->parseResult($response, __FUNCTION__);
    }

    //Получает все определения групп категорий комнат.
    public function getListRoomCategoryGroup()
    {
        $response = $this->createRequest()
          ->setData([
              'Command' => 'Accommodation.Room.ListRoomCategoryGroup',
              'Token' => $this->getToken(),
          ])
          ->send();
        return $this->parseResult($response, __FUNCTION__);
    }

    //Получает все определения категорий помещений.
    public function getListRoomCategory()
    {
        $response = $this->createRequest()
          ->setData([
              'Command' => 'Accommodation.Room.ListRoomCategory',
              'Token' => $this->getToken(),
          ])
          ->send();
        return $this->parseResult($response, __FUNCTION__);
    }

    //Получает все определения отелей.
    public function getListHotel()
    {
        $response = $this->createRequest()
          ->setData([
              'Command' => 'Accommodation.Hotel.ListHotel',
              'Token' => $this->getToken(),
              'Parameters' => Json::encode([
                  /*[
                      'Name' => 'RoomCategory',
                      'Value' => 1,
                  ],
                  [
                      'Name' => 'Name',
                      'Value' => 'OTIUM ECO',
                      'Name' => 'Place',
                      'Value' => 220,
                      'Name' => 'HotelCategory',
                      'Value' => 37,
                  ],
                  [
                      'Name' => 'Place',
                      'Value' => 1,
                  ],*/
                  [
                      'Name' => 'PageSize',
                      'Value' => 100,
                  ]
              ]),
          ])
          ->send();
        return $this->parseResult($response, __FUNCTION__);
    }

    //Получает все определения концепции отеля.
    public function getListHotelConcept()
    {
        $response = $this->createRequest()
          ->setData([
              'Command' => 'Accommodation.Hotel.ListHotelConcept',
              'Token' => $this->getToken(),
          ])
          ->send();
        return $this->parseResult($response, __FUNCTION__);
    }

    //Получает все определения категорий отелей.
    public function getListHotelCategory()
    {
        $response = $this->createRequest()
          ->setData([
              'Command' => 'Accommodation.Hotel.ListHotelCategory',
              'Token' => $this->getToken(),
          ])
          ->send();
        return $this->parseResult($response, __FUNCTION__);
    }

    //Получает все определения валюты.
    public function getListCurrency()
    {
        $response = $this->createRequest()
          ->setData([
              'Command' => 'General.Currency.ListCurrency',
              'Token' => $this->getToken(),
          ])
          ->send();
        return $this->parseResult($response, __FUNCTION__);
    }

    //Получает все определения страны.
    public function getListCountry()
    {
        $response = $this->createRequest()
          ->setData([
              'Command' => 'General.Geography.ListCountry',
              'Token' => $this->getToken(),
          ])
          ->send();
        return $this->parseResult($response, __FUNCTION__);
    }

    public function getListFlightSupplier()
    {
        $response = $this->createRequest()
          ->setData([
              'Command' => 'Flight.General.ListFlightSupplier',
              'Token' => $this->getToken(),
          ])
          ->send();
        return $this->parseResult($response, __FUNCTION__);
    }

    public function getListToAirport()
    {
        $response = $this->createRequest()
          ->setData([
              'Command' => 'Flight.General.ListAirportView',
              'Token' => $this->getToken(),
          ])
          ->send();
        return $this->parseResult($response, __FUNCTION__);
    }

    //Получает все определения мест
    public function getListPlace()
    {
        $response = $this->createRequest()
          ->setData([
              'Command' => 'General.Geography.ListPlace',
              'Token' => $this->getToken(),
              'Parameters' => Json::encode([
                  [
                      'Name' => 'FromArea',
                      'Value' => 3345,
                  ]
              ]),
          ])
          ->send();
        return $this->parseResult($response, __FUNCTION__);
    }

    public function test1()
    {
        $client = new Client();
        $response = $client->createRequest()
          ->setMethod('post')
          ->setUrl('https://product.coraltravel.lv/EEService.svc/json/ProcessMessage')
          ->setData(['LOGIN' => $this->getLogin(), 'PASS' => $this->getPassword()])
          ->send();
          print_r($response);
          if ($response->isOk) {
              $newUserId = $response->data['id'];
          }
    }

    private function parseResult($data, $methodName)
    {
        $responseData = $data->getData();
/*echo "<pre>";
print_r($responseData);
echo "</pre>";*/
//die();*/
        if ($responseData['Response'] == 'SUCCESS') {
            return [
                'data' => Json::decode($responseData['Details']),
                'status' => 'success',
            ];
        } elseif (isset($responseData['Details']) && !$responseData['Error']) {
            return [
                'data' => Json::decode($responseData['Details']),
                'status' => 'success',
            ];
        } else {
            if ($responseData['Response'] == 'ERROR_SESSION_NOT_FOUND') {
                Yii::$app->cache->delete('token');
                return $this->{$methodName}();
            } else {
                return [
                    'Details' => $responseData['Details'],
                    'msg' => $responseData['Response'],
                    'status' => 'error',
                ];
            }
        }

        return [
            'data' => $responseData['Response'],
            'status' => 'error',
        ];
    }

    private function getClient()
    {
        if (!is_object($this->_client)) {
            $this->_client = Yii::createObject([
                'class' => Client::className(),
                //'baseUrl' => $this->baseUrl,
                'requestConfig' => [
                    'format' => Client::FORMAT_JSON
                ],
                'responseConfig' => [
                    'format' => Client::FORMAT_JSON
                ],
            ]);
        }
        return $this->_client;
    }

    private function createRequest()
    {
        $client = new Client();
        return $client->createRequest()
          ->setFormat(Client::FORMAT_JSON)
          ->setMethod('post')
          ->setUrl($this->baseUrl);
    }

    public static function testParams()
    {
        $oldDate = date('Y-m-d');
        $BeginDate = date("Y-m-d", strtotime($oldDate));
        $EndDate = date("Y-m-d", strtotime($oldDate.'+ 60 days'));
        $p = [
            'BeginDate' => $BeginDate.'T00:00:00', //'2022-12-18T00:00:00',
            'EndDate' => $EndDate.'T00:00:00',
        /*$p = [
            'BeginDate' => '2023-04-16T00:00:00',
            'EndDate' => '2023-05-01T00:00:00',*/
            'FromArea' => 3345,
            'ToCountry' => "80",
            //'ToCountry' => 42,
            //'ToCountry' => 12,
            'ToPlace' => 9962,
            //'ToRegion' => 14866,
            //'ToPlace' => '79, 106',
            //'HotelCategoryGroup' => '4, 5',
            'HotelCategoryGroup' => '',
            //'RoomCategoryGroup' => '1, 2',
            'RoomCategoryGroup' => '',
            //'MealCategory' => '5, 6',
            'MealCategory' => '',
            //'Hotel' => '10726, 300',
            'Hotel' => '',
            'MinPrice' => 100,
            'MaxPrice' => 5000,
            'BeginNight' => 7,
            'EndNight' => 15,
            'Adult' => 2,
            'Child' => 0,
            /*'Child1Age' => 0,
            'Child2Age' => 0,
            'Child3Age' => 0,*/
            'OnlyAvailableFlight' => false,
            'NotShowStopSale' => false,
            'ShowOnlyConfirm' => false,
            'StartIndex' => 3,
            'PageSize' => 100,
            'Currency' => '3',
            'RoomFilterGroup' => 0,
            ///'HotelConcept' => '',
            'Recommended' => false
        ];
        return $p;
    }

    private static function defDeal()
    {
        $oldDate = date('Y-m-d');
        $BeginDate = date("Y-m-d", strtotime($oldDate));
        $EndDate = date("Y-m-d", strtotime($oldDate.'+ 60 days'));
        $p = [
            'BeginDate' => $BeginDate.'T00:00:00', //'2022-12-18T00:00:00',
            'EndDate' => $EndDate.'T00:00:00',
        /*$p = [
            'BeginDate' => '2023-04-16T00:00:00',
            'EndDate' => '2023-05-01T00:00:00',*/
            'FromArea' => 3345,
            'ToCountry' => "80",
            //'ToCountry' => 42,
            //'ToCountry' => 12,
            'ToPlace' => 9962,
            //'ToRegion' => 14866,
            //'ToPlace' => '79, 106',
            //'HotelCategoryGroup' => '4, 5',
            'HotelCategoryGroup' => '',
            //'RoomCategoryGroup' => '1, 2',
            'RoomCategoryGroup' => '',
            //'MealCategory' => '5, 6',
            'MealCategory' => '',
            //'Hotel' => '10726, 300',
            'Hotel' => '',
            'MinPrice' => 100,
            'MaxPrice' => 5000,
            'BeginNight' => 7,
            'EndNight' => 15,
            'Adult' => 2,
            'Child' => 0,
            /*'Child1Age' => 0,
            'Child2Age' => 0,
            'Child3Age' => 0,*/
            'OnlyAvailableFlight' => false,
            'NotShowStopSale' => false,
            'ShowOnlyConfirm' => false,
            'StartIndex' => 3,
            'PageSize' => 100,
            'Currency' => '3',
            'RoomFilterGroup' => 0,
            ///'HotelConcept' => '',
            'Recommended' => false
        ];
        return $p;
    }

    private static function hotDeal()
    {
        $p = Json::encode([
                  'BeginDate' => '2022-12-18T00:00:00',
                  'EndDate' => '2023-02-16T00:00:00',

                  //'BeginDate' => '2023-04-01T00:00:00',
                  //'EndDate' => '2023-05-01T00:00:00',
                  //'FromArea' => '3, 8, 10',
                  'ToArea' => 3370,
                  'FromArea' => 3345,
                  'ToCountry' => 42, //'1, 12, 35',
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
                  'BeginNight' => 7,
                  'EndNight' => 21,
                  'Adult' => 2,
                  'Child' => 0,
                  'OnlyAvailableFlight' => false,
                  'NotShowStopSale' => false,
                  'ShowOnlyConfirm' => false,
                  'StartIndex' => 1,
                  'PageSize' => 100,
                  'Currency' => '3',
                  'RoomFilterGroup' => 0,
                  ///'HotelConcept' => '',
                  'Recommended' => false
              ]);

        return $p;
    }

    public function test()
    {
        $d = json_decode('{"BeginDate":"2023-03-03","EndDate":"2023-03-03","FromArea":3345,"ToCountry":"31","ToPlace":"","HotelCategoryGroup":"","RoomCategoryGroup":"","MealCategory":"","Hotel":"","MinPrice":0,"MaxPrice":0,"BeginNight":0,"EndNight":30,"Adult":1,"Child":NULL,"OnlyAvailableFlight":false,"NotShowStopSale":false,"ShowOnlyConfirm":false,"StartIndex":1,"PageSize":100,"Currency":3,"RoomFilterGroup":0,"Recommended":false,"ToArea":0}');

        $data = $this->getPackageSearch($d);
        echo "<pre>";
        print_r($data);
        echo "\r\n------------------------\r\n";
        print_r($d);
        echo "</pre>";
        die();
        /*$client = new Client();
        $re = $client->createRequest()
          //->setFormat(Client::FORMAT_JSON)
          ->setMethod('get')
          ->setUrl('https://www.tripadvisor.com/Hotel_Review-g662606-d285140')
          ->send();*/
          //$re = file_get_contents('https://www.tripadvisor.com/');
          //print_r($re);
    }
}