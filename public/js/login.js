$(document).ready(function () {
    if (sessionStorage.getItem('login') !== null) {
        $('#alertLogin').removeClass('hidden');
        $('#email').val(sessionStorage.getItem('login'));
        sessionStorage.clear()
    }
});