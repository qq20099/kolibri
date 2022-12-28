$(document).ready(function(){

    $(document).on('change', '#pages-menu', function(){
        if ($(this).prop('checked'))
          $('.in-menu').show();
        else
          $('.in-menu').hide();
    });


});