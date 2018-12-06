$(document).ready(function () {
    $("#hideTasks").click(function () {
        $(".timeButtons").css({'display': 'block'});
        $('#tasks').animate({
            'margin-right': '100%',
        }, {
            duration: 1000,
            start: function () {
                $("#tasks").css({'overflow': "hidden"});
                $("#tasks").css({'height': "100%"});
            },
            complete: function () {
                $("#tasks").css({'overflow': "hidden"});
                $('#xpullButtonsDiv').css({'display': "block"});
            }
        });
    });
    $("#btn_today").click(function () {
        $('#xpullButtonsDiv').css({'display': "none"});
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
                $(".timeButtons").css({'display': 'none'});
                $("#tasks").css({'height': "0"});
            }
        });
    });
    $("#btn_tomorrow").click(function () {
        $('#xpullButtonsDiv').css({'display': "none"});

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
                $(".timeButtons").css({'display': 'none'});
                $("#tasks").css({'height': "0"});
            }
        });
    });

    // Init xpull plugin for demo
    $('#xpullTask').xpull({
        'callback': function () {
            location.reload();
            console.log('Released...');
        }
    });
    $('#xpullButtons').xpull({
        'callback': function () {
            location.reload();
            console.log('Released...');
        }
    });

});