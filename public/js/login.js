$(document).ready(function () {
    if (sessionStorage.getItem('login') !== null) {
        $('#alertLogin').removeClass('hidden');
        sessionStorage.clear()
    }
});