function buttonClick(id) {

    var button = document.getElementById(id);

    if (button.classList.contains('button-active')) {

        button.classList.remove('button-active');

    } else {

        button.classList.add('button-active');

    }

}

function submitForm() {

    var boards = [];

    var i = 0;

    $("#boardForm .button-active").each(function (index) {

        valu = $(this).val();

        boards[i] = valu;

        i++;

    });
    document.getElementById('selectedBoards').value = JSON.stringify(boards);

    $("#boardForm").submit();

}

function resetForm() {
    $("#boardForm .button-active").each(function () {
        thisButton = $(this);
        id = thisButton.attr('id');
        document.getElementById(id).classList.remove('button-active');
    });
}

$(document).ready(function () {
    $(".card").click(function () {
        document.getElementById("boardForm").submit();
    });
});