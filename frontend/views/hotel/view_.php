<?php
/** @var yii\web\View $this */
use frontend\widgets\searchform\SearchFormWidget;
use kartik\rating\StarRating;

$l = ['Free toiletries',
'Safety deposit box',
'Toilet',
'Bath or shower',
'Towels',
'Linen',
'Tile/marble floor',
'TV',
'Refrigerator',
'Telephone',
'Ironing facilities',
'Satellite channels',
'Tea/Coffee maker',
'Iron',
'Interconnected room(s) available',
'Microwave',
'Heating',
'Hairdryer',
'Kitchenware',
'Kitchenette',
'DVD player',
'Wake up service/Alarm clock',
'Electric kettle',
'Outdoor furniture',
'Outdoor dining area',
'Cable channels',
'Wake-up service',
'Alarm clock',
'Wardrobe or closet',
'Stovetop',
'Clothes rack',
'Drying rack for clothing',
'Toilet paper',
'Air purifiers'
];
?>
<?php $this->beginBlock('banner'); ?>
<section class="banner">

</section>
<?=SearchFormWidget::widget(['index' => false])?>
<?php $this->endBlock(); ?>

<div class="page-content">
    <div class="row">
        <div class="col-md-12">
            <h1>Sharm Holiday Resort Aqua Park</h1>
            <?php
              echo StarRating::widget([
                  'name' => 'rating_1',
                  'pluginOptions' => [
                      'disabled' => true,
                      'showClear' => false,
                      'size' => 'sm',
                  ],
                  'value' => 4.4,
              ]);
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-12">
                    <img src="/images/_panorama-52.jpg" alt="" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 py-3">
                    <ul class="hprt-facilities-others">
                        <?foreach($l as $value):?>
                        <li>
                            <span class="hprt-facilities-facility" data-name-en="Free Toiletries">
                                <span class=" other_facility_badge--default_color">
                                    <svg class="bk-icon -streamline-checkmark" fill="#008009" height="14" width="14" viewBox="0 0 128 128" role="presentation" aria-hidden="true" focusable="false">
                                        <path d="M56.33 100a4 4 0 0 1-2.82-1.16L20.68 66.12a4 4 0 1 1 5.64-5.65l29.57 29.46 45.42-60.33a4 4 0 1 1 6.38 4.8l-48.17 64a4 4 0 0 1-2.91 1.6z"></path>
                                    </svg>
                                </span>
                                <span><?=$value?></span>
                            </span>
                        </li>
                        <?endforeach?>
<!--<li>
<span class="hprt-facilities-facility" data-name-en="Safe Deposit Box">
<span class=" other_facility_badge--default_color"><svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><polyline points="20 6 9 17 4 12"></polyline></svg>Safety deposit box</span>
</span>
</li>-->

</ul>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <p>Расположен в непосредственной близости от торгово-развлекательного комплекса Genena City и набережной Наама Бэй , что позволяет интересно и насыщенно провести свой досуг. К услугам гостей бассейны для взрослых и детей, 4 водные горки, теннисный корт, прекрасно оборудованный спа -центр, дискотека. Это делает отель популярным местом отдыха для молодежи и семей с детьми.</p>
            <div class="desc__meta">
                <div class="desc__meta-item">
                    <div>
                        <span>Year of construction:</span> <b>1998</b>
                    </div>
                </div>
                <div class="desc__meta-item">
                    <div>
                        <span>Renovation:</span> <b class="nowrap">2015</b>
                    </div>
                </div>
                <div class="desc__meta-item">
                    <div>
                        <span>Num of rooms:</span> <b class="nowrap">289</b>
                    </div>
                </div>
                <div class="desc__meta-item">
                    <div>
                        <span>Total area:</span> <b class="nowrap">38 000 кв.м</b>
                    </div>
                </div>
                <div class="desc__meta-item">
                    <div>
                        <span>Check-in:</span> <b class="nowrap">14.00</b>
                    </div>
                </div>
                <div class="desc__meta-item">
                    <div>
                        <span>Check-out:</span> <b class="nowrap">12.00</b>
                    </div>
                </div>
            </div>
            <div class="hotel-map-block">
                <?=$this->render('_map')?>
            </div>
        </div>
    </div>
</div>