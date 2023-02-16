<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;

class AppController extends Controller {

/*    public function __construct()
    {
        parent::__construct();
    }*/

    /**
     * Метод устанавливает мета-теги для страницы сайта
     * @param string $title
     * @param string $keywords
     * @param string $description
     */
    protected function setMetaTags($title = '', $keywords = '', $description = '') {
        Yii::$app->params['meta_title'] = $title ?: Yii::$app->params['defaultTitle'];
        $this->view->title = Yii::$app->params['meta_title'];
        $this->view->registerMetaTag([
            'name' => 'keywords',
            'content' => $keywords ?: Yii::$app->params['defaultKeywords']
        ]);
        $this->view->registerMetaTag([
            'name' => 'description',
            'content' => $description ?: Yii::$app->params['defaultDescription']
        ]);
    }

    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    protected function sendMail($data) //$body, $from = '', $to = '', $attach = '')
    {
        if (!$data['from'])
          $data['from'] = Yii::$app->config->noreply_email;

        if (!$data['to'])
          $data['to'] = Yii::$app->config->request_email;

        if ($data['tpl'])
          $r = Yii::$app->mailer->compose($data['tpl'], ['data' => $data]);
        else
          $r = Yii::$app->mailer->compose();

        $r->setTo($data['to'])
        ->setFrom($data['from']);
        $r->setSubject($data['subject']);

        if (!$data['tpl'] && $data['body'])
          $r->setHtmlBody($data['body']);

        if ($data['attach']){
            foreach ($data['attach'] as $att){
                $r->attach($att);
            }
        }
        try {
            $result = $r->send();
            if ($result) {
            }
            return $result;
        } catch(\Exception $e) {
            print_r($e->getMessage());
        }
        return false;
    }

    public function actionAddOrder()
    {
        if ($this->request->isPost) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $model = new \frontend\models\CourseForm();

            if ($model->load($this->request->post())) {
                if ($model->add()) {
                    $status = "success";
                } else {
                    $status = "error";
                }
            } else {
                $status = "error";
            }
            return ['status' => $status];
        }
    }

}