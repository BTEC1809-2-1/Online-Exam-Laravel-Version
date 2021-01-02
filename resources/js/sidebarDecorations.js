$(document).ready(function() {
    let toggleExamManagementClicked = false;
    let toggleQuestionManagementClicked = false;

    $('#toggleExamManagement').on('click', function() {
        toggleExamManagementClicked  = !toggleExamManagementClicked;

        if(toggleExamManagementClicked){
            $(this).css( {
                'background-color':'#f58742',
                'border-radius':'15px'
            });
        } else {
            $(this).css( {
                'background-color':'white',
                'border-radius':'15px'
            });
        }
    });

    $('#toggleQuestionManagement').on('click', function() {
        toggleQuestionManagementClicked  = !toggleQuestionManagementClicked;

        if(toggleQuestionManagementClicked){
            $(this).css( {
                'background-color':'#f58742',
                'border-radius':'15px'
            });
        } else {
            $(this).css( {
                'background-color':'white',
                'border-radius':'15px'
            });
        }

    });

    if (window.location.href.indexOf("Question/Create") > -1) {
        $('#questionManagement').show();
        $('#questionCreate').css ({
            'background-color':'#5eb44b',
            'border-radius':'5px',
            'color':'white'
        });
    }

    if (window.location.href.indexOf("Question/List") > -1) {
        $('#questionManagement').show();
        $('#questionList').css ({
            'background-color':'#5eb44b',
            'border-radius':'5px',
            'color': 'white'
        });
    }

    if (window.location.href.indexOf("Exam/Create") > -1) {
        $('#examManagement').show();
        $('#examCreate').css ({
            'background-color': '#5eb44b',
            'border-radius':'5px',
            'color':'white'
        });
    }

    if (window.location.href.indexOf("Exam/List") > -1) {
        $('#examManagement').show();
        $('#examList').css( {
            'background-color':'#5eb44b',
            'border-radius':'10px',
            'color':'white'
        });
    }
});
