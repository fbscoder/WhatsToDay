$(document).ready(function () {
    /**
     * Sticky Form (email)
     */
    if (sessionStorage.getItem('login') !== null) {
        $('#alertLogin').removeClass('hidden');
        $('#email').val(sessionStorage.getItem('login'));
        sessionStorage.clear();
    }

    /**
     * Responsive modal switch
     */
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
                } else {
                    var alert = $("#alert_1");
                    alert.attr('class', 'hidden');
                    alert.addClass('alert alert-dark warning');
                    alert.removeClass('hidden');
                    alert.text("Ihre Email Addresse oder Sicherheitsfrage ist falsch, bitte überprüfen Sie Ihre Eingabe!");
                }
            }
        });
    });

    /**
     * Change password with Ajax
     */
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
                } else if (output === "PasswordsDoesNotMatch") {
                    alert.attr('class', 'hidden');
                    alert.addClass('alert alert-dark warning');
                    alert.removeClass('hidden');
                    alert.text("Ihre Passwörter stimmen nicht überein!");
                }
            }
        });
    });

    /**
     * Get Responsive security question with Ajax
     */
    $('#enteredEmail').change(function () {
        $('#SecurityQuestionAnswer').prop('disabled', false);
        $('#forgotPasswordModalSubmit').prop('disabled', false);
        question = $('#question');
            $.ajax({
                url: '/getSecurityQuestion',
                type: 'post',
                data: {email: $('#enteredEmail').val()},
                success: function (output) {
                    if (output == 1) {
                        question.text('Was war der Name Ihres ersten Haustieres?');
                    }
                    else if (output == 2) {
                        question.text('Wie lautet der Mädchenname Ihrer Mutter?');
                    }
                    else if (output == 3) {
                        question.text('Wie lautet Ihr Traumurlaubs Ziel?');
                    }
                    else {
                        question.text('Diese E-Mail Addresse ist nicht regestriert');
                        question.attr('class', 'form-control warning');
                        $('#SecurityQuestionAnswer').prop('disabled', true);
                        $('#forgotPasswordModalSubmit').prop('disabled', true);
                    }
                    $('#questionHidden').val(output);
                }
            });
        }
    );
    $('.modal').on('hidden.bs.modal', function (e) {
        $(this)
            .find("input,textarea,select")
            .val('')
            .end()
            .find("input[type=checkbox], input[type=radio]")
            .prop("checked", "")
            .end();
        $('#question').text('');
    })


});