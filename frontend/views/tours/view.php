<?php
/** @var yii\web\View $this */
use frontend\widgets\searchform\SearchFormWidget;
use kartik\rating\StarRating;
use yii\helpers\Url;
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
            <h1><?=$model->hotel->Name?> (<?=$model->hotelCategory->ShortName?>)</h1>
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
        <div class="col-md-8 mb-3">
            <div class="row">
                <div class="col-md-12">
                    <img src="<?=$model->hotel->getMainImage()?>" class="card-img" alt="<?=$model->hotel->Name?>" />
                </div>
            </div>
            <div class="d-flex card-info-wrapper">
                <?=$this->render('_info', compact('model'))?>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="sti-block">
            <div class="fff mb-2">
                <div class="ff1 price-item"><?=$model->PackagePrice?>&nbsp;€</div>
                <div class="ff1 order-button-item">
                    <a href="#" class="tour-line__link btn btn-default" target="_self">Izvēlēties</a>
                </div>
            </div>
            <p><?//=$model->hotel->location?></p>
            <div class="desc__meta">
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
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="pt-3">
                <?//=$this->render('_attributes', compact('model'))?>
            </div>
            <div class="pt-3">
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. In mollis nunc sed id. Eget est lorem ipsum dolor sit amet consectetur. Nec feugiat in fermentum posuere urna. Dolor sit amet consectetur adipiscing. Velit aliquet sagittis id consectetur purus ut faucibus pulvinar. Ac auctor augue mauris augue neque gravida. Pellentesque massa placerat duis ultricies lacus sed turpis tincidunt id. Interdum varius sit amet mattis. Aenean sed adipiscing diam donec adipiscing tristique risus nec. Mattis rhoncus urna neque viverra justo. Dui id ornare arcu odio ut sem nulla pharetra diam. At urna condimentum mattis pellentesque id nibh tortor id. Duis ut diam quam nulla porttitor. Ac odio tempor orci dapibus ultrices. Odio morbi quis commodo odio aenean sed.</p>

<p>Duis at consectetur lorem donec. Convallis posuere morbi leo urna molestie at. Vitae justo eget magna fermentum iaculis eu non. A diam sollicitudin tempor id eu nisl nunc. Sem nulla pharetra diam sit. Tellus elementum sagittis vitae et. Eget duis at tellus at urna condimentum mattis pellentesque id. Nec feugiat nisl pretium fusce id velit. Consectetur lorem donec massa sapien faucibus et. Magna etiam tempor orci eu lobortis elementum nibh. Gravida neque convallis a cras semper auctor neque vitae tempus. Laoreet sit amet cursus sit amet. Proin sagittis nisl rhoncus mattis rhoncus urna neque. Aliquet risus feugiat in ante.</p>
            </div>
        </div>
        <div class="col-md-4">
            <?if($model->hotel->Latitude > 0 && $model->hotel->Longitude > 0):?>
            <div class="hotel-map-block">
                <?=$this->render('_map', compact('model'))?>
            </div>
            <?endif?>
        </div>
    </div>
</div>
<pre>
    <?print_r($model)?>
</pre>