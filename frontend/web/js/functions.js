$(document).ready(function(){
    moment.locale();
//    moment().format('L');
    var fp;
    var $fl_dat;
    var $fp_options = {
            //static: true,
            wrap: true,
            altInput: true,
            altFormat: 'j M',
            dateFormat: 'U',
            minDate: 'today',
            locale: 'lv',
            //ariaDateFormat:	"F j, Y",
            calendarContainer: '.search-form__datepicker',
            /*wrap: true,
            calendarContainer: '.search-form__datepicker',
            altInput: true,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",*/
            onChange: function(i, d, l){
                getNights($('.search-form'));
                $('.search-form__datepicker.flatpickr.has-error').removeClass('has-error');
            },
            /*onValueUpdate: function(dObj, dStr){
                console.log(dObj);
                console.log(dStr);
            },*/
    /*onOpen: [
        function(selectedDates, dateStr, instance){
            console.log(selectedDates+' '+dateStr+' '+instance);
        },
        function(selectedDates, dateStr, instance){
            console.log(dateStr);
            console.log(instance.currentMonth);
            console.log(instance);
            $('.dayContainer').attr('class', 'dayContainer dayContainer-'+instance.currentMonth+'-'+instance.currentYear);
        }
    ],*/
            onDayCreate: function(dObj, dStr, fp, dayElem){
                dayElem.innerHTML += "<span class='calendar-min-price calendar-min-price-"+moment($(dayElem).attr('aria-label')).format('YYYY-MM-DD')+"'></span>";
                //console.log(fp.currentYear+'-'+(fp.currentMonth)+'-'+$(dayElem).text());
                //var birthday = new Date($(dayElem).attr('aria-label'));
/*console.log(fp);
console.log(dayElem);
console.log(dStr);
console.log(moment($(dayElem).attr('aria-label')).format('YYYY-MM-DD'));*/

                /*$.ajax({
                    url: '/tours/mo',
                    type: 'post',
                    data: {
                        y: fp.currentYear,
                        m: fp.currentMonth,
                    },
                });*/
                //console.log(dStr.toString());
                /*console.log(dObj);
                console.log(dStr);
                console.log(fp);
                console.log(dayElem);
                var d;

                if (!dStr && $('#flat-dat .ffpp').length) {
                    if (!$(dayElem).hasClass('flatpickr-disabled')) {
                        d = $('#flat-dat .ffpp').remove().text();
                        console.log(d);
                        dayElem.innerHTML += "<span class='event'>"+d+"</span>";
                    }
                }*/
                //console.log($fl_dat);
                /*console.log(dStr.toString()+' = '+$('#fld-'+dStr).length);
                if ($('#fld-'+dStr).length) {
                    dayElem.innerHTML += "<span class='event'>"+$('#fld-'+dStr).text()+"</span>";
                }*/
                // Utilize dayElem.dateObj, which is the corresponding Date
                /*console.log(dObj);
                console.log(dStr);
                console.log(fp);
                console.log(dayElem);
                console.log($fl_dat);*/

                // dummy logic
                //if (Math.random() < 0.15)
//                  dayElem.innerHTML += "<span class='event'></span>";
//                else if (Math.random() > 0.85)
//                  dayElem.innerHTML += "<span class='event busy'></span>";
            },
        };
    //alert(date_from);
    $(function(){
        $('.index-page__search-form').css('opacity', '1');
        $('.banners').css('opacity', '1');
        $('.banners').css('height', '');
    });

    $(document).on('change', '#searchtours-country_id, #choice-nights, #chuse-country', function(e){
        let p = $(this).parent();
        let c = p.find('.multiselect-container.dropdown-menu');
        p.find('.open').removeClass('open');
        p.find('.show').removeClass('open');
        c.removeClass('show');
    });

    $(document).on('change', '#searchtours-child', function(e){
        let form = $(this).closest('form');
        getSpecification(form, fp);
        return false;
    });

    $(document).on('change', '#searchtours-adult', function(e){
        let form = $(this).closest('form');
        getSpecification(form, fp);
        return false;
    });

    $(document).on('change', '#searchtours-country_id', function(e){
        let form = $(this).closest('form');
        $('#searchtours-region_id').val(0);
        getSpecification(form, fp);
        return false;
    });

    $(document).on('change', '#searchtours-region_id', function(e){
        let form = $(this).closest('form');
        getSpecification(form, fp);
        return false;
    });

    $(document).on('change', '#search-form .required.input', function(e){
        let l = $(this);
        if (!l.val() || l.val() == 0)
          l.closest('.has-error').removeClass('has-error');
    });

    $(document).on('change', '.passengers-input__content:first .passengers-input__val', function(e){
        let a = $(this).text();
        $('#searchtours-adult').val(a);
        $('#searchtours-adult').change();
        console.log(a);
    });

    $(document).on('change', '.passengers-input__content:last .passengers-input__val', function(e){
        let a = $(this).text();
        $('#searchtours-child').val(a);
        $('#searchtours-child').change();
        console.log(a);
    });

    $(document).on('submit', '#search-form', function(e){
        //let $date = $('#searchform-date_from');
        let re = $(this).find('.required.input');
        let ag = $('.passengers-input__age .passengers-input__val');
        let a = $('.passengers-input__content:first .passengers-input__val').text();
        let c = $('.passengers-input__content:last .passengers-input__val').text();
        let arr = [];
        let err = 0;

        re.each(function(){
            if (!$(this).val() || $(this).val() == 0) {
                $(this).closest('.input-field').addClass('has-error');
                //err = 1;
            } else {
                //$(this).closest('.input-field').removeClass('has-error');
            }
            console.log($(this).closest('.input-field').attr('class'));
            console.log($(this).attr('class'));
            console.log($(this).val());
        });

        err = $(this).find('.input-field.has-error').length;

        /*if (!$date.val()) {
            err = 1;
        }*/

        if (err) {
            return false;
        }

        if (ag.length) {
            $(ag).each(function(i, k){
                arr.push($(k).text());
            });
        }
        $('#searchtours-ages').val(arr);
        $('#searchtours-adult').val(a);
        $('#searchtours-child').val(c);
    });

    $(document).on('click', '.search-form__search-btn', function(e){
        //let form = $(this).closest('form');
/*        let ag = $('.passengers-input__age .passengers-input__val');
        let a = $('.passengers-input__content:first .passengers-input__val').text();
        let c = $('.passengers-input__content:last .passengers-input__val').text();
        let arr = [];

        if (ag.length) {
            $(ag).each(function(i, k){
                arr.push($(k).text());
            });
        }
        $('#searchform-ages').val(arr);
        $('#searchform-adult').val(a);
        $('#searchform-child').val(c);*/

    });

    $(document).on('click', '.passengers-input__btn', function(e){
        let v = $(this).parent().find('.passengers-input__val');
        let ma = Number(v.data('max'));
        let mi = Number(v.data('min'));
        let c = Number(v.text());
        let minus = ($(this).hasClass('passengers-input__btn--remove')) ? true : false;
        let mi_btn = $(this).parent().find('.passengers-input__btn--remove');
        let pl_btn = $(this).parent().find('.passengers-input__btn--add');
        let b = $(this).closest('.passengers-input').index();            //childAge(i)
        let age = $(this).closest('.passengers-input__children-ages').length;            //childAge(i)
        let a = 0;
        let arr = [];

        e.stopPropagation();
        e.preventDefault();

        if (minus) {
            --c;
        } else {
            ++c;
        }
        v.text(c);

        v.trigger("change");

        if (c <= mi) {
            mi_btn.prop('disabled', true);
        }
        if (c > (ma - 1)) {
            pl_btn.prop('disabled', true);
        }

        if (c > mi) {
            mi_btn.prop('disabled', false);
        }
        if (c < ma) {
            pl_btn.prop('disabled', false);
        }

        if (b && !age) {
            let l = $('.passengers-input__age').length;
            let ag;

            if (minus) {
                if (c < l) {
                    $('.passengers-input__age:last').remove();
                }
            } else {
                //b = childAge(i);
                $('.passengers-input .passengers-input__children-ages').append(childAge(c));
            }

            /*ag = $('.passengers-input__age .passengers-input__val');
            if (ag.length) {
                $(ag).each(function(i, k){
                    arr.push($(k).text());
                });

            } else {
                $('#searchform-ages').val('');
            }
            console.log(ag);*/
        }

        /*if (!b) {
            $('#searchform-adult').val(c);
        } else {
            $('#searchform-child').val(c);
        }
        $('#searchform-ages').val(arr);*/

        let ad = Number($('.passengers-input__content:first .passengers-input__val').text());
        let ch = Number($('.passengers-input__content:last .passengers-input__val').text());
        let st = '';

        if (ch) {
            st = [ad, ch].join(' + ');
        } else {
            st = ad;
        }
        $('#show-tab').text(st);
    });

    $(document).on('click', '#show-tab', function(e){
        let p = $(this).text().split(' + ');
        let b;
        let co = $('.passengers-input__content');
        let mi_a = $('.passengers-input__content:first .passengers-input__val').data('min') + 0;
        let mi_c = $('.passengers-input__content:last .passengers-input__val').data('min') + 0;
        let ma_a = $('.passengers-input__content:first .passengers-input__val').data('max') + 0;
        let ma_c = $('.passengers-input__content:last .passengers-input__val').data('max') + 0;
        let da;

        e.stopPropagation();
        //console.log(p.split(' + '));

        if (!$('.passengers-selection__dropdown').is(":visible")) {


        $('.passengers-selection__dropdown').show();

        $('.passengers-input__content .passengers-input__btn').prop('disabled', false);

        if (p) {
            $(p).each(function(i, k){

                da = co.eq(i).find('.passengers-input__val');

                if ((da.data('min') + 0) >= k) {
                    console.log('I0 = '+i+' K0 = '+k+' '+(da.data('min') + 0)+' '+(da.data('max') + 0));
                    da.prev().prop('disabled', true);
                    console.log('I1 = '+i+' remove = true');
                } else {
                    console.log('I0 = '+i+' K0 = '+k+' '+(da.data('min') + 0)+' '+(da.data('max') + 0));
                    da.prev().prop('disabled', false);
                    console.log('I1 = '+i+' remove = false');
                }
                if (k >= (da.data('max') + 0)) {
                    console.log('I1 = '+i+' K1 = '+k+' '+(da.data('min') + 0)+' '+(da.data('max') + 0));
                    da.next().prop('disabled', true);
                    console.log('I1 = '+i+' add = true');
                } else {
                    console.log('I1 = '+i+' K1 = '+k+' '+(da.data('min') + 0)+' '+(da.data('max') + 0));
                    console.log('I1 = '+i+' add = false');
                    da.next().prop('disabled', false);
                }
            });
        }

        if (!p[1]) {
            $('.passengers-input__content:last .passengers-input__btn--remove').prop('disabled', true);
        }

        $('.passengers-input__content:first .passengers-input__val').text(p[0]);
        $('.passengers-input__content:last .passengers-input__val').text(p[1]);

        if (!p[1]) {
            $('.passengers-input .passengers-input__children-ages').html('');
            //$('.passengers-input__content:last .passengers-input__btn--remove').prop('disabled', true);
        } else {
            $('.passengers-input .passengers-input__children-ages').html('');
            for (i=1; i<=p[1]; i++) {
                b = childAge(i);
                $('.passengers-input .passengers-input__children-ages').append(b);
            }
        }


                console.log('form InnerHeight '+$('#search-form').innerHeight());
                console.log('form OfsetTop = '+$('#search-form').offset().top);
                console.log('window InnerHeight = '+(window.innerHeight / 2));
                console.log('position = '+($('#search-form').offset().top - window.innerHeight / 2 + $('#search-form').innerHeight() / 2));
  //scrollTo(100, $('#search-form').offset().top - window.innerHeight / 2 + $('#search-form').innerHeight() / 2);

        } else {
            $('.passengers-selection__dropdown').hide();
        }
    });

    $(document).mousedown(function(e) {
        if ($(e.target).attr('id') == 'show-tab')
          return false;

        let container = $(".passengers-selection__dropdown");
        if (container.has(e.target).length === 0 && $(".passengers-selection__dropdown").has(e.target).length === 0) {$('.passengers-selection__dropdown').hide();}
    });

    $(document).on('click', '.tour-card__img', function(e){
        let u = $(this).closest('.tour-card').find('.tour-card__link:first').attr('href');
        //window.location.href = u;
        console.log(u);
    });

    $(document).on('change', '#chuse-country', function(e){
        $(this).closest('form').submit();
        //return false;
    });

    /*$(document).on('change', '#searchticket-country_id', function(e){
        let id = $(this).val();
        let options = {};
        options.url = $(this).data('url');
        options.container = $(this).data('pjax-container');
        options.replace = false;
        $.pjax.reload(options);
    });*/

    //$(function(){
        fp = $(".flatpickr").flatpickr($fp_options);
        if (!date_from)
          getSpecification($('#search-form'), fp);
        //fp.set('dateFormat', "Y-m-d");
        //fp.set('formatDate', 'Y-m-d');
        //fp.set('dateFormat', 'U');
        //fp.set('defaultDate', date_from);
        //fp.set('currentDate', date_from);
        //fp.set('dateFormat', 'U');
        //console.log(fp);
    //});

    $(document).on('click', '.search-form__datepicker .input-field__inner1', function(e){
        e.stopPropagation();
        //$('#searchform-date_from').click();
        //$('#searchform-date_from').flatpickr('options', 'open');
        //fp.open();
        /*var fp = flatpickr("#searchform-date_from", {'appendTo': '.search-form__datepicker .field-searchform-date_from'});
        //fp. = flatpickr("#searchform-date_from");
        fp.open();
        //console.log(flatpickr("#searchform-date_from", {'open': true}));
        console.log('ffffffff');*/

        var fp = $("#searchform-date_from").flatpickr({'appendTo': '.search-form__datepicker'});
        fp.open();
    });

    $('#modal-order').on('hide.bs.modal', function(){
        let form = $(this).find('form');
        form.find('input[type=text]').val('');
        form.find('input[type=checkbox]').prop('checked', false);
        form.find('textarea').val('');
        form.find('.is-valid').removeClass('is-valid');
        form.find('.is-invalid').removeClass('is-invalid');
        form.find('.form-result span').hide();
        //$('#modal-order form select').val('0');
    });

    $('#modal-order').on('show.bs.modal', function(){

    });

    $(document).on('submit', 'form', function(){
        $(this).find('.form-result span').hide();
    });

    $(document).on('submit', '#modal-order form', function(){
        addOrder($(this));
        return false;
    });

    $(document).on('click', '.tour-line__link', function(){
        let id = $(this).data('id');
        $('#orderform-tour_id').val(id);
        $('#modal-order').modal('show');
        return false;
    });

    $(document).on('click', '.view__item', function(){
        let l = 'grid';
        let bl = $('.body-content');
        let p = $(this).parent();

        if ($(this).index() == 1) {
            if (p.hasClass('view--lines'))
              return false;

            p.removeClass('view--tiles').addClass('view--lines');
            l = 'list';
        } else {
            if (p.hasClass('view--tiles'))
              return false;
            p.removeClass('view--lines').addClass('view--tiles');
        }
        $('#tour-cards > div').data('item', l).attr('data-item', l);
        Cookies.set('item', l);

        setTimeout(function(){
          $('html, body').animate({scrollTop: bl.offset().top}, 'slow', 'linear');
        }, 200);
    });
});

