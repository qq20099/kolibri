<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Tours $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Hot Deals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="hot-deals-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'FlightDate',
            'HotelCheckInDate',
            'AreaID',
            'PlaceID',
            'HotelNight',
            'HotelID',
            'HotelCategoryID',
            'MealID',
            'RoomID',
            'AccID',
            'Adult',
            'Child',
            'PackagePrice',
            'FlightAllotmentStatus',
            'BackFlightAllotmentStatus',
            'HotelAllotmentStatus',
            'HotelStopSaleStatus',
            'ToCountryID',
            'SeatClassID',
            'SaleStatus',
            'ChildAges',
            'AirportRoute',
            'PackagePriceOld',
            'EarlyBookingEndDate',
            'EarlyBookingText',
            'BusinessFlightAllotmentStatus',
            'BusinessBackFlightAllotmentStatus',
            'HotelNight',
            'FlightLeftAllotmentText',
            'BackFlightLeftAllotmentText',
            'B2BUrl',
            'B2CUrl',
            'PromotionStatus',
            'main',
            'created_at',
        ],
    ]) ?>

</div>
