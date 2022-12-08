<?php
//use bs\Flatpickr\FlatpickrWidget;
use bs\Flatpickr\FlatpickrWidget as Flatpickr;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;
?>
<div class="index-page__search-form<?=$class?>">
      <?php $form = ActiveForm::begin([
        'action' => Url::toRoute('javascript:;'),
        'enableClientValidation' => true,
//        'enableAjaxValidation' => true,
        'validateOnChange' => false,
        'validateOnBlur' => false,
//        'validationUrl' => Url::to(['/request-loans-validate-form']),
        'options' => [
          'class' => 'search-form search-form--from-cities-loading',
        ]
      ]);
   ?>
<div class="search-form__loader-content-btn">
<div class="search-form__content-btn" ><div class="search-form__content" ><div class="search-form__content-main" ><div class="search-form__from-to" ><div class="input-field select-from search-form__from-city" data-v-616729a9 ><div class="input-field__label" data-v-616729a9><span class="input-field__title" data-v-616729a9>Izlidošana</span></div> <div class="input-field__inner" data-v-616729a9><svg xmlns="http://www.w3.org/2000/svg" width="18" height="13" viewBox="0 0 17 12" aria-labelledby="box" fill="#2E3A59" role="presentation" class="icon-plane-departure icon icon-box" data-v-631c8bed data-v-616729a9><title id="box" lang="en" data-v-631c8bed>box icon</title> <path d="m15.8385 10.3847h-14.73176c-.214191 0-.387677.1785-.387677.3988v.7975c0 .2203.173486.3988.387677.3988h14.73176c.2142 0 .3877-.1785.3877-.3988v-.7975c0-.2203-.1735-.3988-.3877-.3988zm-13.16772-2.65989c.15216.17047.36587.26717.58951.26692l3.16296-.00449c.24962-.00034.49564-.06113.71817-.17744l7.04988-3.67975c.6479-.3382 1.2287-.82094 1.6239-1.45321.4437-.70978.4919-1.22343.3167-1.5863-.1747-.363111-.5994-.629778-1.4114-.684108-.7232-.048349-1.4426.147539-2.0905.485483l-2.3869 1.245855-5.29908-2.0451076c-.12974-.08989972-.29664-.10048587-.43614-.0276636l-1.59311.8316512c-.25853.13483-.32104.48972-.12527.71103l3.78519 2.44486-2.50076 1.30542-1.75303-.90891c-.12249-.06352-.26704-.06333-.38938.0005l-.972339.50766c-.25296.13209-.319592.47651-.13496.69981z" data-v-616729a9></path></svg> <input type="text" tabindex="-1" required="required" class="visuallyhidden multiselect-validation-helper-input" data-v-616729a9> <div tabindex="0" class="multiselect" data-v-616729a9><div class="multiselect__select"></div>  <div class="multiselect__tags"><div class="multiselect__tags-wrap" style="display:none;"></div><div class="multiselect__spinner" style="display:none;"></div><span class="multiselect__placeholder">
          Select city
        </span></div> <div tabindex="-1" class="multiselect__content-wrapper" style="max-height:300px;display:none;"><ul class="multiselect__content" style="display:block;"><li style="display:none;"><span class="multiselect__option">No elements found. Consider changing the search query.</span></li> <li><span class="multiselect__option">List is empty.</span></li> </ul></div></div></div></div> <div class="input-field select-destination search-form__to-country" data-v-0674d94f ><div class="input-field__label" data-v-0674d94f><span class="input-field__title" data-v-0674d94f>Uz</span></div> <div class="input-field__inner" data-v-0674d94f><svg height="17" viewBox="0 0 18 17" width="18" xmlns="http://www.w3.org/2000/svg" class="icon-plane-arrival" data-v-0674d94f data-v-0674d94f><path d="m17.546676 13.9947365h-17.09676123c-.24857791 0-.44991477.2013376-.44991477.4499165v.899833c0 .2485789.20133686.4499165.44991477.4499165h17.09676123c.2485779 0 .4499148-.2013376.4499148-.4499165v-.899833c0-.2485789-.2013369-.4499165-.4499148-.4499165zm-16.42285828-8.17415837c.01619435.26060838.14027676.50147992.34215741.66459851l2.8558881 2.30613887c.22537272.18200455.49043185.30838879.77372363.36892324l8.97124154 1.92228935c.8244912.1766511 1.6910881.177535 2.4964685-.0882537.9041222-.2983594 1.3123316-.7135378 1.4119927-1.15966414.1002751-.44599097-.0934587-.9900358-.7871777-1.63067818-.6179838-.57062923-1.4058954-.92426594-2.2302095-1.10113551l-3.0373886-.65082067-3.32710822-5.66344879c-.05318008-.17358608-.19619038-.30476311-.37371268-.34279013l-2.02736796-.4342902c-.32890974-.07059367-.63728677.19493914-.61785741.5319813l1.67787762 4.90830991-3.18239239-.68176412-.93568512-2.07731142c-.06536887-.14515493-.19587564-.25056856-.35153309-.28394221l-1.23743922-.26500269c-.32193693-.06892737-.62659651.18441873-.61863528.51506886z" fill="#2e3a59" transform="translate(.000089 .447672)" data-v-0674d94f data-v-0674d94f></path></svg> <div tabindex="0" class="multiselect" data-v-0674d94f><div class="multiselect__select"></div>  <div class="multiselect__tags"><div class="multiselect__tags-wrap" style="display:none;"></div><div class="multiselect__spinner" style="display:none;"></div><span class="multiselect__placeholder">
          Select country
        </span></div> <div tabindex="-1" class="multiselect__content-wrapper" style="max-height:300px;display:none;"><ul class="multiselect__content" style="display:block;"><li style="display:none;"><span class="multiselect__option">No elements found. Consider changing the search query.</span></li> <li><span class="multiselect__option">List is empty.</span></li> </ul></div></div></div></div></div> <div class="input-field search-form__regions" ><div class="input-field__label" ><span class="input-field__title" >
                Reģions
              </span> <div class="input-field__inner" ><button type="button" class="input-field__input" >Visi reģioni</button> <svg xmlns="http://www.w3.org/2000/svg" width="14" height="18" viewBox="0 0 14 18" aria-labelledby="location" fill="#2E3A59" role="presentation" class="icon icon-location" data-v-631c8bed ><title id="location" lang="en" data-v-631c8bed>location icon</title> <path clip-rule="evenodd" d="m7 0c-3.87 0-7 3.13-7 7 0 3.5 2.33333 7.1667 7 11 4.6667-3.8333 7-7.5 7-11 0-3.87-3.13-7-7-7-2.58 0-2.58 0 0 0zm0 10c1.65685 0 3-1.34315 3-3s-1.34315-3-3-3-3 1.34315-3 3 1.34315 3 3 3c1.10457 0 1.10457 0 0 0z" fill-rule="evenodd" ></path></svg></div> <div style="display:none;" ><div class="regions regions--search" data-v-752ed0c3 ><div class="regions__search" data-v-752ed0c3><button type="button" class="regions__close-btn" data-v-752ed0c3></button> <input type="search" autocomplete="off" placeholder="Region/city search..." class="regions__search-input" data-v-752ed0c3> <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" aria-labelledby="search-over" fill="#8894b6" role="presentation" class="icon icon-search-over" data-v-631c8bed data-v-752ed0c3><title id="search-over" lang="en" data-v-631c8bed>search-over icon</title> <path d="m253.374369 51.8743687c3.865993 0 7 3.1340067 7 7 0 3.5261219-2.607189 6.4433023-5.99899 6.9289666l-.00101 6.0710334c0 .5522847-.447716 1-1 1-.552285 0-1-.4477153-1-1v-6.0708901c-3.392299-.4852332-6-3.4026409-6-6.9291099 0-3.8659933 3.134006-7 7-7zm0 2c-2.761424 0-5 2.2385762-5 5 0 2.4194642 1.730082 4.4718577 4.062769 4.9126927l.22042.036569.716811.1017383.717526-.1018407c2.368928-.3392014 4.170434-2.3284163 4.277441-4.7234719l.005033-.2256874c0-2.7614238-2.238577-5-5-5z" transform="matrix(.70710678 -.70710678 .70710678 .70710678 -212.893705 145.431764)" data-v-752ed0c3></path></svg></div> <div class="regions__units" data-v-752ed0c3> <div class="regions__not-found" style="display:none;" data-v-752ed0c3>
      nothing was found
    </div></div></div></div></div></div></div>
    <div class="search-form__content-second">
        <div class="search-form__date-nights">
            <div class="search-form__datepicker input-field datepicker input-field--disabled" data-v-aa89be5c ><span class="input-field__title" data-v-aa89be5c>Izlidošana</span> <div class="input-field__inner" data-v-aa89be5c>
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="20" viewBox="0 0 18 20" aria-labelledby="calendar" fill="#2E3A59" role="presentation" class="icon icon-calendar" data-v-631c8bed data-v-aa89be5c><title id="calendar" lang="en" data-v-631c8bed>calendar icon</title> <path d="m9 12v2h-2v-2zm0 4v2h-2v-2zm2-4v2h2v-2zm2 4v2h-2v-2zm2-4v2h2v-2zm2 4v2h-2v-2zm2 6h-14c-1.10300016 0-2-.8969994-2-2v-14c0-1.10300016.89699984-2 2-2h2v-2h2v2h6v-2h2v2h2c1.1030006 0 2 .89699984 2 2v14c0 1.1030006-.8969994 2-2 2zm.0001431-14-.0001431-2h-14v2zm.000143 2 .0007134 10h-14.0009995v-10z" fill-rule="evenodd" transform="translate(-3 -2)" data-v-aa89be5c></path></svg>
<!--<input type="text" tabindex="-1" required="required" value="" class="visuallyhidden multiselect-validation-helper-input" data-v-aa89be5c> -->
<?/*= $form->field($model, 'date_from')->widget(FlatpickrWidget::class, [
    //'locale' => strtolower(substr(Yii::$app->language, 0, 2)),
    // https://chmln.github.io/flatpickr/plugins/
    'plugins' => [
         'confirmDate' => [
               'confirmIcon'=> "<i class='fa fa-check'></i>",
               'confirmText' => 'OK',
               'showAlways' => false,
               'theme' => 'light',
         ],
    ],
    'groupBtnShow' => true,
    'options' => [
        'class' => 'form-control',
    ],
    'clientOptions' => [
        // config options https://chmln.github.io/flatpickr/options/
        'allowInput' => true,
        'defaultDate' => $model->date_from ? date(DATE_ATOM, $model->date_from) : null,
        'enableTime' => true,
        'time_24hr' => true,
    ],
])->label(false)*/ ?>
<?= $form->field($model, 'date_from')->widget(Flatpickr::className(), [
    'locale' => strtolower(substr(Yii::$app->language, 0, 2)),
    'options' => [
        'class' => 'form-control',
    ],
    'clientOptions' => [
        // config options https://chmln.github.io/flatpickr/options/
        'allowInput' => true,
        'defaultDate' => $model->date_from ? date(DATE_ATOM, $model->date_from) : null,
        'enableTime' => true,
        'time_24hr' => true,
        'appendTo' => '.search-form__datepicker .field-searchform-date_from',
    ],
])->label(false) ?>
<?/*= $form->field($model, 'date_from')->widget(Flatpickr::class, [
    'locale' => 'fr', //default is strtolower(substr(Yii::$app->language, 0, 2))
    //
    'clear' => false, // renders reset button, default is true
    'toggle' => true, // renders button to open calendar, default is false
    'clientOptions' => [
        // config options https://chmln.github.io/flatpickr/options/
        'allowInput' => false, //default is true
        'defaultDate' => $model->date_from ? date(DATE_ATOM, $model->date_from) : null,
        'enableTime' => true, //default is false
    ],
]) */?>
</div></div> <div class="nights search-form__nights" ><div content="Please select check-in date first" class="nights__tippy"></div><div class="input-field input-field--disabled" ><label class="input-field__label" ><span class="input-field__title" >Naktis</span></label><span class="input-field__inner" >
        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16" viewBox="0 0 17 16" aria-labelledby="moon-dark" fill="#2E3A59" role="presentation" class="icon icon-moon-dark" data-v-631c8bed ><title id="moon-dark" lang="en" data-v-631c8bed>moon-dark icon</title> <path clip-rule="evenodd" d="m.947826 7.14572c-.40116 4.42208 2.808114 8.34168 7.220874 8.74368 2.1061.201 4.2122-.402 5.8168-1.809 1.1032-.9045 1.9055-2.1106 2.407-3.4171-2.5073.9045-5.3154.5025-7.52178-1.10551-1.70492-1.30654-2.80811-3.11558-3.20927-5.22614-.10029-1.40703.10029-2.71356.50145-4.020096-2.90841 1.005026-4.9142 3.618086-5.215074 6.834166z" fill-rule="evenodd" ></path></svg>
