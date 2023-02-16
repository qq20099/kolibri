<?php

use backend\models\Banners;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\SearchBanners $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Banners';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banners-index">

    <p>
        <?= Html::a('Add Banner', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'id',
                'filter' => false,
            ],
            [
                'attribute' => 'img',
                'format' => 'raw',
                'filter' => false,
                'value' => function($data) {
                    return Html::img('/uploads/banners/'.$data->page_id.'/'.$data->img, ['class' => 'banner-tmb']);
                }
            ],
            [
                'label' => 'Страница',
                'attribute' => 'page',
                'value' => function($data) {
                    return $data->page->title;
                }
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Banners $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 },
                 'template' => '{update} {delete}',
            ],
        ],
    ]); ?>


</div>
