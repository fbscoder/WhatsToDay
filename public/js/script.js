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
    $('#task_today').xpull({
        'callback': function () {
            sessionStorage.setItem('reloadSite', 'true');
            location.reload();
            window.onload = function () {
                $("#task_tomorrow").css({'display': "none"});
                $("#task_today").css({'display': "block"});
                $("#tasks").css({'overflow': "visible"});
                $(".timeButtons").css({'display': 'none'});
                $("#tasks").css({'height': "0"});
            };
        }
    });
    $('#task_tomorrow').xpull({
        'callback': function () {
            sessionStorage.setItem('reloadSite', 'false');
            location.reload();
            window.onload = function () {
                $("#task_today").css({'display': "none"});
                $("#task_tomorrow").css({'display': "block"});
                $("#tasks").css({'overflow': "visible"});
                $(".timeButtons").css({'display': 'none'});
                $("#tasks").css({'height': "0"});
            };
        }
    });
    $('#xpullButtons').xpull({
        'callback': function () {
            location.reload();
        }
    });
});