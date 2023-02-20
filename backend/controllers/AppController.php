<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;

class AppController extends Controller {

/*    public function __construct()
    {
        parent::__construct();
    }*/

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => false,
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Метод устанавливает мета-теги для страницы сайта
     * @param string $title
     * @param string $keywords
     * @param string $description
     */
    protected function setMetaTags($title = '', $keywords = '', $description = '') {
        Yii::$app->params['meta_title'] = $title ?: Yii::$app->params['defaultTitle'];
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

    public function actionUploadImg()
    {      
        $result = [];
        $result['status'] = 'error';
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = new \backend\models\UploadFileForm();
        if (Yii::$app->request->isPost) {
            $model->file = \yii\web\UploadedFile::getInstance($model, 'file');
            $result = $model->upload();
            /*if ($filename !== false) {
                $result['status'] = 'success';
                $result['file'] = $filename;
                //return $this->refresh();
            }*/
        }
        return $result;
        //return $this->renderAjax('index', ['model' => $model]);
    }

}