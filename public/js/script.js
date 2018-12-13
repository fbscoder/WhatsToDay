$(document).ready(function () {
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
                    alert.text("Ihre E-Mail Adresse ist nicht hinterlegt!");
                }
                $("#emailOld").val('');
                $("#emailNew").val('');
            }
        })
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
                    alert.text("Ihr Passwort wurde geändert!");
                }
                else if (output === "oldPasswordWrong") {
                    alert.addClass('alert alert-dark warning');
                    alert.removeClass('hidden');
                    alert.text("Ihr altes Passwort stimmt nicht!");

                    $("#passwordOld").val('');
                }
                else if (output === "passwordNotMatching") {
                    alert.addClass('alert alert-dark warning');
                    alert.removeClass('hidden');
                    alert.text("Ihren neuen Passwörter stimmen nicht überein!");

                    $("#passwordNew").val('');
                    $("#passwordNewRepeat").val('');

                }
                else if (output === "allPasswordsWrong") {
                    alert.addClass('alert alert-dark warning');
                    alert.removeClass('hidden');
                    alert.text('Alle Ihre Eingaben waren falsch, Bitte veruschen Sie es erneut.');

                    $("#passwordOld").val('');
                    $("#passwordNew").val('');
                    $("#passwordNewRepeat").val('');
                }

            }
        })
    });
    $('.modal').on('hidden.bs.modal', function (e) {
        $(this)
            .find("input,textarea,select")
            .val('')
            .end()
            .find("input[type=checkbox], input[type=radio]")
            .prop("checked", "")
            .end();
        $("#alert").attr('class', 'hidden');
        $("#alert").text('');

        $("#emailAlert").attr('class', 'hidden');
        $("#emailAlert").text('');
    })
});