<?php

use backend\models\Pages;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var backend\models\PagesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Pages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pages-index">

    <!--<h1><?//= Html::encode($this->title) ?></h1>-->

    <p>
        <?= Html::a('Create Page', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            //'content:ntext',
            [
                'attribute' => 'activity',
                'filter' => ['Нет', 'Да'],
                'value' => function($data){
                    return ($data->activity) ? 'Да' : 'Нет';
                }
            ],
            [
                'attribute' => 'menu',
                'label' => 'В меню',
                'filter' => ['Нет', 'Да'],
                'value' => function($data){
                    return ($data->menu) ? 'Да' : 'Нет';
                }
            ],
            [
                'attribute' => 'created_at',
                'filter' => false,
                'format' => ['date', 'php:d.m.Y H:i'],
            ],
            //'updated_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Pages $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 },
                 'template' => '{update} {delete}',
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
