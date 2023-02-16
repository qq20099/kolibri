<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\CoraltravelHotel;
use frontend\models\Parser;
use yii\data\ActiveDataProvider;
use linslin\yii2\curl;

use GuzzleHttp\Client; // подключаем Guzzle
//use electrolinux\phpquery\phpQuery; // подключаем Guzzle
use yii\helpers\Url;

/**
 * Site controller
 */
class ParserController extends Controller
{
    public $id;
    public $cache;
    public $curl;
    public $img_folder;
    /**
     * {@inheritdoc}
     */
/*    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }*/

    /**
     * {@inheritdoc}
     */
    /*public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }*/

    public function init()
    {
        parent::init();
        require('../../vendor/electrolinux/phpquery/phpQuery/phpQuery.php');
        $this->cache = Yii::$app->cache;
        $this->curl = new curl\Curl();
        $this->img_folder = Yii::getAlias('@frontend/web/uploads/parser/hotels/');
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        //die($this->img_folder);
        $subQuery = Parser::find()->select('hotel_id');
        $model = CoraltravelHotel::find()->where(['not in', 'ID', $subQuery])->orderBy(['ID' => SORT_ASC])->one();
//print_r($model->ID);die();
        if ($model) {
            $this->id = $model->ID;


            $h = 'https://coraltravel.lv';
            $url = $h.'/lv/hotel/d/'.$model->ID;

            $key = 'body_'.md5($url);

            $body = $this->cache->getOrSet($key, function() use ($model, $url){
                $response = $this->curl->get($url);
                if ($curl->responseCode == 200) {
                    if ($curl->errorCode === null) {
                        return $response;
                    } else {}
                } else {
                }
            });

            if (!$body) {
                $m = new Parser();
                $m->hotel_id = $model->ID;
                $m->errors = 'empty';
                $m->link = $url;
                $m->save(false);
                die();
            }

            $data = $this->dereban($body);
            $data['link'] = $url;
            $data['errors'] = ($data['errors']) ? implode('\n', $data['errors']) : '';
            $model = new Parser();
            $model->attributes = $data;
            $model->save();
        }
    }

    private function dereban($html)
    {
        $data = [];
        $document = \phpQuery::newDocumentHTML($html);

        $data['hotel_id'] = $this->id;
        $data['page'] = $html;
        $data['title'] = $document->find('.heade-hotel-name h1')->text();

        $img_slider = $document->find('.hotel_gallery_center_slider');

        if (pq($img_slider)->length) {
            $img = $this->getImg($img_slider);
            $data['img'] = '';

            if ($img) {
                $data['img'] = $this->getImg($img_slider);
            } else {
                $data['errors'][] = 'error images';
            }
        }

        $tabs = $document->find('.new_hotel_tabs');

        if (pq($tabs)->length) {
            $data['html'] = pq($tabs)->html();
        } else {
            $data['errors'][] = 'error tabs';
        }

        $description = $document->find('.header-lead');

        if (pq($description)->length) {
            $data['description'] = pq($description)->html();
        } else {
            $data['errors'][] = 'error description';
        }

        /*if ($row_result->length) {
            foreach ($row_result as $row){
                $r = pq($row);
                $a_wrp = $r->find('.resultHotelName');
                $resultTitle = $a_wrp->find('.resultTitle')->text();
                $resultRoom = $r->find('.resultRoom span')->text();

                $l = $a_wrp->find('a')->attr('href');

                $dd = explode('?', $l);
                $d = explode('/', $dd[0]);
                $new_link = $h.'/lv/hotel/d/'.end($d).'?'.$dd[1];
                //echo $l.' ::::: '.$new_link."<br>";
                $key = '_l'.md5($new_link);
                $page = $cache->getOrSet($key, function() use ($new_link){
                    return file_get_contents($new_link);
                });
                echo $page;die();
            }
        }   */
        return $data;
    }

