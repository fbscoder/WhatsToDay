/**
 * Set the values in modal
 * @param id Card id
 * @param title Card title
 * @param button Finish button in card
 */
function setTaskValuesInModal(id, title, button) {
    $(".modal #title").text(title);
    $(".modal #card_id").val(id);
    $(".modal .modal-body .description-modal-unchecked").remove();

    card = button.parentElement.parentElement;
    textWithUnchecked = "Es sind noch Checklisten offen!";
    ok = true;
    $(card).find('input[type="checkbox"]').each(function () {
        if ($(this).prop('checked') === false) {
            ok = false;
            return false;
        }
    });
    if (!ok) {
        $(".modal .modal-body").append('<p class="description-modal-unchecked"></p>');
        $(".modal .modal-body .description-modal-unchecked").text(textWithUnchecked);
    }
    $("#cardForm").attr('action', document.URL);
}

function submitForm(inputId, checkListId, itemName) {
    var input = $('#' + inputId);
    sessionStorage.setItem('checkListItemValue', input.val());
    sessionStorage.setItem('checkListId', $('#' + checkListId).val());
    sessionStorage.setItem('checkItemName', itemName);
    sessionStorage.setItem('inputId', inputId);
    input.prop('disabled', true);
    $('#checkListForm').submit();
}

$(document).ready(function () {
    if (sessionStorage.getItem('reloadSite') !== null) {
        if (sessionStorage.getItem('reloadSite') === 'today') {
            $("#task_tomorrow").css({'display': "none"});
            $("#task_today").css({'display': "block"});
        } else {
            $("#task_today").css({'display': "none"});
            $("#task_tomorrow").css({'display': "block"});
        }
        $("#tasks").css({'overflow': "visible"});
        $("#tasks").css({'margin-right': "0"});
        $("#tasks").css({'height': "0"});
        $(".timeButtons").css({'display': 'none'});
        sessionStorage.clear();
    }

    /**
     * Hide all tasks and show tomorrow and today buttons
     */
    $("#hideTasks").click(function () {
        $(".timeButtons").css({'display': 'block'});
        $('#tasks').animate({
            'margin-right': '100%',
        }, {
            duration: 1000,
            start: function () {
                $("#tasks").css({'overflow': "hidden"});
                $("#tasks").css({'height': "100%"});
            },
            complete: function () {
                $("#tasks").css({'overflow': "hidden"});
            }
        });
    });

    /**
     * Hide today and tomorrow buttons and show the tasks from today
     */
    $("#btn_today").click(function () {
        // $('#xpullTaskToday').css({'display': "none"});
        $('#tasks').animate({
            'margin-right': '0',
        }, {
            duration: 1000,
            start: function () {
                $("#task_tomorrow").css({'display': "none"});
                $("#task_today").css({'display': "block"});
            },
            complete: function () {
                $("#tasks").css({'overflow': "visible"});
                $(".timeButtons").css({'display': 'none'});
                $("#tasks").css({'height': "0"});
            }
        });
    });

    /**
     * Hide today and tomorrow buttons and show the tasks from tomorrow
     */
    $("#btn_tomorrow").click(function () {
        // $('#xpullTaskTomorrow').css({'display': "none"});

        $('#tasks').animate({
            'margin-right': '0',
        }, {
            duration: 1000,
            start: function () {
                $("#task_today").css({'display': "none"});
                $("#task_tomorrow").css({'display': "block"});
            },
            complete: function () {
                $("#tasks").css({'overflow': "visible"});
                $(".timeButtons").css({'display': 'none'});
                $("#tasks").css({'height': "0"});
            }
        });
    });

    /**
     * Xpull library refresh site with down slide (css has been removed)
     */
    $('#task_today').xpull({
        'callback': function () {
            sessionStorage.setItem('reloadSite', 'today');
            location.reload();
        }
    });
    $('#task_tomorrow').xpull({
        'callback': function () {
            sessionStorage.setItem('reloadSite', 'tomorrow');
            location.reload();
        }
    });
    $('.timeButtons').xpull({
        'callback': function () {
            location.reload();
        }
    });


    $('#checkListForm').submit(function (event) {
        event.preventDefault();
        checkListItemId = sessionStorage.getItem('checkListItemValue');
        checkListId = sessionStorage.getItem('checkListId');
        itemName = sessionStorage.getItem('checkItemName');
        inputId = $('#' + sessionStorage.getItem('inputId'));
        sessionStorage.clear();

        $.ajax({
            url: '/setCheckListItemCompleted',
            type: 'post',
            data: {'checkListId': checkListId, 'checkListItemId': checkListItemId, 'checkItemName': itemName},
            success: function (output) {

            },
            error: function (output) {
                inputId.prop('disabled', false);
            }
        })


    })
});