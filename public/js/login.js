$(document).ready(function () {
    $('#changeForgottenPassword').modal('hide');
    $("#alertPasswordReset").attr('class', 'hidden');
    if (sessionStorage.getItem('login') !== null) {
        $('#alertLogin').removeClass('hidden');
        $('#email').val(sessionStorage.getItem('login'));
        sessionStorage.clear()
    }
    $("#forgotPasswordModalSubmit").click(function () {
        $("#forgotPasswordForm").submit();
    });
    $("#forgotPasswordForm").submit(function (event) {
        event.preventDefault(); //prevent default action
        var form_data = $(this).serialize(); //Encode form elements for submission
        $.ajax({
            url: '/verifySecurityQuestion',
            type: 'post',
            data: form_data,
            success: function (output) {
                if (output != "noUser") {

                    $('#userId').val(output);
                    $('#forgotPasswordModal').modal('hide');
                    $('#changeForgottenPassword').modal('show');
                }
                else {
                    var alert = $("#alert_1");
                    alert.attr('class', 'hidden');
                    alert.addClass('alert alert-dark ');
                    alert.removeClass('hidden');
                    alert.text("Ihre Email Addresse oder Sicherheitsfrage ist falsch, bitte überprüfen Sie Ihre Eingabe!");
                }
            }
        });
    });

    $("#changeForgotPasswordFormSubmit").click(function () {
        $("#changeForgotPasswordForm").submit();
    });
    $("#changeForgotPasswordForm").submit(function (event) {
        var alert = $("#alertPasswordReset");
        alert.attr('class', 'hidden');
        event.preventDefault();
        form_data = $(this).serialize();
        $.ajax({
            url: '/changeForgottenPassword',
            type: 'post',
            data: form_data,
            success: function (output) {


                if (output === "success") {
                    alert.attr('class', 'hidden');
                    alert.addClass('alert alert-success');
                    alert.removeClass('hidden');
                    alert.text("Ihr Passwort wurde geändert!");
                }
                else if (output === "PasswordsDoesNotMatch") {
                    alert.attr('class', 'hidden');
                    alert.addClass('alert alert-dark alert');
                    alert.removeClass('hidden');
                    alert.text("Ihre Passwörter stimmen nicht überein!");
                }
                alert(output);
            }
        });
    });
    $('#enteredEmail').change(function () {
            $.ajax({
                url: '/getSecurityQuestion',
                type: 'post',
                data: {email: $('#enteredEmail').val()},
                success: function (output) {
                    $('#question').val(output);
                    $('#questionHidden').val(output);
                }
            });
        }
    );

});