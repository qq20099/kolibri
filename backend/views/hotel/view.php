<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\CoraltravelHotel $model */

$this->title = $model->Name;
$this->params['breadcrumbs'][] = ['label' => 'Coraltravel Hotels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="coraltravel-hotel-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'ID' => $model->ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'ID' => $model->ID], [
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
            'ID',
            'Name',
            'Place',
            'HotelCategory',
            'Address',
            'Web',
            'Latitude',
            'Longitude',
            'TripAdvisorCode',
            'GiataCode',
            'Phone1',
            'Phone2',
            'Fax1',
            'Fax2',
            'OperatorSaleCategory',
            'CommercialName',
            'TaxOffice',
            'TaxNumber',
            'invoiceAddress',
            'email:email',
            'tripAdvisorPoint',
            'tripAdvisorImage',
            'tripAdvisorCommentCount',
            'cancelStatusWeb',
            'disableOnB2C',
            'dontShowTripAdvisorComments',
            'CountryID',
        ],
    ]) ?>

</div>
