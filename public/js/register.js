$(document).ready(function () {

    //ERROR Text
    if (localStorage.getItem("register") !== null) {
        $("#alertLogin").text(localStorage.getItem("register"));
        $("#alertLogin").removeClass("hidden");
        localStorage.clear();
    }

    //User API-Token accepted
    authenticationSuccess = function () {
        $("#alertLogin").addClass("hidden");
        $("#token").val(localStorage.getItem("trello_token"));
        localStorage.clear();
    };

    //User API-Token denied
    authenticationFailure = function () {
        //ERROR token wurde nicht angenommen
        $("#alertLogin").text("Sie haben abgelehnt den Token zu generieren!");
        $("#alertLogin").removeClass("hidden");
    };

    //Token click open Trello window to get the token
    $("#token").click(function () {
        window.Trello.authorize({
            type: 'popup',
            name: 'Getting Started Application',
            scope: {
                read: 'true',
                write: 'true'
            },
            expiration: 'never',
            success: authenticationSuccess,
            error: authenticationFailure
        });
    });

})
;