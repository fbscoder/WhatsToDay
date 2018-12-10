$(document).ready(function () {
    $("#changeEmailSubmit").click(function () {
        $("#changeEmailForm").submit();
    });
    $("#changeEmailForm").submit(function (event) {
        event.preventDefault();
        var form_data = $(this).serialize(); //Encode form elements for submission
        $.ajax({
            url: '/changeEmail',
            type: 'post',
            data: form_data,
            success: function (output) {
                var alert = $("#emailAlert");
                alert.attr('class', 'hidden');
                if (output === "success") {
                    alert.addClass('alert alert-success');
                    alert.removeClass('hidden');
                    alert.text("Ihre Email wurde erfolgreich geändert");
                }
                else if (output === "emailNoMatch") {
                    alert.addClass('alert alert-dark warning');
                    alert.removeClass('hidden');
                    alert.text("Ihre alte Email Addresse stimmt nicht überein");
                }
                $("#emailOld").val('');
                $("#emailNew").val('');
            }
        })
    });
    $("#changePasswordSubmit").click(function () {
        $("#changeEmailForm").submit();
    });
    $("#changePasswordForm").submit(function (event) {
        event.preventDefault(); //prevent default action
        var form_data = $(this).serialize(); //Encode form elements for submission

        $.ajax({
            url: '/changePassword',
            type: 'post',
            data: form_data,
            success: function (output) {
                var alert = $("#alert");
                alert.attr('class', 'hidden');
                if (output === "success") {
                    alert.addClass('alert alert-success');
                    alert.removeClass('hidden');
                    alert.text("Ihr Passwort wurde geändert");
                }
                else if (output === "oldPasswordWrong") {
                    alert.addClass('alert alert-dark warning');
                    alert.removeClass('hidden');
                    alert.text("Ihr altes Passwort stimmt nicht mit den eingegebenen Passwort überein.");
                }
                else if (output === "passwordNotMatching") {
                    alert.addClass('alert alert-dark warning');
                    alert.removeClass('hidden');
                    alert.text("Ihr neuen Passwörter stimmen nicht überein!");
                }
                $("#passwordOld").val('');
                $("#passwordNew").val('');
                $("#passwordNewRepeat").val('');
            }
        })
    });
});