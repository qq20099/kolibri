<?php
use kv4nt\owlcarousel\OwlCarouselWidget;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use frontend\widgets\searchform\SearchFormWidget;

use evgeniyrru\yii2slick\Slick;
use yii\web\JsExpression;

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>

<?php $this->beginBlock('banner'); ?>
<section class="banners">
<?php  /*
OwlCarouselWidget::begin([
    'container' => 'div',
    'containerOptions' => [
        'id' => 'container-id',
        'class' => 'container-class'
    ],
    'pluginOptions'    => [
        'autoplay'          => true,
        'autoplayTimeout'   => 3000,
        'navSpeed'   => 800,
        'items'             => 1,
        'loop'              => true,
        //'itemsDesktop'      => [1199, 3],
        //'itemsDesktopSmall' => [979, 3],
        'center' => true,
        'margin' => 10,
        'autoplayHoverPause' => true,
        'stagePadding' => 350,
        'dots' => true,
        'nav' => false,
        'navText' => [
          '<svg width="35" height="35" fill="#aaa" viewBox="0 0 24 24"><path d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z"/></svg>',
          '<svg width="35" height="35" fill="#aaa" viewBox="0 0 24 24"><path d="M5 3l3.057-3 11.943 12-11.943 12-3.057-3 9-9z"/></svg>'
        ],
        'responsive' => [
            0 => [
                'items' => 1,
            ],
            '300' => [
                'items' => 1,
                'stagePadding' => 0,
            ],
            '700' => [
                'items' => 1,
                'stagePadding' => 350,
            ],
            '1000' => [
                'items' => 1,
                'stagePadding' => 350,
            ],
        ],
    ]
]);    */
?>
<?php /*
<div class="banner-item">
    <?=Html::img('/uploads/desk.d9a2e2e.jpg', ['class' => ''])?>
</div>
<div class="banner-item">
    <?=Html::img('/uploads/desk.deddfbf.jpg', ['class' => ''])?>
</div>
<div class="banner-item">
    <?=Html::img('/uploads/desk.629d7b9.jpg', ['class' => ''])?>
</div>
<div class="banner-item">
    <?=Html::img('/uploads/desk.aaa7705.jpg', ['class' => ''])?>
</div>
*/
?>
<?php //OwlCarouselWidget::end(); ?>

<?=Slick::widget([

        // HTML tag for container. Div is default.
        'itemContainer' => 'div',

        // HTML attributes for widget container
        'containerOptions' => ['class' => 'container1'],

        // Position for inclusion js-code
        // see more here: http://www.yiiframework.com/doc-2.0/yii-web-view.html#registerJs()-detail
        //'jsPosition' => yii\web\View::POS_READY,

        // Items for carousel. Empty array not allowed, exception will be throw, if empty
        'items' => [
            Html::img('/uploads/desk.d9a2e2e.jpg'),
            Html::img('/uploads/desk.deddfbf.jpg'),
            Html::img('/uploads/desk.629d7b9.jpg'),
            Html::img('/uploads/desk.aaa7705.jpg'),
        ],

        // HTML attribute for every carousel item
        'itemOptions' => ['class' => 'cat-image'],

        // settings for js plugin
        // @see http://kenwheeler.github.io/slick/#settings
        'clientOptions' => [
            'autoplay' => true,
            'dots'     => true,
            'infinite' => true,
            'speed' => 500,
            'slidesToShow' => 1,
            'centerMode' => true,
            'centerPadding' => '270px',
            'responsive' => [
                [
                    'breakpoint' => 768,
                    'settings' => [
                        'infinite' => true,
                        'slidesToShow' => 1,
                        'slidesToScroll' => 1,
                        'centerMode' => false,
                        //'centerPadding' => '100px',
                    ]
                ],
                [
                    'breakpoint' => 961,
                    'settings' => [
                        'infinite' => false,
                        'slidesToShow' => 1,
                        'slidesToScroll' => 1,
                        'centerMode' => true,
                        'centerPadding' => '100px',
                    ]
                ],
            ]
            //'fade' => true,
            //'variableWidth' => true,
            // note, that for params passing function you should use JsExpression object
            // but pay atention, In slick 1.4, callback methods have been deprecated and replaced with events.
            //'onAfterChange' => new JsExpression('function() {console.log("The cat has shown")}'),
        ],

    ]); ?>

</section>
<?=SearchFormWidget::widget(['index' => true])?>
<?php $this->endBlock(); ?>

<div class="site-index">
    <div class="body-content">
        <?Pjax::begin(['id' => 'hot-items', 'enablePushState' => false])?>
        <section class="exclusive tours tours--tiles tours--lite-bg">
                <div class="row">
                    <div class="col-md-8">
                        <h2>Эксклюзивные отели</h2>
                    </div>
                    <div class="col-md-4">
                        <?=$this->render('_buttons', compact('searchModel', 'dataProvider', 'hot_sort_country'))?>
                    </div>
                </div>

                <div class="row" id="tour-cards">
                    <?foreach($dataProvider->getModels() as $model):?>
                    <div class="col-md-4 mb-5" data-item="<?if(isset($_COOKIE['item']) && $_COOKIE['item'] == 'list'):?>list<?else:?>grid<?endif?>">
                        <?=$this->render('/hotel/_tour_card', compact('model'))?>
                    </div>
                    <?endforeach?>
                </div>
        </section>
        <?Pjax::end()?>
        <section class="about">
        <div class="row">
            <div class="col-md-12">
                <p>Lorem ipsum dolor sit amet. Et quis aperiamAut quibusdam vel galisum adipisci eum blanditiis dignissimos qui temporibus facere non voluptas dolore sed accusantium harum. Est voluptatem repellendus ut quaerat nobis <strong>At quisquam aut doloremque odit ex dolore tempore</strong>. Ea provident dolorem <em>Aut voluptas qui asperiores beatae qui repellendus enim</em> aut modi fuga. At consequatur mollitia qui nihil enimid accusantium ea maiores natus.</p>
                <p>Est voluptatibus repudiandaeet atque et ratione veniam. Et sapiente perspiciatis in dolorem quiaSed enim qui reiciendis voluptatem est galisum culpa est impedit enim qui autem illo. Ut corrupti maiores non dolorem facilis <em>Ut sint sit ipsa minima ut harum aperiam non perferendis dolores</em>.</p>
            </div>
    </div>
</section>
    </div>
</div>
<?php
$this->registerJs("
$(document).ready(function(){
    $('body').removeClass('page');
});
");
?>