<input type="text" tabindex="-1" required="required" class="visuallyhidden multiselect-validation-helper-input"><div tabindex="0" class="multiselect multiselect--disabled" ><div class="multiselect__select"></div>
<div class="multiselect__tags">
    <div class="multiselect__tags-wrap" style="display:none;"></div>
    <div class="multiselect__spinner" style="display:none;"></div>
    <span class="multiselect__placeholder">...</span>
</div>
<div tabindex="-1" class="multiselect__content-wrapper" style="max-height:300px;display:none;"><ul class="multiselect__content" style="display:block;"><li style="display:none;"><span class="multiselect__option">No elements found. Consider changing the search query.</span></li> <li><span class="multiselect__option">List is empty.</span></li> </ul></div></div></span></div></div></div> <div class="search-form__passengers" ><div class="passengers-selection" data-v-e7a34ae0 ><div class="input-field__label" data-v-e7a34ae0><span class="input-field__title" data-v-e7a34ae0>Tūristi</span> <div class="input-field__inner" data-v-e7a34ae0><button type="button" disabled="disabled" class="input-field__input" data-v-e7a34ae0>

      </button> <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 14 14" aria-labelledby="smile" fill="#2E3A59" role="presentation" class="icon icon-smile" data-v-631c8bed data-v-e7a34ae0><title id="smile" lang="en" data-v-631c8bed>smile icon</title> <path clip-rule="evenodd" d="m.333328 6.99998c0 3.67602 2.990662 6.66662 6.666662 6.66662 3.67601 0 6.66671-2.9906 6.66671-6.66662 0-3.676-2.9907-6.666667-6.66671-6.666667-3.676 0-6.666662 2.990667-6.666662 6.666667zm1.333332 0c0-2.94067 2.39267-5.33333 5.33333-5.33333 2.94067 0 5.33331 2.39266 5.33331 5.33333s-2.39264 5.33332-5.33331 5.33332c-2.94066 0-5.33333-2.39265-5.33333-5.33332zm4-1c0-.55229-.44771-1-1-1-.55228 0-1 .44771-1 1 0 .55228.44772 1 1 1 .55229 0 1-.44772 1-1zm4.65734-.00467c0-.5497-.44563-.99533-.99534-.99533s-.99533.44563-.99533.99533c0 .54971.44562.99534.99533.99534s.99534-.44563.99534-.99534zm.0093 2.338h-6.66664c.44445 1.77779 1.55556 2.66669 3.33333 2.66669 1.77778 0 2.88889-.8889 3.33331-2.66669z" fill-rule="evenodd" data-v-e7a34ae0></path></svg> <div class="input-field__select hidden" data-v-e7a34ae0></div> <div class="passengers-selection__dropdown" style="display:none;" data-v-e7a34ae0><div class="passengers-selection__dropdown-inner" data-v-e7a34ae0><div class="passengers-selection__mob-header" data-v-e7a34ae0><button type="button" data-v-e7a34ae0></button> <h4 data-v-e7a34ae0>Tūristi</h4> <div data-v-e7a34ae0></div></div> <div data-v-e7a34ae0><div class="passengers-input" data-v-e7a34ae0><div class="passengers-input__content"><span class="passengers-input__title">Pieaugušie</span> <div class="passengers-input__inner"><button type="button" disabled="disabled" class="passengers-input__btn passengers-input__btn--remove"></button> <span class="passengers-input__val">2
        </span> <button type="button" disabled="disabled" class="passengers-input__btn passengers-input__btn--add"></button></div></div></div> <div class="passengers-input" data-v-e7a34ae0><div class="passengers-input__content"><span class="passengers-input__title">Bērni (0-15 gadi)</span> <div class="passengers-input__inner"><button type="button" disabled="disabled" class="passengers-input__btn passengers-input__btn--remove"></button> <span class="passengers-input__val">0
        </span> <button type="button" disabled="disabled" class="passengers-input__btn passengers-input__btn--add"></button></div></div> <div class="passengers-input__children-ages"></div></div></div> <button type="button" class="passengers-selection__mob-apply btn-1" data-v-e7a34ae0>
            Apply
          </button></div></div></div></div></div></div></div></div> <div class="search-form__btns" ><button type="submit" disabled="disabled" class="search-form__search-btn btn-1" ><svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 25 25" aria-labelledby="search" fill="#ffffff" role="presentation" class="icon icon-search" data-v-631c8bed ><title id="search" lang="en" data-v-631c8bed>search icon</title> <path clip-rule="evenodd" d="m15.9139 14.5294c2.4134-3.3864 2.101-8.11815-.9371-11.15631-3.3864-3.3863301-8.8767-3.3863298-12.26304 0-3.386332 3.38634-3.386332 8.87671 0 12.26301 3.03816 3.0381 7.76994 3.3505 11.15634.9371l8.2601 8.2601 2.0438-2.0438-8.2601-8.2601c1.6089-2.2576 1.6089-2.2576 0 0zm-2.981-9.11247c2.2576 2.25755 2.2576 5.91777 0 8.17537-2.2575 2.2575-5.91775 2.2575-8.1753 0-2.25756-2.2576-2.25756-5.91782 0-8.17537 2.25755-2.25756 5.9178-2.25756 8.1753 0 1.5051 1.50503 1.5051 1.50503 0 0z" fill-rule="evenodd" ></path></svg> <span class="search-form__search-btn-text" >
            Meklēt ceļojumus
          </span></button></div></div></div>
          <?php ActiveForm::end()?>
        </div>