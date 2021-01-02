$(document).ready(function () {
    $("#search").keyup(function () {
        var query = $(this).val();
        if (query != "") {
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: route,
                method: "POST",
                data: {
                    query: query,
                    _token: _token,
                    variable: variable
                },
                success: function (data) {
                    console.log(data);
                    if (data !== "") {
                        $("#resultList").fadeIn();
                        $("#resultList").css({
                            "background-color": "white"
                        });
                        $("#resultList").html(data);
                    }
                }
            });
        } else {
            $("#resultList").fadeOut();
        }
    });
});
