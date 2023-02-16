<?php
/** @var yii\web\View $this */
use frontend\widgets\searchform\SearchFormWidget;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\widgets\ListView;
?>
<?php $this->beginBlock('banner'); ?>
<?=$this->render('/common/_banners', compact('page'))?>
<?=SearchFormWidget::widget(['index' => false])?>
<?php $this->endBlock(); ?>

<div class="hotel-index">
    <div class="body-content">
        <?Pjax::begin(['id' => 'hot-items', 'enablePushState' => true])?>
        <section class="tours tours--tiles tours--lite-bg">
            <div class="row">
                <div class="col-md-7">
                    <?if($page->title):?>
                    <h2><?=$page->title?></h2>
                    <?endif?>
                </div>
                <div class="col-md-5">
                    <?=$this->render('/site/_buttons', compact('searchModel', 'dataProvider', 'hot_sort_country', 'countryFilter'))?>
                </div>
            </div>
            <div class="row">
            <div class="col-md-0">
            </div>
            <div class="col-md-12">
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
                'pager' => [
                    'maxButtonCount' => 5,
                ],
            ]);
            ?>
            </div>
            </div>
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
                    <?=$page->content?>
                </div>
            </div>
        </section>
    </div>
</div>
<?php
/*$this->registerJs("
let c = $('#searchtours-country_id').val();
console.log(c);
$.ajax({
    url: '/tours/prices/',
    type: 'post',
    dataType: 'html',
    data: {
      country: c,
    },
    success: function(response){
        //console.log(response);
    },
});

", \yii\web\View::POS_READY);*/
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