$(document).ready(function () {
    if (sessionStorage.getItem('reloadSite') !== null) {
        if (sessionStorage.getItem('reloadSite') === 'today') {
            $("#task_tomorrow").css({'display': "none"});
            $("#task_today").css({'display': "block"});
        } else {
            $("#task_today").css({'display': "none"});
            $("#task_tomorrow").css({'display': "block"});
        }
        $("#tasks").css({'overflow': "visible"});
        $("#tasks").css({'margin-right': "0"});
        $("#tasks").css({'height': "0"});
        $(".timeButtons").css({'display': 'none'});
        sessionStorage.clear();
    }

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
            }
        });
    });
    $("#btn_today").click(function () {
        // $('#xpullTaskToday').css({'display': "none"});
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
        // $('#xpullTaskTomorrow').css({'display': "none"});

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
            sessionStorage.setItem('reloadSite', 'today');
            location.reload();
        }
    });
    $('#task_tomorrow').xpull({
        'callback': function () {
            sessionStorage.setItem('reloadSite', 'tomorrow');
            location.reload();
        }
    });
    $('.timeButtons').xpull({
        'callback': function () {
            location.reload();
        }
    });
});