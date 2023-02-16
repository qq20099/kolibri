<?php
/** @var yii\web\View $this */
use kartik\rating\StarRating;
use yii\helpers\Url;

$raitin = $model->hotel->tripAdvisorPoint;
?>

<article class="u-gallery-inner u-gallery-inner-1 tour-card">
    <div class="tour-card__price"><?=$model->PackagePrice?>&nbsp;€</div>
    <div style="background-image: url('<?=$model->hotel->getMainImage()?>')" class="u-effect-fade u-gallery-item tour-card__img">
        <div class="tour-card__actions" hidden>
            <div class="tour-card__action">
                <button type="button" class="tour-action-btn tour-action-btn--orange"></button>
            </div>
        </div>
        <div class="tour-card__content">
            <p class="tour-card__country-city">
                <?php
                  $url = 'hotel/'.$model->hotel->ID.'?'.Yii::$app->request->queryString;
                  if (!Yii::$app->request->queryString)
                    $url = 'hotel/'.$model->hotel->ID;
                  $url = Url::to([$url]);
                ?>
                <a href="<?=$url?>" class="tour-card__link"><?=$model->toCountry->Name?>, <?=$model->area->Name?></a>
            </p>
            <h4 class="tour-card__hotel">
                <a href="<?=$url?>" class="tour-card__link"><?=$model->hotel->Name?> <?=$model->hotel->category->ShortName?></a>
            </h4>
        </div>
        <div class="u-over-slide u-shading-n" style="background-image: url('<?=$model->hotel->getMainImage('b', 1)?>')"></div>
        <div class="u-over-slide u-shading u-over-slide-1">
            <h3 class="u-gallery-heading"><?=$model->hotel->Name?> <?=$model->hotel->category->ShortName?></h3>
            <p class="u-gallery-text"><?=$model->toCountry->Name?>, <?=$model->area->Name?></p>
            <p class="mt-3">
                <a class="btn btn-default tour-line__link hide" href="#modal-order" data-toggle="modal" data-id="<?=$model->id?>">Izvēlēties</a>
            </p>
            <?=$this->render('_info', compact('model'))?>
        </div>
    </div>
    <div class="card-info">
        <div class="tour-card__content">
            <p class="tour-card__country-city">
                <a href="#" class="tour-card__link"><?=$model->toCountry->Name?>, <?=$model->area->Name?></a>
            </p>
            <h4 class="tour-card__hotel">
                <a href="<?=$url?>" class="tour-card__link"><?=$model->hotel->Name?></a>
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
        <div class="description"><?//=$model->FlightDateSource?><?//=$model->hotel->parser->description?></div>
        <div class="details">
            <?=$this->render('_details', compact('model'))?>
        </div>
    </div>
</article>