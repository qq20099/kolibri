<?php
/** @var yii\web\View $this */
use frontend\widgets\searchform\SearchFormWidget;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
?>
<?php $this->beginBlock('banner'); ?>
<section class="banner">

</section>
<?=SearchFormWidget::widget(['index' => false])?>
<?php $this->endBlock(); ?>

<div class="hotel-index">
    <div class="body-content">
        <?Pjax::begin(['id' => 'hot-items', 'enablePushState' => false])?>
        <section class="tours tours--tiles tours--lite-bg">
                <div class="row">
                    <div class="col-md-8">
                        <h2><?=Yii::t('app', 'Hotels')?></h2>
                    </div>
                    <div class="col-md-4">
                        <?=$this->render('/site/_buttons', compact('searchModel', 'dataProvider', 'hot_sort_country'))?>
                    </div>
                </div>
                <div class="row" id="tour-cards">
                    <?foreach($dataProvider->getModels() as $model):?>
                    <div class="col-md-4 mb-5" data-item="<?if(isset($_COOKIE['item']) && $_COOKIE['item'] == 'list'):?>list<?else:?>grid<?endif?>">
                        <?=$this->render('_tour_card', compact('model'))?>
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