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
                <a href="<?=Url::to(['/hotel', 'SearchHotel[country_id]' => $model->toCountry->ID])?>"><?=$model->toCountry->Name?></a>, <a href="<?=Url::to(['/hotel', 'SearchHotel[area_id]' => $model->area->ID])?>"><?=$model->area->region->Name?></a>, <?=$model->place->Name?>
            </p>
            <h1><?=$model->hotel->Name?> <?=$model->hotel->category->ShortName?></h1>
            <?php
              echo StarRating::widget([
                  'name' => 'rating_1',
                  'pluginOptions' => [
                      'disabled' => true,
                      'showClear' => false,
                      'size' => 'sm',
                  ],
                  'value' => $model->hotel->tripAdvisorPoint,
              ]);
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-7 col-lg-8 mb-3">
            <div class="row">
                <div class="col-md-12">
                    <?if(!$model->hotel->images):?>
                    <img src="<?=$model->hotel->getMainImage()?>" class="card-img" alt="<?=$model->hotel->Name?>" />
                    <?else:?>

<?
$im2 = [];
$i = 0;
foreach ($model->hotel->images as $value) {
    /*if ($i % 2  == 0)
    $im[] = [$value['title'], [6.4, .87, 0, .3], ['zoomIn', 1.5, 0]];
    else
    $im2[] = [$value['title'], [6.4, .87, 0, .3], ['zoomIn', 1.5, 0]];
$i++;*/
    $im[] = Html::img('/uploads/hotel/'.$model->HotelID.'/b/'.$value['title']);
//    echo '/uploads/hotel/'.$model->HotelID.'/b/'.$value['title']."<br>";
}

/*echo \kriss\swiper\SwiperWidget::widget([
    'slides' => [
        \kriss\swiper\animate\AnimatedSwiperSlideWidget::widget([
            'imageBaseUrl' => '/uploads/hotel/'.$model->HotelID.'/b/',
            'bgUrl' => 'bg.jpg',
            'itemSizeUnit' => 'rem',
            'items' => $im,
        ]),
        \kriss\swiper\animate\AnimatedSwiperSlideWidget::widget([
            'imageBaseUrl' => '/uploads/hotel/'.$model->HotelID.'/b/',
            'bgUrl' => 'bg.jpg',
            'itemSizeUnit' => 'rem',
            'items' => $im2,
        ]),
    ],
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
]);*/

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

