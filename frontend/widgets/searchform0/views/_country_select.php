<?php
use dosamigos\multiselect\MultiSelect;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;
use common\helpers\DataHelper;
?>
<div class="input-field select-destination search-form__to-country">
    <div class="input-field__label">
        <span class="input-field__title">Uz</span>
    </div>
    <div class="input-field__inner">
        <svg height="17" viewBox="0 0 18 17" width="18" xmlns="http://www.w3.org/2000/svg" class="icon-plane-arrival"><path d="m17.546676 13.9947365h-17.09676123c-.24857791 0-.44991477.2013376-.44991477.4499165v.899833c0 .2485789.20133686.4499165.44991477.4499165h17.09676123c.2485779 0 .4499148-.2013376.4499148-.4499165v-.899833c0-.2485789-.2013369-.4499165-.4499148-.4499165zm-16.42285828-8.17415837c.01619435.26060838.14027676.50147992.34215741.66459851l2.8558881 2.30613887c.22537272.18200455.49043185.30838879.77372363.36892324l8.97124154 1.92228935c.8244912.1766511 1.6910881.177535 2.4964685-.0882537.9041222-.2983594 1.3123316-.7135378 1.4119927-1.15966414.1002751-.44599097-.0934587-.9900358-.7871777-1.63067818-.6179838-.57062923-1.4058954-.92426594-2.2302095-1.10113551l-3.0373886-.65082067-3.32710822-5.66344879c-.05318008-.17358608-.19619038-.30476311-.37371268-.34279013l-2.02736796-.4342902c-.32890974-.07059367-.63728677.19493914-.61785741.5319813l1.67787762 4.90830991-3.18239239-.68176412-.93568512-2.07731142c-.06536887-.14515493-.19587564-.25056856-.35153309-.28394221l-1.23743922-.26500269c-.32193693-.06892737-.62659651.18441873-.61863528.51506886z" fill="#2e3a59" transform="translate(.000089 .447672)" data-v-0674d94f data-v-0674d94f></path></svg>
        <div tabindex="0" class="multiselect">
            <!--<div class="multiselect__select"></div>-->
        <!--<div class="multiselect__tags">
            <div class="multiselect__tags-wrap" style="display:none;"></div>
        <div class="multiselect__spinner" style="display:none;"></div>
        <span class="multiselect__placeholder">
          Izvēlies valsti
        </span></div>-->
<?= $form->field($model, 'country_id')->widget(MultiSelect::className(), [
    'data' => $model->getCountry(),
    'clientOptions' => [
        //'selectableHeader' => "<input type='text' class='search-input' autocomplete='off' placeholder='try \"12\"'>",
        //'afterInit' => new JsExpression('function(ms){ // ... }'),
        'includeSelectAllOption' => true,
        'numberDisplayed' => 5,
        'nonSelectedText' => 'Izvēlies valsti',
        'nSelectedText' => 'Izvēlies valsti',
        'text' => 'Izvēlies valsti',
        'title' => 'Izvēlies valsti',
        'allSelectedText' => 'Izvēlies valsti',
        'buttonClass' => 'thisBtn',
        /*'afterSelect' => function($data) {
            return 'getDate()';

        },*/
    ],
    'id' => 'choice-region',
    'options' => [
        'multiple' => false,
        //'data-pjax-container' => '#hot-items',
        'data-url' => Url::current(),
        //'disabled' => true,
    ], // for the actual multiselect
    'value' => 0,
])->label(false) ?>
<?php

/*echo MultiSelect::widget([
    'id' => 'choice-country',
    'options' => [
        'multiple' => false,
        //'data-pjax-container' => '#hot-items',
        'data-url' => Url::current(),
    ], // for the actual multiselect

    'data' => $model->getCountry(),
    //'value' => $hot_sort_country,
    'name' => 'SearchHotel[country_id]', // name for the form
    'clientOptions' => [
        'includeSelectAllOption' => true,
        'numberDisplayed' => 1,
    ],
]);*/
?>
        <!--<div tabindex="-1" class="multiselect__content-wrapper" style="max-height:300px;display:none;"><ul class="multiselect__content" style="display:block;"><li style="display:none;"><span class="multiselect__option">No elements found. Consider changing the search query.</span></li> <li><span class="multiselect__option">List is empty.</span></li> </ul></div>--></div></div></div>