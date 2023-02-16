<div class="search-form__datepicker input-field datepicker flatpickr">
    <span class="input-field__title">Izlidošana</span>
    <div class="input-field__inner" data-toggle>
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="20" viewBox="0 0 18 20" aria-labelledby="calendar" fill="#2E3A59" role="presentation" class="icon icon-calendar" data-v-631c8bed ><title id="calendar" lang="en" data-v-631c8bed>calendar icon</title> <path d="m9 12v2h-2v-2zm0 4v2h-2v-2zm2-4v2h2v-2zm2 4v2h-2v-2zm2-4v2h2v-2zm2 4v2h-2v-2zm2 6h-14c-1.10300016 0-2-.8969994-2-2v-14c0-1.10300016.89699984-2 2-2h2v-2h2v2h6v-2h2v2h2c1.1030006 0 2 .89699984 2 2v14c0 1.1030006-.8969994 2-2 2zm.0001431-14-.0001431-2h-14v2zm.000143 2 .0007134 10h-14.0009995v-10z" fill-rule="evenodd" transform="translate(-3 -2)" ></path></svg>
        <input class="input-field__input datepicker__input form-control input required" placeholder="..." tabindex="-1" type="text" readonly data-input id="searchform-date_from" name="SearchTours[date_from]" value="<?if($model->date_from):?><?=$model->date_from?><?endif?>">
    </div>
    <input type="hidden" name="curr_date_from" value="<?=$model->date_from?>" />
</div>