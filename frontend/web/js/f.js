$(document).ready(function(){

    $(document).on('click', '.tour-line__link', function(){
        let id = $(this).data('id');
        $('#orderform-tour_id').val(id);
        $('#modal-order').modal('show');
        return false;
    });

});