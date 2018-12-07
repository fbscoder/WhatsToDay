$(document).ready(function () {
    $(".board-button").click(function () {
        if ($(this).hasClass('button-active')) {
            $(this).removeClass('button-active');
        } else {
            $(this).addClass('button-active');
        }
    });
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
    $("#boardReset").click(function () {
        $("#boardForm .button-active").removeClass("button-active");
    });
});