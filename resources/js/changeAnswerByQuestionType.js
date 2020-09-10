$(document).ready(function() {
    $("#questionType").change(function() {
        var selectedValue = $(this)
            .find(":selected")
            .val();
        console.log(selectedValue);
        switch (selectedValue) {
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

function multipleChoiceOfFour() {
    $("#answer-block").empty();
    let html =
        '<input type="text" class="">' +
        '<input type="radio">' + 'is correct' +
        '<input type="text" class="">' +
        '<input type="radio">' + 'is correct' +
        '<input type="text" class="">' +
        '<input type="radio">' + 'is correct' +
        '<input type="text" class="">' +
        '<input type="radio">' + 'is correct';
    $("#answer-block").append(html);
}
