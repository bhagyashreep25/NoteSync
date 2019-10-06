<?phP
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location:./signup.php");
}
require_once("./config.php");
$query1 = "SELECT * FROM $dbname.convert WHERE userid = " . $_SESSION['userid'];
$result = mysqli_query($conn, $query1);
if ($result) {
    print_r($result);
    echo "Select entry done";
    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
    print_r($row);
} else {
    echo "Failed";
}
$countq = "SELECT count(name) as total FROM $dbname.convert WHERE userid = " . $_SESSION['userid'];
$resultcount = mysqli_query($conn, $countq);
if ($resultcount) {
    echo "Select count done";
    $countresult = mysqli_fetch_assoc($resultcount);
    $count = $countresult['total'];
    print_r($count);
    $rowcount = $count / 3;
} else {
    echo "Failed";
}

if (isset($_GET['radio-file'])) {
    $value = $_GET['radio-file'];
}

?>
<html>

<head>

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/css?family=Be+Vietnam&display=swap" rel="stylesheet">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://code.responsivevoice.org/responsivevoice.js?key=KrEQqVp2"></script>

    <style>
        body {
            font-family: 'Be Vietnam';
        }

        .nav-wrapper {
            background-image: linear-gradient(to bottom right, #23416b, #b04276);
            padding: 0px, 10px;
        }

        .card {
            margin: 20px;
            align: center;
        }

        .btn {
            background-image: linear-gradient(to bottom right, #23416b, #b04276);
        }

        h4,
        h5,
        h6 {
            color: black;
            padding: 15px;
        }

        p {
            color: black;
            padding: 10px;
        }
    </style>

    <script>
        function mySpeechDirect() {
            var speak = document.getElementById("ttsmessage").value;
            responsiveVoice.speak(speak);
        }
    </script>
</head>

<body>
    <nav>
        <div class="nav-wrapper">
            <a href="#" class="brand-logo">NoteSync</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="./index.php">Home</a></li>
                <li><a href="./userdocs.php">Your Docs</a></li>
                <li><a style="float:right" href=<?php if (isset($_SESSION['userid'])) echo "./logout.php";
                                                else echo "./signup.php"; ?>><?php if (isset($_SESSION['userid'])) echo "Logout";
                                                                                else echo "Login"; ?></a></li>
            </ul>
        </div>
    </nav>

    <div class="row">
        <div class="col s6 offset-s3">
            <div class="card hoverable">
                <div class="card-content white-text">
                    <h4 class="center">Getting Started With Text-to-Speech</h4>
                    <p class="center">Choose from your docs</p>
                    <form action="" method="GET" id="choose-file">
                        <div class="row">
                            <div class="col s12 m6 l12">
                                <ul class="collection">
                                    <?php
                                    // $row = mysqli_fetch_assoc($result);
                                    // $entry=array();
                                    // $i = 1;
                                    if (is_iterable($row)) {
                                        foreach ($row as $entry) {
                                            echo '<li class="collection-item"><p>
                                <label>
                                <input class="with-gap" name="radio-file" value=' . $entry["name"] . ' type="radio" />
                                <span>' . $entry['name'] . '</span>
                                </label></p>
                            </li>';
                                            // $i++;
                                        }
                                    }
                                    ?>

                                </ul>
                            </div>
                        </div>
                </div>
                <div class="card-action center">
                    <?php

                    if (isset($_GET['radio-file']))
                        echo "<div><span>You selected: $value </span></div><br>";
                    ?>
                    <?php
                    if (isset($_GET['radio-file']))
                        echo '<input type="submit" class="btn">Speak</input>';
                    else
                        echo '<input type="button" value="Speak" onclick="mySpeech()" class="btn"></button>';
                    ?>
                    <!-- <input type="submit" class="btn"></input> -->
                    </form>
                </div>
                <div class="card-content white-text">
                    <p class="center">OR</p>
                    <h6 class="center">Enter other text</h6>
                    <div class="row">
                        <form class="col s12">
                            <div class="row">
                                <input type="text" name="message" id="ttsmessage"><br><br>
                                <!-- <label for="textarea1">Textarea</label> -->
                            </div>
                    </div>
                    <div class="card-action center">
                        <input type="button" value="Speak" onclick="mySpeechDirect()" class="btn"></button></form>

                    </div>
                </div>
            </div>
</body>

</html>