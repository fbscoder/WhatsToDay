$(document).ready(function () {
    /**
     * On .board-button click add or remove css from a single board.
     */
    $(".board-button").click(function () {
        if ($(this).hasClass('button-active')) {
            $(this).removeClass('button-active');
        } else {
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
        $("#boardForm").submit();
    });

    /**
     * on #boardReset click remove all button-active classes.
     */
    $("#boardReset").click(function () {
        $("#boardForm .button-active").removeClass("button-active");
    });
});