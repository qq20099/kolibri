<?php
/** @var yii\web\View $this */
use frontend\widgets\searchform\SearchFormWidget;
use frontend\widgets\filtersform\FiltersFormWidget;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\widgets\ListView;
?>
<?php $this->beginBlock('banner'); ?>
<section class="banner">

</section>
<?=SearchFormWidget::widget(['index' => false])?>
<?php $this->endBlock(); ?>

<div class="hotel-index">
    <div class="body-content">
        <?Pjax::begin(['id' => 'hot-items', 'enablePushState' => true])?>
        <section class="tours tours--tiles tours--lite-bg">
            <div class="row">
                <div class="col-md-8">
                    <h2><?=Yii::t('app', 'Hotels')?></h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <a href="javascript:;" id="show-filters-tab"><?=Yii::t('app', 'Filters')?></a>
                </div>
                <div class="col-md-4">
                    <?=$this->render('/site/_buttons', compact('searchModel', 'dataProvider', 'hot_sort_country'))?>
                </div>
            </div>
            <div class="filters-tab" id="filters-tab">
                <?=FiltersFormWidget::widget()?>
            </div>
            <?php
            $d = '<div class="row" id="tour-cards"> ';
            echo ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '/tours/_tour_card',
                'layout' => $d."{items}</div>\n{pager}",
                'itemOptions' => [
                    'class' => 'col-md-4 mb-5',
                    'data-item' => ((isset($_COOKIE['item']) && $_COOKIE['item'] == 'list') ? 'list' : 'grid'),
                ],
            ]);
            ?>
            <?php
            if (\Yii::$app->request->isAjax) {
                $this->registerJs("
                  var bl = $('.body-content');
                  setTimeout(function(){
                    $('html, body').animate({scrollTop: bl.offset().top}, 'slow', 'linear');
                  }, 200);");
            }
            ?>
        </section>
        <?Pjax::end()?>
        <section class="about mt-5">
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
let c = $('#searchtours-country_id').val();
console.log(c);
$.ajax({
    url: '/tours/get-prices/',
    type: 'post',
    dataType: 'html',
    data: {
      country: c,
    },
    success: function(response){
        //console.log(response);
    },
});

", \yii\web\View::POS_READY);
/*$this->registerCss("
.ui-datepicker.ui-cb-datepicker td.ui-state-price-available a.datepicker-content-862::after {
    content: "862€";
}

.ui-datepicker.ui-cb-datepicker td.ui-state-price-available a::after {
    content: "";
    display: block;
    text-align: center;
}
");*/
?>