<?php
//use bs\Flatpickr\FlatpickrWidget;
//use bs\Flatpickr\FlatpickrWidget as Flatpickr;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;
?>
<?php
$this->registerCss("
.multiselect-native-select select {
    display: none;
}");
?>
<div class="index-page__filters-form<?=$class?>">
      <?php $form = ActiveForm::begin([
        'id' => 'search-filter-form',
        'action' => Url::to(['tours/index']),
        'method' => 'get',
        'enableClientValidation' => true,
//        'enableAjaxValidation' => true,
        'validateOnChange' => false,
        'validateOnBlur' => false,
//        'validationUrl' => Url::to(['/request-loans-validate-form']),
        'options' => [
            'class' => 'search-filter-form',
            'data-pjax' => 1,
        ]
      ]);
   ?>
            <div class="row">
                <?if($rating):?>
                <div class="col-md-2">
                    <?=$this->render('_rating', compact('form', 'model', 'rating'))?>
                </div>
                <?endif?>
                <?if($service):?>
                <div class="col-md-2">
                    <?=$this->render('_service', compact('form', 'model', 'service'))?>
                </div>
                <?endif?>
                <?if($hotel):?>
                <div class="col-md-4">
                    <?=$this->render('_hotel', compact('form', 'model', 'hotel'))?>
                </div>
                <?endif?>
                <?if($region):?>
                <div class="col-md-3">
                    <?=$this->render('_region', compact('form', 'region'))?>
                </div>
                <?endif?>
            </div>

            <?=$form->field($model, 'country_id')->hiddenInput(['label' => null])->label(false)?>
            <?=$form->field($model, 'Adult')->hiddenInput(['label' => null])->label(false)?>
            <?=$form->field($model, 'Child')->hiddenInput(['label' => null])->label(false)?>
            <?=$form->field($model, 'ChildAges')->hiddenInput(['label' => null])->label(false)?>

          <?php ActiveForm::end()?>
        </div>
