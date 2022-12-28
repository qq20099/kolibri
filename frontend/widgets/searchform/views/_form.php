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
<div class="index-page__search-form<?=$class?>" style="opacity:0;">
      <?php $form = ActiveForm::begin([
        'id' => 'search-form',
        'action' => Url::to(['tours/index']),
        'method' => 'get',
        'enableClientValidation' => true,
//        'enableAjaxValidation' => true,
        'validateOnChange' => false,
        'validateOnBlur' => false,
//        'validationUrl' => Url::to(['/request-loans-validate-form']),
        'options' => [
            'class' => 'search-form search-form--from-cities-loading',
            'data-url' => Url::to(['tours/specification']),
        ]
      ]);
   ?>
<div class="search-form__loader-content-btn">
    <div class="search-form__content-btn">
        <div class="search-form__content">
            <div class="search-form__content-main">
                <div class="search-form__from-to">
                    <div class="input-field select-from search-form__from-city">
                        <div class="input-field__label">
                            <span class="input-field__title" >Izlidošana</span>
                        </div>
                        <div class="input-field__inner">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="13" viewBox="0 0 17 12" aria-labelledby="box" fill="#2E3A59" role="presentation" class="icon-plane-departure icon icon-box"><title id="box" lang="en" data-v-631c8bed>box icon</title> <path d="m15.8385 10.3847h-14.73176c-.214191 0-.387677.1785-.387677.3988v.7975c0 .2203.173486.3988.387677.3988h14.73176c.2142 0 .3877-.1785.3877-.3988v-.7975c0-.2203-.1735-.3988-.3877-.3988zm-13.16772-2.65989c.15216.17047.36587.26717.58951.26692l3.16296-.00449c.24962-.00034.49564-.06113.71817-.17744l7.04988-3.67975c.6479-.3382 1.2287-.82094 1.6239-1.45321.4437-.70978.4919-1.22343.3167-1.5863-.1747-.363111-.5994-.629778-1.4114-.684108-.7232-.048349-1.4426.147539-2.0905.485483l-2.3869 1.245855-5.29908-2.0451076c-.12974-.08989972-.29664-.10048587-.43614-.0276636l-1.59311.8316512c-.25853.13483-.32104.48972-.12527.71103l3.78519 2.44486-2.50076 1.30542-1.75303-.90891c-.12249-.06352-.26704-.06333-.38938.0005l-.972339.50766c-.25296.13209-.319592.47651-.13496.69981z"></path></svg>
                            <div tabindex="0" class="multiselect">
                                <div class="multiselect__select"></div>
                            <div class="multiselect__tags">
                                <!--<div class="multiselect__tags-wrap" style="display:none;"></div> -->
                            <!--<div class="multiselect__spinner" style="display:none;"></div>-->
                            <span class="multiselect__placeholder">Riga</span>
                            <div hidden>
                            <?=$form->field($model, 'from_area')->hiddenInput(['value' => 3345])->label(false)?>
                            </div>
                            </div>
                            <!--<div tabindex="-1" class="multiselect__content-wrapper" style="max-height:300px;display:none;"><ul class="multiselect__content" style="display:block;"><li style="display:none;"><span class="multiselect__option">No elements found. Consider changing the search query.</span></li> <li><span class="multiselect__option">List is empty.</span></li> </ul></div>--></div></div></div>

<?=$this->render('_country_select', compact('form', 'model'))?>

</div>
<?=$this->render('_region_select', compact('form', 'model'))?>
</div>
<div class="search-form__content-second">
    <div class="search-form__date-nights">
        <?=$this->render('_date_select', compact('model'))?>
        <?=$this->render('_nights_select', compact('form', 'model'))?>
    </div>
    <?=$this->render('_passengers_select', compact('model', 'form'))?>
</div>
</div>
<div class="search-form__btns" >
    <button type="submit" class="search-form__search-btn btn-1" >
        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 25 25" aria-labelledby="search" fill="#ffffff" role="presentation" class="icon icon-search" data-v-631c8bed ><title id="search" lang="en" data-v-631c8bed>search icon</title> <path clip-rule="evenodd" d="m15.9139 14.5294c2.4134-3.3864 2.101-8.11815-.9371-11.15631-3.3864-3.3863301-8.8767-3.3863298-12.26304 0-3.386332 3.38634-3.386332 8.87671 0 12.26301 3.03816 3.0381 7.76994 3.3505 11.15634.9371l8.2601 8.2601 2.0438-2.0438-8.2601-8.2601c1.6089-2.2576 1.6089-2.2576 0 0zm-2.981-9.11247c2.2576 2.25755 2.2576 5.91777 0 8.17537-2.2575 2.2575-5.91775 2.2575-8.1753 0-2.25756-2.2576-2.25756-5.91782 0-8.17537 2.25755-2.25756 5.9178-2.25756 8.1753 0 1.5051 1.50503 1.5051 1.50503 0 0z" fill-rule="evenodd" ></path></svg>
        <span class="search-form__search-btn-text" >
            Meklēt ceļojumus
        </span>
    </button></div></div></div>
          <?php ActiveForm::end()?>
        </div>
<?//if(!isset($model->date_from)):?>
<?$this->registerJs("
var date_from = '".$model->date_from."';
/*var fp;
    var \$fp_options = {
            //static: true,
            wrap: true,
            altInput: true,
            altFormat: 'j M',
            dateFormat: 'U',
            minDate: 'today',
            //locale: 'lv',
            //ariaDateFormat:	'F j, Y',
            calendarContainer: '.search-form__datepicker',
            onChange: function(i, d, l){
                getNights($('.search-form'));
                $('.search-form__datepicker.flatpickr.has-error').removeClass('has-error');
            },
        };*/
/*let form = $('#search-form');
getSpecification(form, fp);*/
", \yii\web\View::POS_HEAD);?>
<?//endif?>