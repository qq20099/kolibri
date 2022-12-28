<?php
use dosamigos\multiselect\MultiSelect;
use yii\web\JsExpression;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\bootstrap4\Html;
use common\helpers\DataHelper;
?>
<div class="input-field search-form__regions">
    <div class="input-field__label">
        <span class="input-field__title">Reģions</span>
    </div>
        <div class="input-field__inner">
            <!--<button type="button" class="input-field__input" >Visi reģioni</button>-->
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="18" viewBox="0 0 14 18" aria-labelledby="location" fill="#2E3A59" role="presentation" class="icon icon-location" data-v-631c8bed ><title id="location" lang="en" data-v-631c8bed>location icon</title> <path clip-rule="evenodd" d="m7 0c-3.87 0-7 3.13-7 7 0 3.5 2.33333 7.1667 7 11 4.6667-3.8333 7-7.5 7-11 0-3.87-3.13-7-7-7-2.58 0-2.58 0 0 0zm0 10c1.65685 0 3-1.34315 3-3s-1.34315-3-3-3-3 1.34315-3 3 1.34315 3 3 3c1.10457 0 1.10457 0 0 0z" fill-rule="evenodd" ></path></svg><!--</div>  -->
        <div tabindex="0" class="multiselect">



<?/*= $form->field($model, 'region_id')->widget(MultiSelect::className(), [
    'data' => $data,
    'clientOptions' => [
        //'selectableHeader' => "<input type='text' class='search-input' autocomplete='off' placeholder='try \"12\"'>",
        //'afterInit' => new JsExpression('function(ms){ // ... }'),
        //'includeSelectAllOption' => true,
        //'numberDisplayed' => 5,
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
    'value' => array_values($model->getRegions()),
])->label(false)*/ ?>
<?php
echo MultiSelect::widget([
    'model' => $searchTours,
    'id' => 'choice-region',
    'options' => [
        'multiple' => true,
        //'data-pjax-container' => '#hot-items',
        'data-url' => Url::current(),
    ], // for the actual multiselect

    'data' => $data,
    'value' => 0,
    'name' => 'region_id', // name for the form
    'clientOptions' => [
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
]);
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
</div></div></div>