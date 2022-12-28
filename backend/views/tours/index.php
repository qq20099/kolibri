<?php

use backend\models\Tours;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\SearchTours $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Предложения';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="hot-deals-index">

<!--    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Hot Deals', ['create'], ['class' => 'btn btn-success']) ?>
    </p>-->
    <?php //Pjax::begin(['id' => 'my_pjax']); ?>
    <?php \yii\widgets\Pjax::begin([
        'enablePushState' => false,
        'enableReplaceState' => false,
    ]); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'options' => [
            'data-pjax' => 0,
        ],
        'pager' => [
            'linkOptions'=> [
                'data-pjax' => 0
            ]
        ],
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            /*[
                'attribute' => 'id',
            ],*/
            [
                'label' => 'Вылет',
                'attribute' => 'FlightDate',
                'format' => ['date', 'php:d.m.Y H:i'],
                /*'value' => function($model){
                    return Yii::$app->formatter->asDate($model->FlightDate, 'php:d M Y');
                }*/
            ],
            [
                'label' => 'Заезд',
                'attribute' => 'HotelCheckInDate',
                'format' => ['date', 'php:d.m.Y H:i'],
                /*'value' => function($model){
                    return Yii::$app->formatter->asDate($model->HotelCheckInDate, 'php:d M Y');
                }*/
            ],
            [
                'label' => 'Отель',
                'attribute' => 'hotel.Name',
            ],
            [
                'label' => 'Номер',
                'attribute' => 'room.Name',
            ],
            [
                'label' => 'Страна',
                'attribute' => 'toCountry.Name',
            ],
            [
                'label' => 'Район',
                'attribute' => 'area.Name',
            ],
            [
                'label' => 'Размещение',
                'attribute' => 'place.Name',
            ],
            'HotelNight',
            [
                'attribute' => 'meal.Name',
            ],
            [
                'attribute' => 'PackagePrice',
            ],

            //'HotelID',
            //'HotelCategoryID',
            //'MealID',
            //'RoomID',
            //'AccID',
            //'Adult',
            //'Child',
            //'PackagePrice',
            //'FlightAllotmentStatus',
            //'BackFlightAllotmentStatus',
            //'HotelAllotmentStatus',
            //'HotelStopSaleStatus',
            //'ToCountryID',
            //'SeatClassID',
            //'SaleStatus',
            //'ChildAges',
            //'AirportRoute',
            //'PackagePriceOld',
            //'EarlyBookingEndDate',
            //'EarlyBookingText',
            //'BusinessFlightAllotmentStatus',
            //'BusinessBackFlightAllotmentStatus',
            //'HotelNight',
            //'FlightLeftAllotmentText',
            //'BackFlightLeftAllotmentText',
            //'B2BUrl',
            //'B2CUrl',
            //'PromotionStatus',
            //'main',
            //'created_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Tours $model, $key, $index, $column) use ($dataProvider){
                    if ($action == 'view')
                      $action = '';

                      $page = $dataProvider->pagination->page;
                      $page = ($page) ? $page + 1 : '';
                    return Url::toRoute([$action, 'id' => $model->id, 'page' => $page]);
                },
                'template' => '{view}',
                'buttons' => [
                    'view' => function ($url, $model) {

                    return Html::a(
                    '<span class="glyphicon glyphicon-eye-'.(($model->main) ? 'open green' : 'close red').'" ></span>', $url, ["data-pjax" => 1, 'title' => (($model->main) ? 'Скрыть с главной' : 'Отобразить на главной')]);
                }
                ],
                /*'visibleButtons' => [
                    'view' => function ($model, $key, $index) {
                return false;

                    },
                   // 'options' => ['class' => 'ggggggggggg'],
                ],*/
                /*'buttonOptions' => function ($model, $key, $index) {
                        return ['class' => 'main-action'];
                    }
                ,*/
            ],
        ],
    ]); ?>
    <?php \yii\widgets\Pjax::end(); ?>

</div>
