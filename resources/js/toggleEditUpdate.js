
$(document).ready(function(){
    $(function(){
        $('#edit').click( function(e) {
            e.preventDefault();
            $(this).html() == "Edit" ? play_int() : $('#form').submit();
        });
    });
    function play_int() {
        $('#edit').html("Update");
        $(":input").prop('readonly', false);
    }
});
