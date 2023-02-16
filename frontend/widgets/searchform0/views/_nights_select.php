<?php
use dosamigos\multiselect\MultiSelect;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\bootstrap4\Html;
$nights = $model->getNights();
?>
        <div class="nights search-form__nights">
            <!--<div content="Please select check-in date first" class="nights__tippy"></div>-->
            <div class="input-field <?if(!isset($model->nights) || !$nights):?>input-field--disabled<?endif?>" >
                <div class="input-field__label">
                    <span class="input-field__title">Naktis</span>
                </div>
                <!--<label class="input-field__label">
                    <!--<span class="multiselect__placeholder">...</span>-- >
                    <span class="input-field__title" >Naktis</span>
                </label>-->
                <span class="input-field__inner">
                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16" viewBox="0 0 17 16" aria-labelledby="moon-dark" fill="#2E3A59" role="presentation" class="icon icon-moon-dark" data-v-631c8bed ><title id="moon-dark" lang="en" data-v-631c8bed>moon-dark icon</title> <path clip-rule="evenodd" d="m.947826 7.14572c-.40116 4.42208 2.808114 8.34168 7.220874 8.74368 2.1061.201 4.2122-.402 5.8168-1.809 1.1032-.9045 1.9055-2.1106 2.407-3.4171-2.5073.9045-5.3154.5025-7.52178-1.10551-1.70492-1.30654-2.80811-3.11558-3.20927-5.22614-.10029-1.40703.10029-2.71356.50145-4.020096-2.90841 1.005026-4.9142 3.618086-5.215074 6.834166z" fill-rule="evenodd" ></path></svg>
        <div tabindex="0" class="multiselect">
<?if($nights):?>
<?= $form->field($model, 'nights')->widget(MultiSelect::className(), [
    'data' => $nights,
    'clientOptions' => [
        //'selectableHeader' => "<input type='text' class='search-input' autocomplete='off' placeholder='try \"12\"'>",
        //'afterInit' => new JsExpression('function(ms){ // ... }'),
        //'includeSelectAllOption' => true,
        //'numberDisplayed' => 5,
        'nonSelectedText' => '',
        'nSelectedText' => '',
        'title' => '',
        'disabledText' => '...',
        'disableIfEmpty' => true,
        //'enableFiltering' => true,
        //'enableCaseInsensitiveFiltering' => true,
        'onSelect' => function(){
            'vvvvv';
        },
    ],
    'id' => 'choice-nights',
    'options' => [
        'multiple' => false,
        //'data-pjax-container' => '#hot-items',
        'data-url' => Url::current(),
        'disabled' => ($model->nights) ? false : true,
        'class' => 'input required',
    ], // for the actual multiselect
    'value' => $model->nights,

])->label(false) ?>
<?php
/*echo MultiSelect::widget([
    'id' => 'choice-nights',
    'options' => [
        'multiple' => false,
        //'data-pjax-container' => '#hot-items',
        'data-url' => Url::current(),
        'placeholder' => 'Select a state ...',
        'prompt' => 'Select a state ...',
    ], // for the actual multiselect

    'data' => [0 => '...', 12 => '12', 15 => '15', 20 => '20'],
    'value' => 0,
    'name' => 'SearchHotel[nights]', // name for the form   input-field--disabled
    'clientOptions' => [
        'includeSelectAllOption' => true,
        'numberDisplayed' => 1,
        'selectableHeader' => 'gfdghdf',
        'prompt' => 'Select a state ...',
    ],
]);*/
?>
<?else:?>
<div class="form-group field-searchtours-nights required">

<span class="multiselect-native-select">
    <div class="btn-group">
        <button type="button" class="multiselect dropdown-toggle btn btn-default disabled" data-toggle="dropdown" disabled="" title="1"><span class="multiselect-selected-text">...</span> <b class="caret"></b></button></div></span>

<div class="invalid-feedback">Nights cannot be blank.</div>
</div>
<?endif?>
                    <!--<input type="text" tabindex="-1" required="required" class="visuallyhidden multiselect-validation-helper-input">
                    <div tabindex="0" class="multiselect multiselect--disabled">
                        <div class="multiselect__select"></div>
                        <div class="multiselect__tags">
                            <div class="multiselect__tags-wrap" style="display:none;"></div>
                            <div class="multiselect__spinner" style="display:none;"></div>
                            <span class="multiselect__placeholder">...</span>
                        </div>
                        <div tabindex="-1" class="multiselect__content-wrapper" style="max-height:300px;display:none;">
                            <ul class="multiselect__content" style="display:block;">
                                <li style="display:none;">
                                    <span class="multiselect__option">No elements found. Consider changing the search query.</span>
                                </li>
                                <li>
                                    <span class="multiselect__option">List is empty.</span>
                                </li>
                            </ul>
                        </div>-->

                    </div>
                </span>
            </div>
        </div>