function setCardView()
{
    /*$.ajax({
        url: 'set-view',
    })*/
}

function addOrder(form)
{
    $.ajax({
        url: form.attr('action'),
        type: 'post',
        dataType: 'json',
        data: form.serialize(),
        error: function(response){console.log(response);},
        success: function(response){
            form.find('.form-result .'+response.status).fadeIn();
            if (response.status == 'success') {
                setTimeout(function(){
                    form.closest('.modal').modal('hide');
                }, 4000);
            } else {
            }
        },
    });
}

function getNights(form)
{
    $.ajax({
        url: '/tours/nights',
        type: 'post',
        dataType: 'html',
        data: form.serialize(),
        error: function(response){console.log(response);},
        success: function(response){
            $('.search-form__nights').replaceWith(response);
            $('.search-form__nights .input-field--disabled').removeClass('.input-field--disabled');
        },
    });
}

function getSpecification(form, fp)
{
    fp.clear();
    $.ajax({
        url: form.data('url'),
        type: 'post',
        dataType: 'json',
        data: form.serialize(),
        error: function(response){console.log(response);},
        success: function(response){
            let err = 0;
            $('.calendar-min-price-css').remove();

            if (response.date) {
                for (var key in response.price) {
                    $('.event-'+key).text(response.price[key]);
                    console.log('.event-'+key);
                    console.log(response.price[key]);
                    /*console.log(key);
                    console.log(response.price[key]);*/
                    //st += '<span class="ffpp" id="fld-'+key+'">'+response.price[key]+'</span>';
        document.head.insertAdjacentHTML('beforeend', '<style class="calendar-min-price-css">.flatpickr-day:not(.flatpickr-disabled) .calendar-min-price.calendar-min-price-'+key+':after{content: "'+response.price[key]+' €";} </style>');
        //let div = document.getElementById('id');
        //div.classList.add('calendar-min-price');
                }
               /* let st = '';
                console.log($(response.price));
                window.dSearchData = response.price;
                for (var key in response.price) {
                    /*console.log(key);
                    console.log(response.price[key]);* /
                    st += '<span class="ffpp" id="fld-'+key+'">'+response.price[key]+'</span>';
                }
                /*response.price.forEach(function(i, k){
                    console.log(i);
                    console.log(k);


                });* /
                $('#flat-dat').html(st);*/

                $('.search-form__datepicker').removeClass('.input-field--disabled');
                //setTimeout(function(){
                //fp.set('disabled', true);
                fp.set('dateFormat', "Y-m-d");
                fp.set('enable', response.date);
                fp.set('dateFormat', 'U');
                fp.jumpToDate();
                //}, 3000);

            //fp.set('onDayCreate', function(dObj, dStr, fp, dayElem){
            /*fp.onDayCreate = function(dObj, dStr, fp, dayElem){
                // Utilize dayElem.dateObj, which is the corresponding Date
                //console.log(dObj);
                console.log(dStr);
                //console.log(fp);
                //console.log(dayElem);

            };*/
                //fp.set('dateFormat', 'U');

            } else {
                $('.search-form__datepicker').addClass('.input-field--disabled');
                fp.set('disabled', true);
            }

            if (response.people) {
                let p = $('#show-tab').text().split(' + ');
                $('.passengers-input__inner:first .passengers-input__val').data('max', response.people.Adult).attr('data-max', response.people.Adult);
                $('.passengers-input__inner:last .passengers-input__val').data('max', response.people.Child).attr('data-max', response.people.Child);

                if (p[0] && p[0] > response.people.Adult) {
                    err = 1;
                }
                if (p[1] && p[1] > response.people.Child) {
                    err = 1;
                }
                if (err)
                  $('#show-tab').closest('.input-field').addClass('has-error');
                else
                  $('#show-tab').closest('.input-field').removeClass('has-error');
            }

            if (response.regions)
              $('.input-field.search-form__regions').replaceWith(response.regions);


        },
    });
}

