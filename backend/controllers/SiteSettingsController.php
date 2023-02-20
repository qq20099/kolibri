<?php

namespace backend\controllers;

use backend\models\SiteSettings;
use backend\models\SearchSiteSettings;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SiteSettingsController implements the CRUD actions for SiteSettings model.
 */
class SiteSettingsController extends AppController
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
     * Lists all SiteSettings models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = $this->findModel(1);
        /*$searchModel = new SearchSiteSettings();
        $dataProvider = $searchModel->search($this->request->queryParams);*/
        //$model = new SiteSettings();
        /*$model->id = 1;
        $model->value = [
                'name' => 'in_maintenance',
                'type' => 'checkbox',
                'value' => '1',
        ];
        $model->save();*/

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            /*echo "<pre>";
            print_r($model);
            echo "</pre>";
            die();*/
            return $this->redirect(['/']);
        } else {
            /*echo "<pre>";
            print_r($model->getErrors());
            echo "</pre>";
            die();*/
        }

        return $this->render('index', [
            'model' => $model,
            //'searchModel' => $searchModel,
            //'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SiteSettings model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    /*public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }*/

    /**
     * Creates a new SiteSettings model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    /*public function actionCreate()
    {
        $settings = $this->findModel(1);

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
            echo "<pre>";
            print_r($model);
            echo "</pre>";
            die();
                //return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }*/

    /**
     * Updates an existing SiteSettings model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    /*public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }*/

    /**
     * Deletes an existing SiteSettings model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    /*public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }*/

    /**
     * Finds the SiteSettings model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return SiteSettings the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (!empty($model = SiteSettings::findOne(['id' => $id]))) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
