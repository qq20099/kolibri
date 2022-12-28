<?php
if (!isset($model->adult))
  $model->adult = 2;
?>
<div class="search-form__passengers">
    <div class="passengers-selection">
        <div class="input-field">
        <div class="input-field__label">
            <span class="input-field__title">Tūristi</span>
            <div class="input-field__inner">
                <button type="button" class="input-field__input" id="show-tab"><?=((isset($model->adult)) ? $model->adult : 2)?><?if(isset($model->child) && $model->child):?> + <?=$model->child?><?endif?></button>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 14 14" aria-labelledby="smile" fill="#2E3A59" role="presentation" class="icon icon-smile" data-v-631c8bed ><title id="smile" lang="en" data-v-631c8bed>smile icon</title> <path clip-rule="evenodd" d="m.333328 6.99998c0 3.67602 2.990662 6.66662 6.666662 6.66662 3.67601 0 6.66671-2.9906 6.66671-6.66662 0-3.676-2.9907-6.666667-6.66671-6.666667-3.676 0-6.666662 2.990667-6.666662 6.666667zm1.333332 0c0-2.94067 2.39267-5.33333 5.33333-5.33333 2.94067 0 5.33331 2.39266 5.33331 5.33333s-2.39264 5.33332-5.33331 5.33332c-2.94066 0-5.33333-2.39265-5.33333-5.33332zm4-1c0-.55229-.44771-1-1-1-.55228 0-1 .44771-1 1 0 .55228.44772 1 1 1 .55229 0 1-.44772 1-1zm4.65734-.00467c0-.5497-.44563-.99533-.99534-.99533s-.99533.44563-.99533.99533c0 .54971.44562.99534.99533.99534s.99534-.44563.99534-.99534zm.0093 2.338h-6.66664c.44445 1.77779 1.55556 2.66669 3.33333 2.66669 1.77778 0 2.88889-.8889 3.33331-2.66669z" fill-rule="evenodd"></path></svg>
                <div class="input-field__select hidden"></div>
                <div class="passengers-selection__dropdown" style="display:none;">
                    <div class="passengers-selection__dropdown-inner">
                        <div class="passengers-selection__mob-header">
                            <button type="button"></button>
                            <h4>Tūristi</h4>
                            <div></div>
                        </div>
                        <div>
                            <div class="passengers-input">
                                <div class="passengers-input__content">
                                    <span class="passengers-input__title">Pieaugušie</span>
                                    <div class="passengers-input__inner">
                                        <button type="button" disabled="disabled" class="passengers-input__btn passengers-input__btn--remove"></button>
                                        <span class="passengers-input__val" data-min="1" data-max="9"><?=((isset($model->adult)) ? $model->adult : 2)?></span>
                                        <button type="button" disabled="disabled" class="passengers-input__btn passengers-input__btn--add"></button>
                                    </div>
                                </div>
                            </div>
                            <div class="passengers-input">
                                <div class="passengers-input__content">
                                    <span class="passengers-input__title">Bērni (0-15 gadi)</span>
                                    <div class="passengers-input__inner">
                                        <button type="button" disabled="disabled" class="passengers-input__btn passengers-input__btn--remove"></button>
                                        <span class="passengers-input__val" data-min="0" data-max="3">0</span>
                                        <button type="button" disabled="disabled" class="passengers-input__btn passengers-input__btn--add"></button>
                                    </div>
                                </div>
                                <div class="passengers-input__children-ages">
                                    <!--<div class="passengers-input passengers-input__age">
                                        <div class="passengers-input__age-wrap">
                                            <p class="passengers-input__age-title">1 Child age:</p>
                                            <div class="passengers-input__inner passengers-input__age-inner">
                                                <button type="button" class="passengers-input__btn passengers-input__btn--remove"></button>
                                                <span class="passengers-input__val">6</span>
                                                <button type="button" class="passengers-input__btn passengers-input__btn--add"></button>
                                            </div>
                                        </div>
                                    </div>-->
                                </div>
                            </div>
                        </div>
                        <!--<button type="button" class="passengers-selection__mob-apply btn-1">Apply</button>-->
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    <div hidden>
        <?=$form->field($model, 'adult')->hiddenInput()->label(false)?>
        <?=$form->field($model, 'child')->hiddenInput()->label(false)?>
        <?=$form->field($model, 'ages')->hiddenInput()->label(false)?>
    </div>
</div>