<!--    'slides' => [
        AnimatedSwiperSlideWidget::widget([
            'imageBaseUrl' => '@public/images/post',
            'bgUrl' => 'bg.jpg',
            'itemSizeUnit' => 'rem',
            'items' => [
                ['bonus_01.png', [6.4, .87, 0, .3], ['zoomIn', 1.5, 0]],
                ['bonus_02.jpg', [6.4, .55, 1.5, 0], ['fadeIn', 0.5, 1.5]],
                ['001.png', [6.4, 3.75, 2.8, 0], ['rotateInDownLeft', 0.5, 2]],
                ['002.png', [6.4, 3.75, 2.8, 0], ['bounceInDown', 1.5, 2.5]],
                ['003.png', [6.4, 2.25, 6.4, 0], ['fadeInUp', 0.5, 4]],
            ],
        ]),
        AnimatedSwiperSlideWidget::widget([
            'imageBaseUrl' => '@public/images/post',
            'bgUrl' => 'bg.jpg',
            'itemSizeUnit' => 'rem',
            'items' => [
                ['bonus_01.png', [6.4, .87, 0, .3], ['zoomIn', 1.5, 0]],
                ['bonus_02.jpg', [6.4, .55, 1.5, 0], ['fadeIn', 0.5, 1.5]],
                ['001.png', [6.4, 3.75, 2.8, 0], ['rotateInDownLeft', 0.5, 2]],
                ['002.png', [6.4, 3.75, 2.8, 0], ['bounceInDown', 1.5, 2.5]],
                ['003.png', [6.4, 2.25, 6.4, 0], ['fadeInUp', 0.5, 4]],
            ],
        ]),
    ],-->

                    <!--<img src="<?//=$model->hotel->getMainImage()?>" class="card-img" alt="<?//=$model->hotel->Name?>" />-->
                    <?endif?>
                </div>
            </div>
            <!--<div class="d-flex card-info-wrapper">
                <?//=$this->render('_info', compact('model'))?>
            </div>-->
            <div>

            </div>
        </div>
        <div class="col-md-5 col-lg-4 mb-3">
            <div class="sti-block">
                <?=$this->render('_sidebar_info', compact('model'))?>
                <div class="fff mt-4 mb-2">
                    <div class="ff1" data-toggle='tooltip' title="<?=Yii::$app->formatter->asDate($model->HotelCheckInDate, 'php:d M Y');?><br><?=$model->HotelNight?> NAKTIS<br><?=$model->acc->Name?><br><?=$model->meal->Name?><br><?=$model->room->Name?>">
                        <div class="price-item"><?=$model->PackagePrice?>&nbsp;€</div>
                        <div class="room-type text-uppercase" title="<?=$model->room->Name?>"><?=$model->room->Name?></div>
                    </div>
                    <div class="ff1 order-button-item">
                        <a class="tour-line__link btn btn-default" href="#modal-order" data-toggle="modal" data-id="<?=$model->id?>">Izvēlēties</a>
                    </div>
                </div>
                <?if(isset($related) && $related):?>
                <?foreach($related as $value):?>
                <div class="fff mb-2">
                    <div class="ff1" data-toggle='tooltip' title="<?=Yii::$app->formatter->asDate($value->HotelCheckInDate, 'php:d M Y');?><br><?=$value->HotelNight?> NAKTIS<br><?=$value->acc->Name?><br><?=$value->meal->Name?><br><?=$value->room->Name?>">
                        <div class="price-item"><?=$value->PackagePrice?>&nbsp;€</div>
                        <div class="room-type text-uppercase" title=""><?=$value->room->Name?></div>
                    </div>
                    <div class="ff1 order-button-item">
                        <a class="tour-line__link btn btn-default" href="#modal-order" data-toggle="modal" data-id="<?=$value->id?>">Izvēlēties</a>
                    </div>
                </div>
                <?endforeach?>
                <?endif?>
                <p><?//=$model->hotel->location?></p>
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
    <div class="row">
        <div class="col-md-7 col-lg-8">
            <div class="pt-3">
                <?//=$this->render('_attributes', compact('model'))?>
            </div>
            <div class="pt-3">
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. In mollis nunc sed id. Eget est lorem ipsum dolor sit amet consectetur. Nec feugiat in fermentum posuere urna. Dolor sit amet consectetur adipiscing. Velit aliquet sagittis id consectetur purus ut faucibus pulvinar. Ac auctor augue mauris augue neque gravida. Pellentesque massa placerat duis ultricies lacus sed turpis tincidunt id. Interdum varius sit amet mattis. Aenean sed adipiscing diam donec adipiscing tristique risus nec. Mattis rhoncus urna neque viverra justo. Dui id ornare arcu odio ut sem nulla pharetra diam. At urna condimentum mattis pellentesque id nibh tortor id. Duis ut diam quam nulla porttitor. Ac odio tempor orci dapibus ultrices. Odio morbi quis commodo odio aenean sed.</p>

<p>Duis at consectetur lorem donec. Convallis posuere morbi leo urna molestie at. Vitae justo eget magna fermentum iaculis eu non. A diam sollicitudin tempor id eu nisl nunc. Sem nulla pharetra diam sit. Tellus elementum sagittis vitae et. Eget duis at tellus at urna condimentum mattis pellentesque id. Nec feugiat nisl pretium fusce id velit. Consectetur lorem donec massa sapien faucibus et. Magna etiam tempor orci eu lobortis elementum nibh. Gravida neque convallis a cras semper auctor neque vitae tempus. Laoreet sit amet cursus sit amet. Proin sagittis nisl rhoncus mattis rhoncus urna neque. Aliquet risus feugiat in ante.</p>
            </div>
        </div>
        <div class="col-md-5 col-lg-4">
            <?if($model->hotel->Latitude > 0 && $model->hotel->Longitude > 0):?>
            <div class="hotel-map-block">
                <?=$this->render('_map', compact('model'))?>
            </div>
            <?endif?>
        </div>
    </div>
<div class="row">
    <div class="col-md-12">
        <?=$this->render('_related', ['dataProvider' => $model->getRelatedTours(true)])?>
    </div>
</div>
</div>

<?//$model->getRelatedTours()?>
<!--<pre>
    <?print_r($model)?>
</pre>-->