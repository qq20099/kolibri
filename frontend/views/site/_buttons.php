<?php
use dosamigos\multiselect\MultiSelect;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;
use common\helpers\DataHelper;
$countryFilter = $searchModel->getCountry();

?>
<div data-v-bcb48e5a="" class="tours__nav">
    <div data-v-bcb48e5a="" class="tours__nav-item">
        <button data-v-bcb48e5a="" type="button" class="view view--<?if(isset($_COOKIE['item']) && $_COOKIE['item'] == 'list'):?>lines<?else:?>tiles<?endif?>">
            <span data-v-bcb48e5a="" class="view__item">
                <svg data-v-631c8bed="" data-v-bcb48e5a="" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" aria-labelledby="tile-view" fill="#94AAC7" role="presentation" class="icon icon-tile-view">
                    <title data-v-631c8bed="" id="tile-view" lang="en">tile-view icon</title>
                    <path data-v-bcb48e5a="" d="m45.25 26.625v4.625h-4.625v-4.625zm-7.875 0v4.625h-4.625v-4.625zm7.875-7.875v4.625h-4.625v-4.625zm-7.875 0v4.625h-4.625v-4.625z" fill="none" stroke="#2E3A59" stroke-width="1.5" transform="translate(-32 -18)" data-v-631c8bed=""></path>
                </svg>
            </span>
            <span data-v-bcb48e5a="" class="view__item">
                <svg data-v-631c8bed="" data-v-bcb48e5a="" xmlns="http://www.w3.org/2000/svg" width="13" height="12" viewBox="0 0 14 13" aria-labelledby="line-view" fill="#94AAC7" role="presentation" class="icon icon-line-view">
                    <title data-v-631c8bed="" id="line-view" lang="en">line-view icon</title>
                    <path data-v-bcb48e5a="" d="m1.16666667 0c.6443322 0 1.16666666.52233446 1.16666666 1.16666667 0 .6443322-.52233446 1.16666666-1.16666666 1.16666666-.64433221 0-1.16666667-.52233446-1.16666667-1.16666666 0-.64433221.52233446-1.16666667 1.16666667-1.16666667zm0 4.66666667c.6443322 0 1.16666666.52233446 1.16666666 1.16666666 0 .64433221-.52233446 1.16666667-1.16666666 1.16666667-.64433221 0-1.16666667-.52233446-1.16666667-1.16666667 0-.6443322.52233446-1.16666666 1.16666667-1.16666666zm0 4.66666666c.6443322 0 1.16666666.52233446 1.16666666 1.16666667 0 .6443322-.52233446 1.1666667-1.16666666 1.1666667-.64433221 0-1.16666667-.5223345-1.16666667-1.1666667 0-.64433221.52233446-1.16666667 1.16666667-1.16666667zm3.5-8.55555555h9.33333333v1.16666666h-9.33333333zm0 4.66666666h9.33333333v1.16666667h-9.33333333zm0 4.66666666h9.33333333v1.1666667h-9.33333333z" fill-rule="evenodd" transform="translate(0 .935652)" data-v-631c8bed=""></path>
                </svg>
            </span>
        </button>
    </div>
    <?if($countryFilter):?>
    <div class="tours__nav-item tours__nav-item--country input-field">
        <!--<label data-v-bcb48e5a="" class="input-field__label">
            <span data-v-bcb48e5a="" class="input-field__title">To</span>
        </label>-->
        <form action="<?=Url::current(['page' => 1])?>" method="get" id="find-by-country" data-pjax="true">
<?php
echo MultiSelect::widget([
    'id' => 'chuse-country',
    'options' => [
        'multiple' => false,
        'data-pjax-container' => '#hot-items',
        'data-url' => Url::current(),
    ], // for the actual multiselect
    //'data' => \yii\helpers\ArrayHelper::map($dataProvider->getModels(), 'hotel.location0.country.id', 'hotel.location0.country.title'),
    'data' => $countryFilter,
    'value' => $hot_sort_country,
    'name' => 'SearchTours[country_id]', // name for the form
    'clientOptions' => [
        'includeSelectAllOption' => true,
        'numberDisplayed' => 1,
    ],
]);
?>
<?if(Yii::$app->controller->id == 'site'):?>
<input type="hidden" name="SearchTours[main]" value="1" />
<?endif?>
<input type="hidden" name="SearchTours[from_area]" value="3345" />
        <!--<div data-v-bcb48e5a="" class="input-field__inner">
            <div data-v-bcb48e5a="" tabindex="0" class="multiselect">
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