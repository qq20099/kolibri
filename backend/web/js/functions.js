var delimg = '';

$(document).ready(function(){

    $(function(){
        refreshOverlay();
        $('.opacity0').removeClass('opacity0');
    });

    $(document).on('click', '#clear-cache a', function(e){
        return false;
    });

    $(document).on('change', '#add-images', function(e){
      //$(this).closest('form').submit();
        let formData = new FormData();
        let files = this.files;
        let form = $(this).closest('form');

        showLoader($('.gallery'));
        form.find('button[type=submit]').prop('disabled', true);

        for (var i=0; i<files.length; i++) {
            formData.append('files[]', files[i]);
        }

        $('.uploads-error').fadeOut(function(){
            this.remove();

        });

        $.ajax({
            type: 'post',
            url: 'uploads',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            complete: function() {
                setTimeout(function(){
                    form.find('button[type=submit]').prop('disabled', false);
                    hideLoader($('.gallery'));
                    refreshOverlay(false);
                    let c = $('.img-wrapper.coraltravelhotel').length;
                    $('.gallery-count').text(c);
                }, 200);
            },
            success: function(response) {
                $('.gallery').append(response);

                if (response.status == 'success') {
                    //img.attr('src', response.file);
                    //$('#add-images').parent().hide();
                    //$('#delete-img').show();
                    //$('.image-value').val(response.filename);
                } else {
                    //alert(response.msg);
                }

            }
        })
        e.preventDefault();

        return false;
    });

    $(document).on('submit', 'form', function(){
        if ($('.del-image-value').length) {
            $('.del-image-value').val(delimg);
        }
    });

    $(document).on('click', '#show-gallery', function(){
        $(this).toggleClass('active');
        if ($(this).hasClass('active')) {
            $('.gallery').fadeIn(function(){
                $(this).addClass('active');
            });
        } else {
            $('.gallery').fadeOut(function(){
                $(this).removeClass('active');
            });
        }
    });

    $(document).on('click', '.uncheck-btn', function(){
        let mainimg = $('#main-image');

        showLoader(mainimg.parent());
        setTimeout(function(){
            mainimg.parent().addClass('selected');
            hideLoader(mainimg.parent());
        }, 250);
        
        $(this).closest('.mainimg-wrapper').removeClass('selected');
        $('.img-wrapper.coraltravelhotel').removeClass('main--img');
        $('.img-wrapper.coraltravelhotel .btn').prop('disabled', false);
        $('#coraltravelhotel-m_img').val('');
        mainimg.attr('src', mainimg.data('default'));
    });

    $(document).on('click', '.check-btn', function(){
        let t = $(this).closest('.img-wrapper');
        let id = t.data('id');
        let src = t.find('img').attr('src');

        $('#coraltravelhotel-m_img').val(src);
        //$('.img-wrapper-'+id+' .btn').prop('disabled', true);
        showLoader(t);
        showLoader($('#main-image').parent());
        setTimeout(function(){
            $('#main-image').attr('src', src);
            $('#main-image').parent().addClass('selected');
            hideLoader(t);
            hideLoader($('#main-image').parent());
            $('.img-wrapper.coraltravelhotel').removeClass('main--img');
            $('.img-wrapper.coraltravelhotel .btn').prop('disabled', false);
            //$('.img-wrapper.coraltravelhotel .btn').prop('disabled', false);
            t.find('.check-btn').prop('disabled', true);
            t.addClass('main--img');
            refreshOverlay(true);
        }, 300);
        //setMain(id);
    });

    $(document).on('click', '.delete-btn', function(){
        let ite = $(this).closest('.img-wrapper');
        let src = ite.find('img').attr('src');
        let id = ite.data('id');
        let mainimg = $('#main-image');

        if (!confirm('Хотите удалить изображение?'))
          return false;

        if (ite.hasClass('main--img')) {
            mainimg.attr('src', mainimg.data('default'));
            $('#coraltravelhotel-m_img').val('');
        }

        addDelImg(src);
        ite.remove();
        refreshOverlay(false);
        let c = $('.img-wrapper.coraltravelhotel').length;
        $('.gallery-count').text(c);
    });

    $(document).on('change', '#pages-menu', function(){
        if ($(this).prop('checked'))
          $('.in-menu').show();
        else
          $('.in-menu').hide();
    });

    $(document).on('click', '#delete-img', function(){
        let img = $(this).parent().find('img');
        let delimg = $('.del-image-value').val();

        if (!delimg) {
            delimg = img.attr('src');
        } else {
            delimg += '|'+img.attr('src');
        }
        $(this).hide();
        $('#upload-img').parent().fadeIn();
        img.attr('src', '../images/no-img.jpg');
        img.attr('alt', '');
        $('.image-value').val('');
        $('.del-image-value').val(delimg);
    });

});

function setMain(id)
{

    $.ajax({
        url: '/admin/hotel/set-main',
        type: 'post',
        dataType: 'json',
        data: {
            id: id,
        },
        complete: function(){
            hideLoader($('.img-wrapper-'+id));
        },
        error: function(response){
            $('.img-wrapper-'+id+' .btn').prop('disabled', false);
        },
        success: function(response){
            if (response.status == 'success') {
                $('.img-wrapper .btn').prop('disabled', false);
                $('.img-wrapper-'+id+' .btn').prop('disabled', true);
                /*$('.img-wrapper .check-btn').show();
                $('.img-wrapper-'+id+' .check-btn').hide();*/
            } else {
                $('.img-wrapper-'+id+' .btn').prop('disabled', false);
            }
            console.log(response);
        },
    });
}

function showLoader(el)
{
    var loader = '<div class="wpv-splash-screen"><div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div>';
    el.find('.wpv-splash-screen').remove();
    el.append(loader);
}

function hideLoader(el)
{
    if (el)
      el.find('.wpv-splash-screen').remove();
}

function addDelImg(src)
{
    if (!delimg)
      delimg = src;
    else
      delimg += '|'+src;
}

function refreshOverlay(refreshMain)
{
    setTimeout(function(){
        let ite = $('.img-wrapper.coraltravelhotel');
        let w_ite;
        let w_im;
        let w;
        let s;

        if (refreshMain)
          ite = $('.mainimg-wrapper');

        if (ite.length) {
            ite.each(function(i, k){
                w_ite = $(k).innerWidth();
                w_im = $(k).find('img').innerWidth();
                s = {
                    width: w_im,
                    left: (w_ite - w_im) / 2,
                };
                $(k).find('.overlay').css(s);
            });
        }


        /*if (refreshMain) {
            ite = $('.mainimg-wrapper');
            if (ite.length) {
                ite.each(function(i, k){
                    console.log(k);
                    w_ite = $(k).innerWidth();
                    w_im = $(k).find('img').innerWidth();
                    s = {
                        width: w_im,
                        left: (w_ite - w_im) / 2,
                    };
                    $(k).find('.overlay').css(s);
                });
            }
        }*/
    }, 150);

}