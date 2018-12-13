$(document).ready(function () {

    /**
     * Sticky Form (email, question, answer)
     */
    if (localStorage.getItem('email') !== null)
        $("#email").val(localStorage.getItem('email'));
    if (localStorage.getItem('question') !== null)
        $('#question option[value="' + localStorage.getItem("question") + '"]').attr("selected", "selected");
    if (localStorage.getItem('answer') !== null)
        $("#answer").val(localStorage.getItem('answer'));

    /**
     * Show error on wrong input
     */
    if (localStorage.getItem("register") !== null) {
        $("#alertLogin").text(localStorage.getItem("register"));
        $("#alertLogin").removeClass("hidden");
        localStorage.clear();
    }

    /**
     * Get Token if user accept it
     */
    authenticationSuccess = function () {
        $("#alertLogin").addClass("hidden");
        $("#token").val(localStorage.getItem("trello_token"));
        localStorage.clear();
    };

    /**
     * Show error if user denied it
     */
    authenticationFailure = function () {
        //ERROR token wurde nicht angenommen
        $("#alertLogin").text("Sie haben den Token nicht akzeptiert!");
        $("#alertLogin").removeClass("hidden");
    };

    /**
     * Open Trello window to get the Trello token
     */
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
});