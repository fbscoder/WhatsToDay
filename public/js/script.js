function binder() {
    $("#tasks").addClass("show");

    $("#tasks").bind('transitionend webkitTransitionEnd oTransitionEnd otransitionend MSTransitionEnd',
        function () {
            $("#tasks").css({'white-space': "normal"});
            $("#tasks").css({'overflow': "visible"});
            $("#tasks").unbind("transitionend webkitTransitionEnd oTransitionEnd otransitionend MSTransitionEnd");
        });
}

$(document).ready(function () {
    $("#hideTasks").click(function () {
        $("#tasks").css({'overflow': "hidden"});
        $("#tasks").css({'white-space': "nowrap"});
        $("#tasks").removeClass("show");
    });
    $("#btn_today").click(function () {
        $("#task_tomorrow").css({'display': "none"});
        $("#task_today").css({'display': "block"});
        binder();
    });
    $("#btn_tomorrow").click(function () {
        $("#task_today").css({'display': "none"});
        $("#task_tomorrow").css({'display': "block"});
        binder();
    });
});