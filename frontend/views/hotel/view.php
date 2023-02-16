<?php
/** @var yii\web\View $this */
use frontend\widgets\searchform\SearchFormWidget;
use kartik\rating\StarRating;
use yii\helpers\Url;
use yii\helpers\Html;
?>
<?php $this->beginBlock('banner'); ?>
<section class="banner"></section>
<?=SearchFormWidget::widget(['index' => false])?>
<?php $this->endBlock(); ?>

<div class="page-content">
    <div class="row">
        <div class="col-md-12">
            <p class="card-coutry-title">
                <a href="<?=Url::to(['/hotel', 'SearchHotel[country_id]' => $model->place->area->region->country->ID])?>"><?=$model->place->area->region->country->Name?></a>, <a href="<?=Url::to(['/hotel', 'SearchHotel[area_id]' => $model->place->area->ID])?>"><?=$model->place->area->region->Name?></a>, <?=$model->place->Name?>
            </p>
            <h1><?=$model->Name?> <?=$model->category->ShortName?></h1>
            <?php
              echo StarRating::widget([
                  'name' => 'rating_1',
                  'pluginOptions' => [
                      'disabled' => true,
                      'showClear' => false,
                      'size' => 'sm',
                  ],
                  'value' => $model->tripAdvisorPoint,
              ]);
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-7 col-lg-8 mb-3">
            <div class="row">
                <div class="col-md-12">
                    <?if(!$model->images):?>
                    <img src="<?=$model->getMainImage()?>" class="card-img" alt="<?=$model->Name?>" />
                    <?else:?>

<?
$im2 = [];
$i = 0;
foreach ($model->images as $value) {
    $im[] = Html::img('/uploads/hotel/'.$model->ID.'/b/'.$value['title']);
}

echo \kriss\swiper\SwiperWidget::widget([
    'slides' => $im,
    'pagination' => false,
    'navigation' => true,
    'scrollbar' => false,
    'clientOptions' => [
        'speed' => 200,
        'loop' => true,
        'on' => [
            'click' => new \yii\web\JsExpression('function() {}'),
        ],
    ]
]);?>

                    <?endif?>
                </div>
            </div>
            <div>

            </div>
        </div>
        <div class="col-md-5 col-lg-4 mb-3">
            <div class="sti-block">
                <?=$this->render('_sidebar_info', compact('model', 'related'))?>

                <div class="fff first-fff mt-4 mb-2">
                    <div class="ff1">
                        <div class="price-item" data-toggle='tooltip' title="<?=Yii::$app->formatter->asDate($related[0]->FlightDate, 'php:d M Y');?><br><?=$related[0]->HotelNight?> NAKTIS<br><?=$related[0]->acc->Name?><br><?=$related[0]->meal->Name?><br><?=$related[0]->room->Name?><br><?=$related[0]->meal->Name?>"><?=$related[0]->PackagePrice?>&nbsp;€</div>
                        <div class="room-type text-uppercase" title="<?=$related[0]->room->Name?>"><?=$related[0]->room->Name?></div>
                    </div>
                    <div class="ff1 order-button-item">
                        <a class="tour-line__link btn btn-default" href="#modal-order" data-toggle="modal" data-id="<?=$related[0]->id?>">Izvēlēties</a>
                    </div>
                </div>
                <div class="offer-block<?if($related && count($related) > 4):?> ov<?endif?>">
