<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\SearchTours $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="hot-deals-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'FlightDate') ?>

    <?= $form->field($model, 'HotelCheckInDate') ?>

    <?= $form->field($model, 'AreaID') ?>

    <?= $form->field($model, 'PlaceID') ?>

    <?php // echo $form->field($model, 'PackageNight') ?>

    <?php // echo $form->field($model, 'HotelID') ?>

    <?php // echo $form->field($model, 'HotelCategoryID') ?>

    <?php // echo $form->field($model, 'MealID') ?>

    <?php // echo $form->field($model, 'RoomID') ?>

    <?php // echo $form->field($model, 'AccID') ?>

    <?php // echo $form->field($model, 'Adult') ?>

    <?php // echo $form->field($model, 'Child') ?>

    <?php // echo $form->field($model, 'PackagePrice') ?>

    <?php // echo $form->field($model, 'FlightAllotmentStatus') ?>

    <?php // echo $form->field($model, 'BackFlightAllotmentStatus') ?>

    <?php // echo $form->field($model, 'HotelAllotmentStatus') ?>

    <?php // echo $form->field($model, 'HotelStopSaleStatus') ?>

    <?php // echo $form->field($model, 'ToCountryID') ?>

    <?php // echo $form->field($model, 'SeatClassID') ?>

    <?php // echo $form->field($model, 'SaleStatus') ?>

    <?php // echo $form->field($model, 'ChildAges') ?>

    <?php // echo $form->field($model, 'AirportRoute') ?>

    <?php // echo $form->field($model, 'PackagePriceOld') ?>

    <?php // echo $form->field($model, 'EarlyBookingEndDate') ?>

    <?php // echo $form->field($model, 'EarlyBookingText') ?>

    <?php // echo $form->field($model, 'BusinessFlightAllotmentStatus') ?>

    <?php // echo $form->field($model, 'BusinessBackFlightAllotmentStatus') ?>

    <?php // echo $form->field($model, 'HotelNight') ?>

    <?php // echo $form->field($model, 'FlightLeftAllotmentText') ?>

    <?php // echo $form->field($model, 'BackFlightLeftAllotmentText') ?>

    <?php // echo $form->field($model, 'B2BUrl') ?>

    <?php // echo $form->field($model, 'B2CUrl') ?>

    <?php // echo $form->field($model, 'PromotionStatus') ?>

    <?php // echo $form->field($model, 'main') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
