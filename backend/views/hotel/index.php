<?php

use backend\models\CoraltravelHotel;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var backend\models\SearchHotel $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Coraltravel Hotels';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="coraltravel-hotel-index">

    <!--<h1><?//= Html::encode($this->title) ?></h1>-->

    <!--<p>
        <?//= Html::a('Create Coraltravel Hotel', ['create'], ['class' => 'btn btn-success']) ?>
    </p>-->

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'ID',
            /*[
                'label' => '',
                'format' => 'raw',
                'value' => function($data){
                    $path = str_replace('{ID}', $data->ID, $data->path_img_t);
                    return Html::img(((!$data->mainImg->title) ? '/admin/images/no-image-6.jpg': $path.$data->mainImg->title), ['width' => 48]);
                },
            ],*/
            [
                'label' => 'Страна',
                'attribute' => 'country',
                'filter' => \yii\helpers\ArrayHelper::map(\yii\helpers\ArrayHelper::getColumn(\common\helpers\DataHelper::getHotelsCountry(), 'place.area.region.country'), 'ID', 'Name'),
                'value' => function($data){
                    return \yii\helpers\ArrayHelper::getValue($data, 'place.area.region.country.Name');
                },
            ],
            [
                'attribute' => 'Name',
                'format' => 'raw',
                'value' => function($data){
                    $path = str_replace('{ID}', $data->ID, $data->path_img_t);
                    return Html::img(((!isset($data->mainImg->title)) ? '/admin/images/no-image-6.jpg': $path.$data->mainImg->title), ['width' => 48]).'<div class="hotel-name">'.$data->Name.'</div>';
                }
            ],
            [
                'label' => 'Категория',
                'attribute' => 'category',
                //'filter' => \common\helpers\DataHelper::getHotelsCategory(),
                'filter' => \yii\helpers\ArrayHelper::map(\yii\helpers\ArrayHelper::getColumn(\common\helpers\DataHelper::getHotelsCategory(), 'hotelCategory'), 'ID', 'ShortName'),
                'value' => function($data){
                    return $data->hotelCategory->ShortName;
                },
            ],
            //'Address',
            //'Web',
            //'Latitude',
            //'Longitude',
            //'TripAdvisorCode',
            //'GiataCode',
            //'Phone1',
            //'Phone2',
            //'Fax1',
            //'Fax2',
            //'OperatorSaleCategory',
            //'CommercialName',
            //'TaxOffice',
            //'TaxNumber',
            //'invoiceAddress',
            //'email:email',
            //'tripAdvisorPoint',
            //'tripAdvisorImage',
            //'tripAdvisorCommentCount',
            //'cancelStatusWeb',
            //'disableOnB2C',
            //'dontShowTripAdvisorComments',
            //'CountryID',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, CoraltravelHotel $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'ID' => $model->ID]);
                 },
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
