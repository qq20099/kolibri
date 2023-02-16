<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
?>

    <?php \yii\widgets\Pjax::begin([
        'enablePushState' => false,
        'enableReplaceState' => false,
    ]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'layout' => '{items}',
        'options' => [
            'data-pjax' => 1,
        ],
        //'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute' => 'FlightDate',
                'format' => ['date', 'php:d.m.Y'],
            ],
            'room.Name',
            'meal.Name',
            'Adult',
            'Child',
            [
                'attribute' => 'PackagePrice',
                'format' => 'currency',
            ],
            /*'client.phone',
            'orderItems.toCountry.Name',
            'orderItems.area.Name',
            'orderItems.hotel.Name',
            'orderItems.acc.Name',
            'orderItems.PackagePrice',*/

            //orderItemsChild',
            /*[
                'attribute' => 'created_at',
                'format' => ['date', 'php:d.m.Y H:i:s'],
            ],
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'php:d.m.Y H:i:s'],
            ],*/
            /*[
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Orders $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 },
                'template' => '{view}',
            ],*/
        ],
    ]); ?>
    <?php \yii\widgets\Pjax::end(); ?>      