<?php
use dosamigos\multiselect\MultiSelect;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;
use common\helpers\DataHelper;

?>
<div class="tours__nav">
    <div class="tours__nav-item">
        <div class="tour-card__action">
            <!--<button type="button" class="tour-action-btn search-tour-show mr-1">
        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 25 25" aria-labelledby="search" fill="#999" role="presentation" class="icon icon-search"><title id="search" lang="en">search icon</title> <path clip-rule="evenodd" d="m15.9139 14.5294c2.4134-3.3864 2.101-8.11815-.9371-11.15631-3.3864-3.3863301-8.8767-3.3863298-12.26304 0-3.386332 3.38634-3.386332 8.87671 0 12.26301 3.03816 3.0381 7.76994 3.3505 11.15634.9371l8.2601 8.2601 2.0438-2.0438-8.2601-8.2601c1.6089-2.2576 1.6089-2.2576 0 0zm-2.981-9.11247c2.2576 2.25755 2.2576 5.91777 0 8.17537-2.2575 2.2575-5.91775 2.2575-8.1753 0-2.25756-2.2576-2.25756-5.91782 0-8.17537 2.25755-2.25756 5.9178-2.25756 8.1753 0 1.5051 1.50503 1.5051 1.50503 0 0z" fill-rule="evenodd" ></path></svg>
            </button>-->
            <button type="button" class="tour-action-btn copy-link" data-toggle="tooltip" data-trigger="click" title="Saite nokopēta">
                <svg width="16px" height="16px" viewBox="0 0 24 24" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg" class="icon--orange icon"><path d="M14.1214 16.9497 12 19.0711c-1.9526 1.9526-5.1184 1.9526-7.071 0-1.9527-1.9527-1.9527-5.1185 0-7.0711l2.1213-2.1213 1.4142 1.4142-2.1213 2.1213c-1.1716 1.1716-1.1716 3.0711 0 4.2426 1.1715 1.1716 3.071 1.1716 4.2426 0l2.1213-2.1213 1.4143 1.4142ZM9.8787 7.0502 12 4.929c1.9527-1.9526 5.1185-1.9526 7.0711 0 1.9526 1.9526 1.9526 5.1185 0 7.0711l-2.1213 2.1213-1.4142-1.4142 2.1213-2.1213c1.1716-1.1716 1.1716-3.071 0-4.2427-1.1716-1.1715-3.0711-1.1715-4.2427 0l-2.1213 2.1213-1.4142-1.4142Zm-2.1213 7.7782 1.4142 1.4142 7.0711-7.071-1.4142-1.4143-7.0711 7.0711Z" fill="currentColor" fill-rule="evenodd"></path></svg>
            </button>
        </div>
        <button type="button" class="view view--<?if(isset($_COOKIE['item']) && $_COOKIE['item'] == 'list'):?>lines<?else:?>tiles<?endif?>">
            <span class="view__item">
                <svg data-v-631c8bed="" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" aria-labelledby="tile-view" fill="#94AAC7" role="presentation" class="icon icon-tile-view">
                    <title data-v-631c8bed="" id="tile-view" lang="en">tile-view icon</title>
                    <path d="m45.25 26.625v4.625h-4.625v-4.625zm-7.875 0v4.625h-4.625v-4.625zm7.875-7.875v4.625h-4.625v-4.625zm-7.875 0v4.625h-4.625v-4.625z" fill="none" stroke="#2E3A59" stroke-width="1.5" transform="translate(-32 -18)" data-v-631c8bed=""></path>
                </svg>
            </span>
            <span class="view__item">
                <svg data-v-631c8bed="" xmlns="http://www.w3.org/2000/svg" width="13" height="12" viewBox="0 0 14 13" aria-labelledby="line-view" fill="#94AAC7" role="presentation" class="icon icon-line-view">
                    <title data-v-631c8bed="" id="line-view" lang="en">line-view icon</title>
                    <path d="m1.16666667 0c.6443322 0 1.16666666.52233446 1.16666666 1.16666667 0 .6443322-.52233446 1.16666666-1.16666666 1.16666666-.64433221 0-1.16666667-.52233446-1.16666667-1.16666666 0-.64433221.52233446-1.16666667 1.16666667-1.16666667zm0 4.66666667c.6443322 0 1.16666666.52233446 1.16666666 1.16666666 0 .64433221-.52233446 1.16666667-1.16666666 1.16666667-.64433221 0-1.16666667-.52233446-1.16666667-1.16666667 0-.6443322.52233446-1.16666666 1.16666667-1.16666666zm0 4.66666666c.6443322 0 1.16666666.52233446 1.16666666 1.16666667 0 .6443322-.52233446 1.1666667-1.16666666 1.1666667-.64433221 0-1.16666667-.5223345-1.16666667-1.1666667 0-.64433221.52233446-1.16666667 1.16666667-1.16666667zm3.5-8.55555555h9.33333333v1.16666666h-9.33333333zm0 4.66666666h9.33333333v1.16666667h-9.33333333zm0 4.66666666h9.33333333v1.1666667h-9.33333333z" fill-rule="evenodd" transform="translate(0 .935652)" data-v-631c8bed=""></path>
                </svg>
            </span>
        </button>
    </div>
    <?if(isset($countryFilter) && $countryFilter):?>
    <div class="tours__nav-item tours__nav-item--country input-field<?=((isset($countryFilter) && count($countryFilter) > 1) ? '' : ' input-field--disabled')?>">
        <!--<label class="input-field__label">
            <span class="input-field__title">To</span>
        </label>-->
        <form action="<?=Url::current(['page' => 1])?>" method="get" id="find-by-country" data-pjax="true">
<?php
echo MultiSelect::widget([
    'id' => 'chuse-country',
    'options' => [
        'multiple' => false,
        'data-pjax-container' => '#hot-items',
        'data-url' => Url::current(),
        'disabled' => (isset($countryFilter) && count($countryFilter) > 1) ? false : true,
    ], // for the actual multiselect
    //'data' => \yii\helpers\ArrayHelper::map($dataProvider->getModels(), 'hotel.location0.country.id', 'hotel.location0.country.title'),
    'data' => $countryFilter,
    'value' => $hot_sort_country,
    'name' => 'SearchTours[country_id]', // name for the form
    'clientOptions' => [
        //'includeSelectAllOption' => true,
        'numberDisplayed' => 1,
        'disabled' => true,
    ],
]);
?>
<?if(Yii::$app->controller->id == 'site'):?>
<input type="hidden" name="SearchTours[main]" value="1" />
<?endif?>
<input type="hidden" name="SearchTours[from_area]" value="3345" />
        <!--<div class="input-field__inner">
            <div tabindex="0" class="multiselect">
                <div class="multiselect__select"></div>
                <div class="multiselect__tags">
                    <div class="multiselect__tags-wrap" style="display: none;"></div>
                    <div class="multiselect__spinner" style="display: none;"></div>
                    <span class="multiselect__single">Egypt</span>
                </div>
                <div tabindex="-1" class="multiselect__content-wrapper" style="max-height: 300px; display: none;"><ul class="multiselect__content" style="display: inline-block;">  <li class="multiselect__element"><span data-select="" data-selected="" data-deselect="" class="multiselect__option multiselect__option--highlight multiselect__option--selected"><span>Egypt</span></span> </li> <li style="display: none;"><span class="multiselect__option">No elements found. Consider changing the search query.</span></li> <li style="display: none;"><span class="multiselect__option">List is empty.</span></li> </ul></div>
            </div>
        </div>-->
      </form>
    </div>
    <?endif?>
</div>