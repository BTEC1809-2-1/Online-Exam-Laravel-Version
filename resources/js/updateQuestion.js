$(document).ready(function(){

    $(function(){
        $('#edit').one('click' ,function(e) {
            e.preventDefault();
            $(this).html() == "Edit"
            ? updateOn()
            : submitUpdate();
        });
    });

    var is_correct = null;

    function updateOn() {

        $('#edit').parent().css('display','none');
        $('#update').show();

        $('#difficult').append(`
            <select class="form-control" name="level_of_difficult" required>
                <option value="1">Normal</option>
                <option value="2">Medium</option>
                <option value="3">Hard</option>
            </select> `);
        $('#difficult').children('input').remove();

        var question_type = $('#type').val();
        console.log(question_type);

        if ( (question_type == 'Single Choice 4')
            ||
            (question_type == 'True False')) {
            is_correct = 0;
        } else {
            is_correct = [
                ($('#1').children().val() == 'Correct') ? 1 : 0,
                ($('#2').children().val() == 'Correct') ? 1 : 0,
                ($('#3').children().val() == 'Correct') ? 1 : 0,
                ($('#4').children().val() == 'Correct') ? 1 : 0
            ];
        }

        console.log(is_correct);

        var old_select_index = 1;
        $('.is_correct').empty();
        $('.is_correct').each( function(index){

            $(this).append(`
                <select class="form-control" id="select_is_correct`+index+`" required>
                    <option selected value="0"></option>
                    <option value="0">Not Correct</option>
                    <option value="1">Correct</option>
                </select>`);

            $('#select_is_correct' + index).on('change', function(){

                if( question_type == 'Single Choice 4'
                    ||
                    question_type == 'True False') {

                    if($(this).children('option:selected').val() == 1 ){
                        $('[id^=select_is_correct').not($(this)).val(0).change();
                        is_correct = ($(this).parent().attr('id'));
                    }

                } else {
                    is_correct[index] = "0";
                    if($(this).children('option:selected').val() == 1 ){
                        is_correct[index] = String($(this).parent().attr('id'));
                    } else {
                        is_correct[index] = "0";
                    }
                }
                console.log(is_correct);
                old_select_index = index;
            });
        });
        $(".editable").prop('readonly', false);
    }

    $('#submitUpdate').on('click', function(){
        $('#form').append(`<input type="hidden" name="is_correct" value="`+is_correct+`">`);
        $('#form').submit();
    })
});
