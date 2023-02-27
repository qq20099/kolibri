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
use frontend\models\Pages;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

use GuzzleHttp\Client; // подключаем Guzzle
//use electrolinux\phpquery\phpQuery; // подключаем Guzzle
use yii\helpers\Url;

/**
 * Site controller
 */
class SiteController extends AppController
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

    public function actionError()
    {
        die("gfg");
        return $this->render('index');
    }
    
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        //$countryFilter = [];
        $regionFilter = [];

        /*$model = \frontend\models\Tours::find()
        ->with(['hotel', 'toCountry', 'meal', 'area', 'hotelCategory'])
        ->where(['>=', 'FlightDate', strtotime(date('Y-m-d', time()).' 00:00:00')])
        ->andWhere(['main' => 1])
        ->joinWith('toCountry')
        ->orderBy(['{{%coraltravel_country}}.Name' => SORT_ASC])
        ->groupBy('ToCountryID')
        ->asArray()
        ->all();*/

        $searchModel = new \frontend\models\SearchTours();

        $params = Yii::$app->request->queryParams;

        $cookies = Yii::$app->request->cookies;
        $hot_sort_country = $cookies->getValue('hot_sort_country', 0);

        if (!isset($params['SearchTours']['country_id']) && $hot_sort_country) {
            $params['SearchTours']['country_id'] = $hot_sort_country;
        }

        $params['SearchTours']['main'] = 1;

        $dataProvider = $searchModel->search($params);

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

        ///if ($model) {
            /*$t = \yii\helpers\ArrayHelper::getColumn($model, 'toCountry');
            $countryFilter = \yii\helpers\ArrayHelper::map($t, 'ID', 'Name');

            if (count($countryFilter) > 1) {
                $countryFilter[0] = 'All';
                asort($countryFilter);
                //array_unshift($countryFilter, 'All');
            } else {
                $countryFilter = [];
            }*/

            /*$t = \yii\helpers\ArrayHelper::getColumn($model, 'are');
            $regionFilter = \yii\helpers\ArrayHelper::map($t, 'ID', 'Name');

            if (count($regionFilter) > 1) {
                $regionFilter[0] = 'All';
                asort($regionFilter);
                //array_unshift($countryFilter, 'All');
            } else {
                $regionFilter = [];
            }*/
        ///}

        $pages = new Pages();
        $page = $pages->getMainPage();

        $this->setMetaTags(
          $page->meta_title,
          $page->meta_keywords,
          $page->meta_description
        );

        return $this->render('index',
          compact('dataProvider', 'searchModel', 'hot_sort_country', 'page'));
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
        $data = Yii::$app->api->getPackageSearch();
        $data = Yii::$app->api->test();
        //$data = Yii::$app->api->getListFlightSupplier();
        //$data = Yii::$app->api->getListToCountry();
        //$data = Yii::$app->api->test();

        echo (($data['data']) ? count($data['data']) : 0);

        echo "<pre>";
        print_r($data);
        echo "</pre>";

    }

    public function actionMaintenance()
    {
        $this->layout = 'maintenance';
        return $this->render('maintenance');
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
                $client = \frontend\models\Client::find()
                 ->where('email = :email', [':email' => $model->email])
                 ->one();

                if (!$client) {
                   $client = new \frontend\models\Client();
                   $client->email = $model->email;
                }

                $client->load($this->request->post());
                $client->save();

                $model->client_id = $client->id;

                if ($model->save()) {
                    $status = "success";
                    $model->clientMail($client);
                    $model->adminMail($client);
                } else {
                    $status = "error";
                    //print_r($model->getErrors());
                }
            } else {
                $status = "error";
            }
            return ['status' => $status];
        }

    }

    public function actionPage($url)
    {
        $model = Pages::find()
        ->where('url = :url', [':url' => $url])
        ->andWhere(['activity' => 1])
        ->one();

        if (empty($model))
          throw new NotFoundHttpException();

        $this->setMetaTags(
          $model->meta_title,
          $model->meta_keywords,
          $model->meta_description
        );

        return $this->render('page', compact('model'));
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