    private function getImg($img_slider)
    {
        $data = [];
        $b_path = $this->img_folder.$this->id.'/b/';
        $t_path = $this->img_folder.$this->id.'/t/';

        $slides = $img_slider->find('.hotel_gal_pic_thumb');

        if ($slides->length) {

            if (!is_dir($b_path))
              mkdir($b_path, 0777, true);
            if (!is_dir($t_path))
              mkdir($t_path, 0777, true);

            foreach ($slides as $value) {
                $im_url_b = pq($value)->attr('href');
                $im_url_t = pq($value)->find('img')->attr('src');
                $img_b = $this->curl->get($im_url_b);

                if ($img_b) {
                    $n = basename($im_url_b);
                    $data[] = $n;
                    file_put_contents($b_path.$n, $img_b);
                }

                $img_t = $this->curl->get($im_url_t);

                if ($img_t) {
                    file_put_contents($t_path.basename($im_url_t), $img_t);
                }
            }
        }
        return ($data) ? implode('|', $data) : '';
    }

    public function actionIndex1()
    {
        $model = CoraltravelHotel::find()->orderBy(['ID' => SORT_DESC])->one();

        $h = 'https://coraltravel.lv';
        require('../../vendor/electrolinux/phpquery/phpQuery/phpQuery.php');
        $cache = Yii::$app->cache;
        $client = new Client();
        // отправляем запрос к странице Яндекса
        $url = $h.'/lv/hotel/d/'.$model->ID;
            //$body1 = file_get_contents($url);
            $res = $client->request('GET', $url);
            //return $res->getStatusCode();
            print_r($res);
        //$body1 = $res->getBody();
        $key = '_body_'.md5($url);
        echo $body1;die();
        //echo $url;die();
        $body1 = $cache->getOrSet($key, function() use ($client, $url){
            return file_get_contents($url);
        });

print_r($body1);die();
        $document = \phpQuery::newDocumentHTML($body1);
        //Смотрим html страницы Яндекса, определяем внешний класс списка и считываем его командой find
        $row_result = $document->find(".row.result");
        $links = $document->find(".resultHotelName a");

        if ($row_result->length) {
            foreach ($row_result as $row){
                $r = pq($row);
                $a_wrp = $r->find('.resultHotelName');
                $resultTitle = $a_wrp->find('.resultTitle')->text();
                $resultRoom = $r->find('.resultRoom span')->text();

                $l = $a_wrp->find('a')->attr('href');

                $dd = explode('?', $l);
                $d = explode('/', $dd[0]);
                $new_link = $h.'/lv/hotel/d/'.end($d).'?'.$dd[1];
                //echo $l.' ::::: '.$new_link."<br>";
                $key = '_l'.md5($new_link);
                $page = $cache->getOrSet($key, function() use ($new_link){
                    return file_get_contents($new_link);
                });
                echo $page;die();
            }
        }
        die();
        if ($links->length) {
            foreach ($links as $link){
                $l = pq($link)->attr('href');
                $dd = explode('?', $l);
                $d = explode('/', $dd[0]);
                $new_link = $h.'/lv/hotel/d/'.end($d).'?'.$dd[1];
                //echo $l.' ::::: '.$new_link."<br>";
                $key = '_l'.md5($new_link);
                //$l = $h.urlencode($l);
                /*$l = $h.$l;
                $l = 'https://coraltravel.lv/lv/hotel/d/9117?tripId=e16ce0574b8faefb25ada63938744597&amp;adults=2&amp;children=0';    */
                $page = $cache->getOrSet($key, function() use ($new_link){
                    return file_get_contents($new_link);
                });
                echo $page;die();
            }
        }

        die();
        // вывод списка новостей Яндекса с главной страницы в представление


        // получаем данные между открывающим и закрывающим тегами body
        /*$body = Yii::$app->cache->get($key);

        if (!$body) {
            $res = $client->request('GET', $url);
            $body = $res->getBody();
            Yii::$app->cache->set($key, $body);
        }*/

        // вывод страницы Яндекса в представление
        return $this->render('coraltravel', ['body' => $body1]);
    }

}
