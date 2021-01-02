$('#duration').on('change', function () {
    if (this.value != null) {
        switch (this.value) {
            case '00:15:00':
                $('#question-per-set').empty();
                $('#question-per-set').append(`
                    <option selected></option>
                    <option value="10">10 questions</option>
                    <option value="12">12 questions</option>
                    <option value="15">15 questions</option>
                `);
                break;
            case '00:45:00':
                $('#question-per-set').empty();
                $('#question-per-set').append(`
                    <option selected></option>
                    <option value="30">30 questions</option>
                    <option value="45">45 questions</option>
                `);
                break;
            case '01:30:00':
                $('#question-per-set').empty();
                $('#question-per-set').append(`
                    <option selected></option>
                    <option value="60">60 questions</option>
                    <option value="90">90 questions</option>
                `);
                break;
            default:
                $('#question-per-set').empty();
                break;
        }
    }
});
