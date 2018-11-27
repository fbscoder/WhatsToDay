function hideTasks() {
    document.getElementsByClassName('timeButtons')[0].style.display = "block";
    document.getElementsByClassName('hide_tasks')[0].style.display = "block";
    document.getElementsByClassName('hide_tasks')[0].style.display = "none";

}

function showTomorrow() {
    document.getElementsByClassName('timeButtons')[0].style.display = "none";
    document.getElementById("task_today").style.display = "none";
    document.getElementById('task_tomorrow').style.display = "block";
    document.getElementsByClassName('hide_tasks')[0].style.display = "block";
}

function showToday() {
    document.getElementsByClassName('timeButtons')[0].style.display = "none";
    document.getElementById('task_tomorrow').style.display = "none";
    document.getElementById("task_today").style.display = "block";
    document.getElementsByClassName('hide_tasks')[0].style.display = "block";

}

$(document).ready(function () {
    $("#hideTasks").click(function () {
        hideTasks();
    });
    $("#btn_today").click(function () {
        showToday();
    });
    $("#btn_tomorrow").click(function () {
        showTomorrow();
    });
});