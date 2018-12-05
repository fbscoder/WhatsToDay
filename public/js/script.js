$(document).ready(function () {
    $("#hideTasks").click(function () {
        $('#tasks').animate({
            'margin-right': '100%',
        }, {
            duration: 1000,
            start: function () {
                $("#tasks").css({'overflow': "hidden"});
            },
            complete: function () {
                $("#tasks").css({'overflow': "hidden"});
            }
        });
        $('#xpullButtonsDiv').css({'display': "block"});
    });
    $("#btn_today").click(function () {
        $('#tasks').animate({
            'margin-right': '0',
        }, {
            duration: 1000,
            start: function () {
                $("#task_tomorrow").css({'display': "none"});
                $("#task_today").css({'display': "block"});
            },
            complete: function () {
                $("#tasks").css({'overflow': "visible"});
            }
        });
        $('#xpullButtonsDiv').css({'display': "none"});
    });
    $("#btn_tomorrow").click(function () {

        $('#tasks').animate({
            'margin-right': '0',
        }, {
            duration: 1000,
            start: function () {
                $("#task_today").css({'display': "none"});
                $("#task_tomorrow").css({'display': "block"});
            },
            complete: function () {
                $("#tasks").css({'overflow': "visible"});
            }
        });
        $('#xpullButtonsDiv').css({'display': "none"});
    });


});