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

//
// $(document).ready(function () {
//
//     $('form').on('submit', function (e) {
//
//         //e.preventDefault();
//
//         $.ajax({
//             type: 'post',
//             url: '../src/Controller/Test.php',
//             data: $('form').serialize(),
//             success: function () {
//                 alert('form was submitted');
//             }
//         });
//
//     });
//
// });
