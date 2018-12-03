$(document).ready(function () {
    $("#hideTasks").click(function () {
        $("#tasks").css({'overflow': "hidden"});
        $("#tasks").removeClass("show");
    });
    $("#btn_today").click(function () {
        $("#task_tomorrow").css({'display': "none"});
        $("#task_today").css({'display': "block"});
        $("#tasks").addClass("show");

        $("#tasks").css({'overflow': "visible"});
    });
    $("#btn_tomorrow").click(function () {
        $("#task_today").css({'display': "none"});
        $("#task_tomorrow").css({'display': "block"});
        $("#tasks").addClass("show");

        $("#tasks").css({'overflow': "visible"});
    });
});