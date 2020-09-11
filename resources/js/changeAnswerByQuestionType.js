// Controll code: change html component by user's option
$(document).ready(function() {
    $("#questionType").change(function() {
        var selectedValue = $(this)
            .find(":selected")
            .val();
        console.log(selectedValue);
        switch (selectedValue) {
            case "sc4":
                singleChoiceOfFour();
                break;
            case "mc4":
                multipleChoiceOfFour();
                break;
            case "tf":
                trueFalse();
                break;
            default:
                $("#answer-block").empty();
                break;
        }
    });
});
// Component using in answer block
function singleChoiceOfFour() {
    $("#answer-block").empty();
    let html =
        '<div class="form-group">' +
            '<label for"firstAnswer">First Answer</label>' +
            '<input type="text" class="form-control">' +
            '<div class="form-check">' +
                '<input class="form-check-input" type="radio">' +
                '<label class="form-check-label" > is correct </label>' +
            '</div>' +
        '</div>' +

        '<div class="form-group">' +
        '<label for"firstAnswer">Second Answer</label>' +
        '<input type="text" class="form-control">' +
        '<div class="form-check">' +
            '<input class="form-check-input" type="radio">' +
            '<label class="form-check-label" > is correct </label>' +
        '</div>' +
    '</div>' +
    '<div class="form-group">' +
            '<label for"firstAnswer">Third Answer</label>' +
            '<input type="text" class="form-control">' +
            '<div class="form-check">' +
                '<input class="form-check-input" type="radio">' +
                '<label class="form-check-label" > is correct </label>' +
            '</div>' +
        '</div>' +
        '<div class="form-group">' +
            '<label for"firstAnswer">Fourth Answer</label>' +
            '<input type="text" class="form-control">' +
            '<div class="form-check">' +
                '<input class="form-check-input" type="radio">' +
                '<label class="form-check-label" > is correct </label>' +
            '</div>' +
        '</div>';
    $("#answer-block").append(html);
}

function multipleChoiceOfFour() {
    $("#answer-block").empty();
    let html =
        '<div class="form-group">' +
            '<label for"firstAnswer">First Answer</label>' +
            '<input type="text" class="form-control">' +
            '<div class="form-check">' +
                '<input class="form-check-input" type="radio">' +
                '<label class="form-check-label" > is correct </label>' +
            '</div>' +
        '</div>' +

        '<div class="form-group">' +
        '<label for"firstAnswer">Second Answer</label>' +
        '<input type="text" class="form-control">' +
        '<div class="form-check">' +
            '<input class="form-check-input" type="radio">' +
            '<label class="form-check-label" > is correct </label>' +
        '</div>' +
    '</div>' +
    '<div class="form-group">' +
            '<label for"firstAnswer">Third Answer</label>' +
            '<input type="text" class="form-control">' +
            '<div class="form-check">' +
                '<input class="form-check-input" type="radio">' +
                '<label class="form-check-label" > is correct </label>' +
            '</div>' +
        '</div>' +
        '<div class="form-group">' +
            '<label for"firstAnswer">Fourth Answer</label>' +
            '<input type="text" class="form-control">' +
            '<div class="form-check">' +
                '<input class="form-check-input" type="radio">' +
                '<label class="form-check-label" > is correct </label>' +
            '</div>' +
        '</div>';
    $("#answer-block").append(html);
}

function trueFalse(){
    $("#answer-block").empty();
    let html=
        '<div class="form-group">' +
            '<label for"firstAnswer">First Answer</label>' +
            '<input type="text" class="form-control">' +
            '<div class="form-check">' +
                '<input class="form-check-input" type="radio">' +
                '<label class="form-check-label" > Is True </label>' +
            '</div>' +
        '</div>'+
        '<div class="form-group">' +
            '<label for"firstAnswer">Second Answer</label>' +
            '<input type="text" class="form-control">' +
            '<div class="form-check">' +
                '<input class="form-check-input" type="radio">' +
                '<label class="form-check-label" > Is true </label>' +
            '</div>' +
        '</div>';
    $("#answer-block").append(html);
}