function scrollTo(duration, position) {
	if(duration <= 0) duration = 1;
  var beginPosition = window.pageYOffset,
    step = position / duration,
    scrollInterval = setInterval(function () {
      if (beginPosition < position) {
      	beginPosition += step;
        if(beginPosition > position) beginPosition = position;
        window.scroll(0, beginPosition);
      }else if(beginPosition > position){
      	beginPosition -= step;
        if(beginPosition < position) beginPosition = position;
      	window.scroll(0, beginPosition);
      } else clearInterval(scrollInterval);
    }, 1);
}

    function updateDatePickerCells(dp, reloadData) {
        var charter = $('.charter-select').val();
        var requestUrl = $('.search-form').attr('data-request-url');
        if (reloadData == true || typeof window.dSearchData === 'undefined' || window.dSearchData.length < 1) {
            $.ajax({
                url: requestUrl,
                type: 'POST',
                dataType: 'json',
                data: {
                    dynamicSearchDates: true,
                    charter: charter
                },
            }).done(function(response) {
                updateDatePickerCellsCallback(dp, response);
            }).fail(function() {}).always(function() {});
        } else {
            updateDatePickerCellsCallback(dp, window.dSearchData);
        }
    }
    function updateDatePickerCellsCallback(dp, dynamicSearchDates) {
        window.dSearchData = dynamicSearchDates;
        setTimeout(function() {
            var monthVal = dp.drawYear + '.' + (dp.drawMonth + 1);
            if (dp.input.hasClass('charter-search-departure') && $('.charter-select').length && $('.charter-select').find('option:selected').attr('data-charter-link') !== 'visi') {
                $('.ui-datepicker.ui-cb-datepicker td > *').each(function(idx, elem) {
                    $(this).closest('td').addClass('ui-datepicker-unselectable ui-state-disabled');
                });
            }
            if (typeof dynamicSearchDates != 'undefined' && typeof dynamicSearchDates[monthVal] != 'undefined') {
                var cellContents = dynamicSearchDates[monthVal];
                $('.ui-datepicker.ui-cb-datepicker td.ui-state-price-available').each(function() {
                    $(this).removeClass('ui-state-price-available');
                });
                $('.ui-datepicker.ui-cb-datepicker td > *').each(function(idx, elem) {
                    var value = cellContents[idx + 1] || 0;
                    var className = 'datepicker-content-' + value;
                    if (value != 0) {
                        addCSSRule('.ui-datepicker.ui-cb-datepicker td.ui-state-price-available a.' + className + '::after {content: "' + value + '€";}');
                        $(this).closest('td').addClass('ui-state-price-available');
                        if (dp.input.hasClass('charter-search-departure')) {
                            $(this).closest('td').removeClass('ui-datepicker-unselectable ui-state-disabled');
                        }
                    }
                    $(this).addClass(className)
                });
            }
        }, 0);
    }

function childAge(i)
{
    let b = '\
    <div class="passengers-input passengers-input__age">\
        <div class="passengers-input__age-wrap">\
            <p class="passengers-input__age-title">'+i+' Child age:</p>\
            <div class="passengers-input__inner passengers-input__age-inner">\
                <button type="button" class="passengers-input__btn passengers-input__btn--remove"></button>\
                <span class="passengers-input__val" data-min="0" data-max="15">6</span>\
                <button type="button" class="passengers-input__btn passengers-input__btn--add"></button>\
            </div>\
        </div>\
    </div>';
    return b;
}

function timeConverter(UNIX_timestamp){
  var a = new Date(UNIX_timestamp * 1000);
  var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
  var year = a.getFullYear();
  var month = months[a.getMonth()];
  var date = a.getDate();
  var hour = a.getHours();
  var min = a.getMinutes();
  var sec = a.getSeconds();
  var time = year + '-' + month + '-' + date;
  return time;
}