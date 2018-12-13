$(document).ready(function () {
    /**
     * On .board-button click add or remove css from a single board.
     */
    $(".board-button").click(function () {
        if ($(this).hasClass('button-active')) {
            $(this).removeClass('button-active');
        } else {
            $('#boardSubmit').prop('disabled', false);
            $(this).addClass('button-active');
        }
    });

    /**
     * On #boardSubmit click get all active board buttons and submit it.
     */
    $("#boardSubmit").click(function () {
        var boards = [];
        var i = 0;
        $("#boardForm .button-active").each(function () {
            valu = $(this).val();
            boards[i] = valu;
            i++;
        });
        $("#selectedBoards").val(JSON.stringify(boards));
        if (typeof boards !== 'undefined' && boards.length > 0) {
            $("#boardForm").submit();
        }
        else {
            $('#boardSubmit').prop('disabled', true);
        }
    });

    /**
     * on #boardReset click remove all button-active classes.
     */
    $("#boardReset").click(function () {
        $("#boardForm .button-active").removeClass("button-active");
        $('#boardSubmit').prop('disabled', true);
    });
});