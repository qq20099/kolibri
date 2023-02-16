<?php
//use kv4nt\owlcarousel\OwlCarouselWidget;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use frontend\widgets\searchform\SearchFormWidget;

use evgeniyrru\yii2slick\Slick;
use yii\web\JsExpression;

use yii\widgets\ListView;

/** @var yii\web\View $this */

//$this->title = 'My Yii Application';
?>

<?php $this->beginBlock('banner'); ?>
<?=$this->render('/common/_banners', compact('page'))?>
<?=SearchFormWidget::widget(['index' => true])?>
<?php $this->endBlock(); ?>

<div class="site-index">
    <div class="body-content">
        <?Pjax::begin(['id' => 'hot-items', 'enablePushState' => false])?>
        <section class="exclusive tours tours--tiles tours--lite-bg">
            <div class="row">
                <div class="col-md-9">
                    <?if($page->title):?>
                    <h2><?=$page->title?></h2>
                    <?endif?>
                </div>
                <div class="col-md-3">
                    <?=$this->render('_buttons', compact('searchModel', 'dataProvider', 'hot_sort_country'))?>
                </div>
            </div>
            <?php
            $d = '<div class="row" id="tour-cards"> ';
            echo ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '/tours/_tour_card',
                'layout' => $d."{items}</div>\n{pager}",
                'emptyText' => 'Nekas nav atrasts',
                'itemOptions' => [
                    'class' => 'col-md-4 mb-5',
                    'data-item' => ((isset($_COOKIE['item']) && $_COOKIE['item'] == 'list') ? 'list' : 'grid'),
                ],
                'pager' => [
                    'maxButtonCount' => 5,
                ],                
            ]);
            ?>
            <?php
            if (\Yii::$app->request->isAjax) {
                $this->registerJs("
                    var bl = $('.body-content');
                    setTimeout(function(){
                      $('html, body').animate({scrollTop: bl.offset().top - 75}, 'slow', 'linear');
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
$this->registerJs("
$(document).ready(function(){
    $('body').removeClass('page');
});
");
?>