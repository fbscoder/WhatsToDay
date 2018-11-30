$(document).ready(function () {
    $("#hideTasks").click(function () {
        $("#tasks").removeClass("show");
    });
    $("#btn_today").click(function () {
        document.getElementById("task_tomorrow").style.display = "none";
        document.getElementById("task_today").style.display = "block";
        $("#tasks").addClass("show");
    });
    $("#btn_tomorrow").click(function () {
        document.getElementById("task_today").style.display = "none";
        document.getElementById("task_tomorrow").style.display = "block";
        $("#tasks").addClass("show");
    });
});