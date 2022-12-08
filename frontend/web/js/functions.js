$(document).ready(function(){
    //var fp = flatpickr("#searchform-date_from", {});

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

    $(document).on('click', '[data-v-aa89be5c]', function(e){
        e.stopPropagation();
        //$('#searchform-date_from').click();
        //$('#searchform-date_from').flatpickr('options', 'open');
        //fp.open();
        const fp = flatpickr("#searchform-date_from", {'appendTo': '.search-form__datepicker .field-searchform-date_from'});
        //fp. = flatpickr("#searchform-date_from");
        fp.open();
        //console.log(flatpickr("#searchform-date_from", {'open': true}));
        console.log('ffffffff');
    });

    $('#modal-order').on('hide.bs.modal', function(){
        let form = $(this).find('form');
        form.find('input').val('');
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