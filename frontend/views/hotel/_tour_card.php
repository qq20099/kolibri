<?php
/** @var yii\web\View $this */
use kartik\rating\StarRating;
use yii\helpers\Url;

$raitin = $model->hotel->raiting();
?>
<article class="u-gallery-inner u-gallery-inner-1 tour-card">
    <div class="tour-card__price"><?=$model->price?>&nbsp;€</div>
    <div style="background-image: url('<?=$model->hotel->getMainImage()?>')" class="u-effect-fade u-gallery-item tour-card__img">
        <div class="tour-card__actions" hidden>
            <div class="tour-card__action">
                <button type="button" class="tour-action-btn tour-action-btn--orange"></button>
            </div>
        </div>
        <div class="tour-card__content">
            <p class="tour-card__country-city">
                <a href="<?=Url::to(['hotel/view', 'id' => $model->id])?>" class="tour-card__link"><?=$model->hotel->location0->country->title?>, <?=$model->hotel->location0->title?></a>
            </p>
            <h4 class="tour-card__hotel">
                <a href="<?=Url::to(['hotel/view', 'id' => $model->id])?>" class="tour-card__link"><?=$model->hotel->title?></a>
            </h4>
        </div>
        <div class="u-over-slide u-shading u-over-slide-1">
            <h3 class="u-gallery-heading"><?=$model->hotel->title?></h3>
            <p class="u-gallery-text"><?=$model->hotel->location0->country->title?>, <?=$model->hotel->location0->title?></p>
            <p class="mt-3">
                <a href="#" class="btn btn-default tour-line__link" target="_self">Izvēlēties</a>
            </p>
        </div>
    </div>
    <div class="card-info">
        <div class="tour-card__content">
            <p class="tour-card__country-city">
                <a href="<?=Url::to(['hotel/view', 'id' => $model->id])?>" class="tour-card__link"><?=$model->hotel->location0->country->title?>, <?=$model->hotel->location0->title?></a>
            </p>
            <h4 class="tour-card__hotel">
                <a href="<?=Url::to(['hotel/view', 'id' => $model->id])?>" class="tour-card__link"><?=$model->hotel->title?></a>
            </h4>
            <div class="row">
                <div class="col-md-12">
                    <?php
                      echo StarRating::widget([
                          'name' => 'rating_1',
                          'pluginOptions' => [
                              'disabled' => true,
                              'showClear' => false,
                              'size' => 'xs',
                          ],
                          'value' => ($raitin) ? $raitin : 0,
                      ]);
                    ?>
                </div>
            </div>
        </div>
        <div class="description"><?=$model->hotel->description?></div>
        <div class="details">
            <?=$this->render('_details', compact('model'))?>
        </div>
    </div>
</article>