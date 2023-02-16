<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\SearchHotel $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="coraltravel-hotel-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'Name') ?>

    <?= $form->field($model, 'Place') ?>

    <?= $form->field($model, 'HotelCategory') ?>

    <?= $form->field($model, 'Address') ?>

    <?php // echo $form->field($model, 'Web') ?>

    <?php // echo $form->field($model, 'Latitude') ?>

    <?php // echo $form->field($model, 'Longitude') ?>

    <?php // echo $form->field($model, 'TripAdvisorCode') ?>

    <?php // echo $form->field($model, 'GiataCode') ?>

    <?php // echo $form->field($model, 'Phone1') ?>

    <?php // echo $form->field($model, 'Phone2') ?>

    <?php // echo $form->field($model, 'Fax1') ?>

    <?php // echo $form->field($model, 'Fax2') ?>

    <?php // echo $form->field($model, 'OperatorSaleCategory') ?>

    <?php // echo $form->field($model, 'CommercialName') ?>

    <?php // echo $form->field($model, 'TaxOffice') ?>

    <?php // echo $form->field($model, 'TaxNumber') ?>

    <?php // echo $form->field($model, 'invoiceAddress') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'tripAdvisorPoint') ?>

    <?php // echo $form->field($model, 'tripAdvisorImage') ?>

    <?php // echo $form->field($model, 'tripAdvisorCommentCount') ?>

    <?php // echo $form->field($model, 'cancelStatusWeb') ?>

    <?php // echo $form->field($model, 'disableOnB2C') ?>

    <?php // echo $form->field($model, 'dontShowTripAdvisorComments') ?>

    <?php // echo $form->field($model, 'CountryID') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
