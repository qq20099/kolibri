<?php
use yii\helpers\Url;
?>
<div class="tour-card__rating tour-card__exclusive-hotels"></div>
<div class="tour-card__meta">
    <div class="tour-card__meta-item" tabindex="0"></div>
</div>
<div class="catCard__info">
    <?=$this->render('_info', compact('model'))?>
    <div class="tour-line__price-link">
        <span class="tour-line__price"><?=$model->PackagePrice?>&nbsp;€</span>
        <a href="<?=Url::to(['tours/view', 'id' => $model->id])?>" class="tour--line__link">Izvēlēties</a>
        <!--<a href="#modal-order" class="tour-line__link hide" data-toggle="modal" data-id="<?=$model->id?>">Izvēlēties</a>-->
    </div>
</div>