<!--<pre>
                    <?//print_r($related[0]->id)?>     <br>
                    <?//print_r($related[0]->room->Name)?>
                </pre>-->
                <?if(isset($related) && $related && count($related) > 1):?>
                <?foreach($related as $key => $value):?>
                <?php
                  if ($key == 0)
                    continue;
                ?>

                <div class="fff<?if($key < count($related)-1):?> mb-2<?endif?>">
                    <div class="ff1">
                        <div class="price-item" data-toggle='tooltip' title="<?=Yii::$app->formatter->asDate($value->FlightDate, 'php:d M Y');?><br><?=$value->HotelNight?> NAKTIS<br><?=$value->acc->Name?><br><?=$value->meal->Name?><br><?=$value->room->Name?><br><?=$value->meal->Name?>"><?=$value->PackagePrice?>&nbsp;€</div>
                        <div class="room-type text-uppercase" title=""><?=$value->room->Name?></div>
                    </div>
                    <div class="ff1 order-button-item">
                        <a class="tour-line__link btn btn-default" href="#modal-order" data-toggle="modal" data-id="<?=$value->id?>">Izvēlēties</a>
                    </div>
                </div>
                <?endforeach?>
                <?endif?>

            <div class="desc__meta" hidden>
                <div class="desc__meta-item">
                    <div>
                        <span><?=Yii::t('app', 'Year of construction')?>:</span>
                        <b><?//=$model->hotel->year_construction?></b>
                    </div>
                </div>
                <div class="desc__meta-item">
                    <div>
                        <span><?=Yii::t('app', 'Renovation')?>:</span>
                        <b class="nowrap"><?//=$model->hotel->year_renovation?></b>
                    </div>
                </div>
                <div class="desc__meta-item">
                    <div>
                        <span><?=Yii::t('app', 'Num of rooms')?>:</span>
                        <b class="nowrap"><?//=$model->hotel->number_rooms?></b>
                    </div>
                </div>
                <div class="desc__meta-item">
                    <div>
                        <span><?=Yii::t('app', 'Total area {km}', ['km' => '(km<sup>2</sup>)'])?>:</span>
                        <b class="nowrap"><?//=$model->hotel->total_area?></b>
                    </div>
                </div>
                <div class="desc__meta-item">
                    <div>
                        <span><?=Yii::t('app', 'Check-in')?>:</span>
                        <b class="nowrap"><?//=number_format($model->hotel->check_in, 2, '.', '')?></b>
                    </div>
                </div>
                <div class="desc__meta-item">
                    <div>
                        <span><?=Yii::t('app', 'Check-out')?>':</span>
                        <b class="nowrap"><?//=number_format($model->hotel->check_out, 2, '.', '')?></b>
                    </div>
                </div>
            </div>
            </div>
            </div>

<?  /*
echo \yii\bootstrap4\Accordion::widget([
    'items' => [
        // equivalent to the above
        [
            'label' => 'Collapsible Group Item #1',
            'content' => 'Anim pariatur cliche...',
            'clientOptions' => ['collapsible' => true, 'active' => false],
            // open its content by default
            //'contentOptions' => [/*'class' => 'in'* /]
        ],
        // another group item
        [
            'label' => 'Collapsible Group Item #1',
            'content' => 'Anim pariatur cliche...',
            //'contentOptions' => [],
            //'options' => [],
            //'expand' => true,
        ],
        // if you want to swap out .card-block with .list-group, you may use the following
        [
            'label' => 'Collapsible Group Item #1',
            'content' => [
                'Anim pariatur cliche...',
                'Anim pariatur cliche...'
            ],
            //'contentOptions' => [],
            //'options' => [],
            //'footer' => 'Footer' // the footer label in list-group
        ],
    ]
]);*/
?>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-7 col-lg-8">
            <div class="pt-3">
                <?//=$this->render('_attributes', compact('model'))?>
            </div>
            <div class="pt-3"><?=$model->description?></div>
        </div>
        <div class="col-md-5 col-lg-4">
            <?if($model->Latitude > 0 && $model->Longitude > 0):?>
            <div class="hotel-map-block">
                <?=$this->render('_map', compact('model'))?>
            </div>
            <?endif?>
        </div>
    </div>
<div class="row">
    <div class="col-md-12">
        <?//=$this->render('_related', ['dataProvider' => $model->getRelatedTours(true)])?>
    </div>
</div>
</div>

<?//$model->getRelatedTours()?>
<!--<pre>
    <?print_r($model)?>
</pre>-->