<?php

namespace backend\controllers;

use Yii;
use backend\models\CoraltravelHotel;
use backend\models\SearchHotel;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * HotelController implements the CRUD actions for CoraltravelHotel model.
 */
class HotelController extends AppController
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all CoraltravelHotel models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new SearchHotel();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUploads()
    {
        $model = new \backend\models\UploadFilesForm();

        if (Yii::$app->request->isPost) {
            $model->files = \yii\web\UploadedFile::getInstancesByName('files');
            if ($model->upload()) {
                return $this->renderAjax('images', ['model' => $model]);
            } else {
                foreach ($model->errors as $value) {
                    $er = implode("\r\n", $value);
                }
                echo '<div class="errors uploads-error">'.$er.'</div>';
                die();
            }
        }

    }

    public function actionSetMain()
    {
        /*$a = [];
        $a['status'] = 'error';

        if (\Yii::$app->request->isAjax) {
            $id = $this->request->post('id');
            $model = \backend\models\Images::findOne($id);

            \backend\models\Images::updateAll(['main' => 0,], ['hotel_id' => $model->hotel_id,]);

            $model->main = 1;
            if ($model->save()) {
                $a['status'] = 'success';
            }
        }
        return \yii\helpers\Json::encode($a);*/
    }

    /**
     * Creates a new CoraltravelHotel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    /*public function actionCreate()
    {
        $model = new CoraltravelHotel();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'ID' => $model->ID]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }*/

    /**
     * Updates an existing CoraltravelHotel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $ID ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($ID)
    {
        $model = $this->findModel($ID);

        if ($this->request->isPost && $model->load($this->request->post())) {
            if ($model->save()) {
                $path = Yii::getAlias('@frontend');
                if ($model->HotelImages) {
                    $dir = \Yii::getAlias('@uploadsTmpDir');
                    $path_img_thumbs = $path.'/web'.$model->path_img_thumbs;
                    $path_img_big = $path.'/web'.$model->path_img_big;
                    $path_img_t = $path.'/web'.$model->path_img_t;

                    if (!is_dir($path_img_thumbs))
                      \yii\helpers\FileHelper::createDirectory($path_img_thumbs);
                    if (!is_dir($path_img_big))
                      \yii\helpers\FileHelper::createDirectory($path_img_big);

                    foreach ($model->HotelImages as $key => $value) {
                        $HotelImages = new \backend\models\Images();
                        $HotelImages->title = $value;
                        $HotelImages->hotel_id = $model->ID;
                        if ($HotelImages->save()) {
                            if (is_file($dir.'/'.$value)) {
                                rename($dir.'/thumb_'.$value, $path_img_t.$value);
                                rename($dir.'/'.$value, $path_img_big.$value);
                            }
                        }
                    }
                }

                if ($model->m_img) {
                    $model->m_img = str_replace($model->path_img_t, '', $model->m_img);
                    $model->m_img = str_replace('/uploads/tmp/thumb_', '', $model->m_img);
                    $images = \backend\models\Images::find()
                      ->where(['title' => $model->m_img])
                      ->andWhere(['hotel_id' => $model->ID])
                      ->one();

                    if ($images->id) {
                        $images->main = 1;
                        if ($images->save()) {
                            \backend\models\Images::updateAll(['main' => 0],
                                [
                                    'AND',
                                    ['hotel_id' => $model->ID],
                                    ['!=', 'id', $images->id],
                                ]
                            );
                        }
                    }
                }

                if ($model->delimg) {
                    $delimg = explode('|', $model->delimg);
                    foreach ($delimg as $img) {
                        if (is_file($path.'/web'.$img)) {
                            unlink($path.'/web'.$img);
                        }
                        $b = str_replace('/t/thumb_', '/b/', $img);

                        if (is_file($path.'/web'.$b)) {
                            unlink($path.'/web'.$b);
                        }

                        $b = str_replace('thumb_', '', basename($img));

                        $images = \backend\models\Images::find()
                          ->where(['title' => $b])
                          ->andWhere(['hotel_id' => $model->ID])
                          ->one();

                        if (isset($images->id) && $images->id)
                          $images->delete();
                    }
                }
                //die();
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing CoraltravelHotel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $ID ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($ID)
    {
        $model = $this->findModel($ID);
        $model->delete();
        \backend\models\Images::deleteAll(['hotel_id' => $ID]);

        $path = Yii::getAlias('@frontend');
        $path = $path.'/web';
        $dir = $path.$model->path_img;

        \yii\helpers\FileHelper::removeDirectory($dir);

        return $this->redirect(['index']);
    }

    /**
     * Finds the CoraltravelHotel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $ID ID
     * @return CoraltravelHotel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ID)
    {
        if (($model = CoraltravelHotel::find()->where(['ID' => $ID])->with(['images', 'mainImg'])->one()) !== null) {
            $model->path_img = str_replace('{ID}', $model->ID, $model->path_img);
            $model->path_img_thumbs = str_replace('{ID}', $model->ID, $model->path_img_thumbs);
            $model->path_img_t = str_replace('{ID}', $model->ID, $model->path_img_t);
            $model->path_img_big = str_replace('{ID}', $model->ID, $model->path_img_big);

            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
