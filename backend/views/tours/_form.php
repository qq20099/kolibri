<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Tours $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="hot-deals-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'FlightDate')->textInput() ?>

    <?= $form->field($model, 'HotelCheckInDate')->textInput() ?>

    <?= $form->field($model, 'AreaID')->textInput() ?>

    <?= $form->field($model, 'PlaceID')->textInput() ?>

    <?= $form->field($model, 'PackageNight')->textInput() ?>

    <?= $form->field($model, 'HotelID')->textInput() ?>

    <?= $form->field($model, 'HotelCategoryID')->textInput() ?>

    <?= $form->field($model, 'MealID')->textInput() ?>

    <?= $form->field($model, 'RoomID')->textInput() ?>

    <?= $form->field($model, 'AccID')->textInput() ?>

    <?= $form->field($model, 'Adult')->textInput() ?>

    <?= $form->field($model, 'Child')->textInput() ?>

    <?= $form->field($model, 'PackagePrice')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'FlightAllotmentStatus')->textInput() ?>

    <?= $form->field($model, 'BackFlightAllotmentStatus')->textInput() ?>

    <?= $form->field($model, 'HotelAllotmentStatus')->textInput() ?>

    <?= $form->field($model, 'HotelStopSaleStatus')->textInput() ?>

    <?= $form->field($model, 'ToCountryID')->textInput() ?>

    <?= $form->field($model, 'SeatClassID')->textInput() ?>

    <?= $form->field($model, 'SaleStatus')->textInput() ?>

    <?= $form->field($model, 'ChildAges')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'AirportRoute')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PackagePriceOld')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'EarlyBookingEndDate')->textInput() ?>

    <?= $form->field($model, 'EarlyBookingText')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BusinessFlightAllotmentStatus')->textInput() ?>

    <?= $form->field($model, 'BusinessBackFlightAllotmentStatus')->textInput() ?>

    <?= $form->field($model, 'HotelNight')->textInput() ?>

    <?= $form->field($model, 'FlightLeftAllotmentText')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BackFlightLeftAllotmentText')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'B2BUrl')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'B2CUrl')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'PromotionStatus')->textInput() ?>

    <?= $form->field($model, 'main')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
