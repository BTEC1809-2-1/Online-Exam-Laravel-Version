
$(document).ready(function(){
    $(function(){
        $('#edit').one('click' ,function(e) {
            e.preventDefault();
            $(this).html() == "Edit" ? updateOn() : $('#form').submit();
        });
    });
    function updateOn() {
        $('#edit').parent().css('display','none');
        $('#update').show();
        $(":input").prop('readonly', false);
    }
});
