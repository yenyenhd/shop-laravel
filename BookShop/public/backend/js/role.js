$(function(){
    $('.checkbox_wrapper').on('click', function() {
        $(this).parents('.card').find('.checkbox_children').prop('checked', $(this).prop('checked'));
     });
    
     $('.check_all').on('click', function(){
         $(this).parents().find('.checkbox_children').prop('checked', $(this).prop('checked'))
         $(this).parents().find('.checkbox_wrapper').prop('checked', $(this).prop('checked'))

     })
})
