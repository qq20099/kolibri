<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Orders $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="orders-view">

    <!--<h1><?//= Html::encode($this->title) ?></h1>-->

    <p>
        <?//= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?/*= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])*/ ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [

            'id',
            'client.name',
            'client.phone',
            'client.email',
            [
                'attribute' => 'orderItems.FlightDate',
                'format' => ['date', 'php:d.m.Y H:i'],
            ],
            [
                'attribute' => 'orderItems.HotelCheckInDate',
                'format' => ['date', 'php:d.m.Y H:i'],
            ],
            'orderItems.toCountry.Name',
            'orderItems.area.Name',
            'orderItems.area.region.Name',
            'orderItems.hotel.place.Name',
            'orderItems.seatClass.Name',
            'orderItems.meal.Name',
            'orderItems.acc.Name',
            'orderItems.hotel.Name',
            'orderItems.hotel.Address',
            'orderItems.hotel.Phone1',
            'orderItems.hotel.Web',
            'orderItems.hotel.hotelCategory.Name',
            'orderItems.room.Name',
            'orderItems.ChildAges',
            [
                'attribute' => 'orderItems.PackagePrice',
                'format' => 'currency',
            ],
            [
                'attribute' => 'orderItems.PackagePriceOld',
                'format' => 'currency',
            ],
            'orderItems.PackageNight',

            //'client_id',
            //'tour_id',
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:d.m.Y H:i:s'],
            ],
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'php:d.m.Y H:i:s'],
            ],
        ],
    ]) ?>

</div>
