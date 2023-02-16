<?php
use dosamigos\multiselect\MultiSelect;
use yii\web\JsExpression;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\bootstrap4\Html;
use common\helpers\DataHelper;
$regions = ($model->country_id) ? $model->getRegionsForCountry() : $model->getRegions();
?>
<div class="input-field search-form__regions<?if(!$regions):?> input-field--disabled<?endif?>">
    <div class="input-field__label">
        <span class="input-field__title">Reģions</span>
    </div>
        <div class="input-field__inner">
            <!--<button type="button" class="input-field__input" >Visi reģioni</button>-->
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="18" viewBox="0 0 14 18" aria-labelledby="location" fill="#2E3A59" role="presentation" class="icon icon-location" data-v-631c8bed ><title id="location" lang="en" data-v-631c8bed>location icon</title> <path clip-rule="evenodd" d="m7 0c-3.87 0-7 3.13-7 7 0 3.5 2.33333 7.1667 7 11 4.6667-3.8333 7-7.5 7-11 0-3.87-3.13-7-7-7-2.58 0-2.58 0 0 0zm0 10c1.65685 0 3-1.34315 3-3s-1.34315-3-3-3-3 1.34315-3 3 1.34315 3 3 3c1.10457 0 1.10457 0 0 0z" fill-rule="evenodd" ></path></svg><!--</div>  -->  
        <div tabindex="0" class="multiselect">
<?//=$model->country_id?>
<?//print_r((isset($model->region_id)) ? $model->region_id : array_values($model->getRegions()))?>
<?if($regions):?>
<?= $form->field($model, 'region_id')->widget(MultiSelect::className(), [
    'data' => $regions,
    'clientOptions' => [
        //'selectableHeader' => "<input type='text' class='search-input' autocomplete='off' placeholder='try \"12\"'>",
        //'afterInit' => new JsExpression('function(ms){ // ... }'),
        //'includeSelectAllOption' => true,
        'numberDisplayed' => 5,
        'selectableOptgroup' => true,
        'enableClickableOptGroups' => true,
        'enableCollapsibleOptGroups' => true,
        'disabledText' => 'Visi reģioni',
        'disableIfEmpty' => true,
        'enableFiltering' => true,
        'enableCaseInsensitiveFiltering' => true,
        'indentGroupOptions' => true,
        'allSelectedText' => 'Visi reģioni',
        'selectedClass' => 'selectedClass',
        'selectAllNumber' => false,
        'includeFilterClearBtn' => false,
    ],
    'id' => 'choice-region',
    'options' => [
        'multiple' => true,
        'selectableOptgroup' => true,
        //'data-pjax-container' => '#hot-items',
        'data-url' => Url::current(),
    ], // for the actual multiselect
    'value' => (isset($model->region_id)) ? $model->region_id : array_values($model->getRegions()),
])->label(false) ?>
<?php                 //print_r($model);
/*echo MultiSelect::widget([
    'model' => $model,
    'id' => 'choice-region',
    'options' => [
        'multiple' => true,
        //'data-pjax-container' => '#hot-items',
        'data-url' => Url::current(),
    ], // for the actual multiselect

    'data' => $model->getRegions(),
    'value' => 0,
    'name' => 'region_id', // name for the form
    'clientOptions' => [
        'includeSelectAllOption' => true,
        'numberDisplayed' => 1,
    ],
]);*/
/*echo Select2::widget([
    'model' => $model,
    'attribute' => 'region_id',
    'data' => $model->getRegions(),
    'options' => [
        'placeholder' => 'Select a state ...',
        'multiple' => true,
    ],
    'pluginOptions' => [
        'allowClear' => true
    ],
]);*/
?>
<!--<div style="display:none;" ><div class="regions regions--search" data-v-752ed0c3 ><div class="regions__search" data-v-752ed0c3><button type="button" class="regions__close-btn" data-v-752ed0c3></button> <input type="search" autocomplete="off" placeholder="Region/city search..." class="regions__search-input" data-v-752ed0c3> <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" aria-labelledby="search-over" fill="#8894b6" role="presentation" class="icon icon-search-over" data-v-631c8bed data-v-752ed0c3><title id="search-over" lang="en" data-v-631c8bed>search-over icon</title> <path d="m253.374369 51.8743687c3.865993 0 7 3.1340067 7 7 0 3.5261219-2.607189 6.4433023-5.99899 6.9289666l-.00101 6.0710334c0 .5522847-.447716 1-1 1-.552285 0-1-.4477153-1-1v-6.0708901c-3.392299-.4852332-6-3.4026409-6-6.9291099 0-3.8659933 3.134006-7 7-7zm0 2c-2.761424 0-5 2.2385762-5 5 0 2.4194642 1.730082 4.4718577 4.062769 4.9126927l.22042.036569.716811.1017383.717526-.1018407c2.368928-.3392014 4.170434-2.3284163 4.277441-4.7234719l.005033-.2256874c0-2.7614238-2.238577-5-5-5z" transform="matrix(.70710678 -.70710678 .70710678 .70710678 -212.893705 145.431764)" data-v-752ed0c3></path></svg></div> <div class="regions__units" data-v-752ed0c3> <div class="regions__not-found" style="display:none;" data-v-752ed0c3>
      nothing was found
    </div></div></div></div>-->
<?else:?>
<div tabindex="0" class="multiselect">
<div class="form-group field-searchtours-region_id">

<span class="multiselect-native-select"><div class="btn-group"><button type="button" class="multiselect dropdown-toggle btn btn-default" data-toggle="dropdown" title="None selected"><span class="multiselect-selected-text">...</span></button></div></span>

<div class="invalid-feedback"></div>
</div><!--<div style="display:none;" ><div class="regions regions--search" data-v-752ed0c3 ><div class="regions__search" data-v-752ed0c3><button type="button" class="regions__close-btn" data-v-752ed0c3></button> <input type="search" autocomplete="off" placeholder="Region/city search..." class="regions__search-input" data-v-752ed0c3> <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" aria-labelledby="search-over" fill="#8894b6" role="presentation" class="icon icon-search-over" data-v-631c8bed data-v-752ed0c3><title id="search-over" lang="en" data-v-631c8bed>search-over icon</title> <path d="m253.374369 51.8743687c3.865993 0 7 3.1340067 7 7 0 3.5261219-2.607189 6.4433023-5.99899 6.9289666l-.00101 6.0710334c0 .5522847-.447716 1-1 1-.552285 0-1-.4477153-1-1v-6.0708901c-3.392299-.4852332-6-3.4026409-6-6.9291099 0-3.8659933 3.134006-7 7-7zm0 2c-2.761424 0-5 2.2385762-5 5 0 2.4194642 1.730082 4.4718577 4.062769 4.9126927l.22042.036569.716811.1017383.717526-.1018407c2.368928-.3392014 4.170434-2.3284163 4.277441-4.7234719l.005033-.2256874c0-2.7614238-2.238577-5-5-5z" transform="matrix(.70710678 -.70710678 .70710678 .70710678 -212.893705 145.431764)" data-v-752ed0c3></path></svg></div> <div class="regions__units" data-v-752ed0c3> <div class="regions__not-found" style="display:none;" data-v-752ed0c3>
      nothing was found
    </div></div></div></div>-->
    </div>
<?endif?>
    </div></div></div>