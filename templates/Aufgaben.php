<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <!---->
    <style>
        :root {
            --main-bg-color: #EBEBEB;
            --input-color: #C5C5C5;
            --button-font-color: #000000;
            --button-anzahl-aufgaben-color: #FFFFFF;
        }

        body {
            background-color: var(--main-bg-color);
            width: 50%;
            margin: 0 auto;
        }

        ul {
            text-align: center;

            margin: 0 auto;
        }

        li {
            margin-top: 20px;
            border: 1px solid black;
            box-shadow: 5px 10px 8px #888888;
            border-radius: 25px;
            list-style: none;
            padding-top: 5px;
            padding-bottom: 5px;
            background-color: var(--button-anzahl-aufgaben-color);
            font-weight: 600;
        }

        #row_heute {
            padding-top: 2rem;

        }

        button {
            margin: 0 auto;
            margin-top: 20px;
            background-color: var(--button-anzahl-aufgaben-color);
            border-radius: 25px;
            border: 1px solid grey;
            width: 150px;
            height: 150px;


        }
    </style>

</head>
<body>

<div class="container-fluid">
    <button onclick="myFunction()">Heute</button>
    <div class="row" id="row_heute">
        <div class="col" id="div_heute">
            <ul>
                <li>Aufgaben</li>
                <li>Aufgaben</li>
                <li>Aufgaben</li>
                <li>Aufgaben</li>
                <li>Aufgaben</li>
                <li>Aufgaben</li>
                <li>Aufgaben</li>
            </ul>
        </div>
    </div>
</div>

<script>
    //function myFunction() {
    //var x = document.getElementById("div_heute");
    //if (x.style.display === "none") {
    //    x.style.display = "block";
    // } else {
    //    x.style.display = "none";
    //  }
    //}
    $(document).ready(function () {
        $("button").click(function () {
            $("ul").toggle(1000);
        });
    });
</script>
</body>
</html>
