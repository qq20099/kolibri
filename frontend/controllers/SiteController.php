<?php

namespace frontend\controllers;

use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use frontend\models\Ticket;
use yii\data\ActiveDataProvider;

use GuzzleHttp\Client; // подключаем Guzzle
//use electrolinux\phpquery\phpQuery; // подключаем Guzzle
use yii\helpers\Url;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
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
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
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
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $countryFilter = [];
        $regionFilter = [];
        /*$data = Yii::$app->api->getPackageSearch(self::hotDeal());

        echo (($data['data']) ? count($data['data']) : 0);

        echo "<pre>";
        print_r($data);
        echo "</pre>";

        die();*/

        $model = \frontend\models\Tours::find()->all();
        //$model = \frontend\models\CoraltravelPackageAvailableDate::find()->all();

/*foreach ($model as $value) {
    //echo $value->PackageDate."<br>";
    //$value->PackageDate = strtotime(date('Y-m-d', $value->PackageDate).' 00:00:00');
    $value->HotelCheckInDate = strtotime(date('Y-m-d', $value->HotelCheckInDate).' 00:00:00');
    //echo $value->PackageDate."<br>";
    $value->FlightDate = strtotime(date('Y-m-d', $value->FlightDate).' 00:00:00');
    $value->save();
    //die();
}
die();*/
        $model = \frontend\models\Tours::find()
        ->with(['hotel', 'toCountry', 'meal', 'area', 'hotelCategory'])
        ->where(['>=', 'FlightDate', strtotime(date('Y-m-d', time()).' 00:00:00')])
        ->andWhere(['main' => 1])
        ->joinWith('toCountry')
        ->orderBy(['{{%coraltravel_country}}.Name' => SORT_ASC])
        ->groupBy('ToCountryID')
        ->asArray()
        ->all();

        $searchModel = new \frontend\models\SearchTours();

        $params = Yii::$app->request->queryParams;

        $cookies = Yii::$app->request->cookies;
        $hot_sort_country = $cookies->getValue('hot_sort_country', 0);

        if (!isset($params['SearchTours']['country_id']) && $hot_sort_country) {
            $params['SearchTours']['country_id'] = $hot_sort_country;
        }

        $params['SearchTours']['main'] = 1;

        $dataProvider = $searchModel->search($params);

/*echo "<pre>";
print_r($model);
print_r($d);
//print_r($countryId);
//print_r($countryTitle);
//print_r($dataProvider->getModels());
echo "</pre>";
die();*/
        $cookies = Yii::$app->response->cookies;

        if (isset($params['SearchTours']['country_id']) && $params['SearchTours']['country_id'] > 0) {
            $cookies->add(new \yii\web\Cookie([
                'name' => 'hot_sort_country',
                'value' => (int)$searchModel->country_id
            ]));
            $hot_sort_country = $searchModel->country_id;
        } else {
            $cookies->remove('hot_sort_country');
            $hot_sort_country = 0;
        }

        if ($model) {
            $t = \yii\helpers\ArrayHelper::getColumn($model, 'toCountry');
            $countryFilter = \yii\helpers\ArrayHelper::map($t, 'ID', 'Name');

            if (count($countryFilter) > 1) {
                $countryFilter[0] = 'All';
                asort($countryFilter);
                //array_unshift($countryFilter, 'All');
            } else {
                $countryFilter = [];
            }

            /*$t = \yii\helpers\ArrayHelper::getColumn($model, 'are');
            $regionFilter = \yii\helpers\ArrayHelper::map($t, 'ID', 'Name');

            if (count($regionFilter) > 1) {
                $regionFilter[0] = 'All';
                asort($regionFilter);
                //array_unshift($countryFilter, 'All');
            } else {
                $regionFilter = [];
            }*/
        }

        if (!in_array(Yii::$app->request->userIP, ['127.0.0.1', '188.163.16.161']))
          ;//return $this->render('close');

        return $this->render('index',
          compact('dataProvider', 'searchModel', 'hot_sort_country', 'countryFilter', 'regionFilter'));
    }

    public function actionParser()
    {
        $h = 'https://coraltravel.lv';
        require('../../vendor/electrolinux/phpquery/phpQuery/phpQuery.php');
        $cache = Yii::$app->cache;
        $client = new Client();
        // отправляем запрос к странице Яндекса
        $url = $h.'/lv/results?flightDateFrom=27/12/2022&flightDateTo=25/02/2023&tripDurationFrom=7&tripDurationTo=21&adults=2&children=0';
            //$body1 = file_get_contents($url);
            //$res = $client->request('GET', $url);
            //return $res->getStatusCode();
            //print_r($res);
        //$body1 = $res->getBody();
        $key = '_body_'.$url;
        $body1 = $cache->getOrSet($key, function() use ($client, $url){
            return file_get_contents($url);
        });

//print_r($body1);die();
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

    public function actionApi()
    {
        //$data = Yii::$app->api->getLanguageList();
        //Yii::$app->api->login();
        //$data = Yii::$app->api->getListRegion();
        //$data = Yii::$app->api->getListArea();
        //$data = Yii::$app->api->getListPlace();
        //$data = Yii::$app->api->getListCountry();
        //$data = Yii::$app->api->getListGeography();
        //$data = Yii::$app->api->getListCurrency();
        //$data = Yii::$app->api->getListHotelCategory();
        //$data = Yii::$app->api->getListHotelCategoryGroup();
        //$data = Yii::$app->api->getListHotelConcept();
///        $data = Yii::$app->api->getListHotel();
        //$data = Yii::$app->api->getListRoomCategory();
        //$data = Yii::$app->api->getListRoomCategoryGroup();
        //$data = Yii::$app->api->getListRoomFilterGroup();
        //$data = Yii::$app->api->getListRoom(); //['data'][0];
        //$data = Yii::$app->api->getListMealCategory();
        //$data = Yii::$app->api->getListMeal();
        //$data = Yii::$app->api->getListAcc();
        //$data = Yii::$app->api->getListSeatClass();
        //$data = Yii::$app->api->getListToCountry();
        //$data = Yii::$app->api->getListPackageAvailableDate();
        //$data = Yii::$app->api->getPackageSearch();
        //$data = Yii::$app->api->getListFlightSupplier();
        $data = Yii::$app->api->getListToCountry();
        //$data = Yii::$app->api->test();

        echo (($data['data']) ? count($data['data']) : 0);

        echo "<pre>";
        print_r($data);
        echo "</pre>";

    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        }

        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAddOrder()
    {
        $status = 'success';
        if ($this->request->isPost) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $model = new \frontend\models\OrderForm();

            if ($model->load($this->request->post())) {
                $client = \frontend\models\Client::find()->where('email = :email', [':email' => $model->email])->one();


                if (!$client) {
                   $client = new \frontend\models\Client();         
                   $client->email = $model->email;
                }

                $client->load($this->request->post());
                $client->save();

                $model->client_id = $client->id;

                if ($model->save()) {
                    $status = "success";
                } else {
                    $status = "error";
                    print_r($model->getErrors());
                }
            } else {
                $status = "error";
            }
            return ['status' => $status];
        }

    }

    public function actionPage()
    {
        return $this->render('page');
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            }

            Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if (($user = $model->verifyEmail()) && Yii::$app->user->login($user)) {
            Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
            return $this->goHome();
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }


}
