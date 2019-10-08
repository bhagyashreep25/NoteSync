<?php
session_start();
// if(!isset($_SESSION['userid'])){
//     header("Location:./signup.php");
// }
require_once('TextRazor.php');
require_once('./config.php');
$query1 = "SELECT * FROM $dbname.convert WHERE userid = " . $_SESSION['userid'];
$result = mysqli_query($conn, $query1);
if ($result) {
    // print_r($result);
    // echo "Select entry done";
    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
    // print_r($row);
} else {
    // echo "Failed";
}
$countq = "SELECT count(name) as total FROM $dbname.convert WHERE userid = " . $_SESSION['userid'];
$resultcount = mysqli_query($conn, $countq);
if ($resultcount) {
    // echo "Select count done";
    $countresult = mysqli_fetch_assoc($resultcount);
    $count = $countresult['total'];
    // print_r($count);
    $rowcount = $count / 3;
} else {
    // echo "Failed";
}

TextRazorSettings::setApiKey($textrazor_key);


// if (isset($_POST['filename'])) {
//     $file_path = $resultpath . $_POST['filename'];
//     // $file_path = $resultpath . "result";
//     // $text = 'Barclays misled shareholders and the public about one of the biggest investments in the banks history, a BBC Panorama investigation has found.';
//     $text = file_get_contents($file_path . ".txt");

//     $textrazor = new TextRazor();

//     $textrazor->addExtractor('entities');

//     $response = $textrazor->analyze($text);
//     if (isset($response['response']['entities'])) {
//         $natlangq = "UPDATE $dbname.convert set natlang=" . json_encode($response) . " WHERE name=$file_path;";
//         $result = mysqli_query($conn, $natlangq);
//         if ($result) {
//             print("Success stored");
//         } else {
//             print("error");
//         }
//         foreach ($response['response']['entities'] as $entity) {
//             print($entity['wikiLink']);
//             print($entity['entityId']);
//             print(PHP_EOL);
//         }
//     }
// }
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

        h4 {
            color: black;
            padding: 15px;
        }

        p {
            color: black;
            padding: 10px;
        }

        .input-field input[type="file"]:focus {
            border-bottom: 1px linear-gradient(to bottom right, #23416b, #b04276);
        }
    </style>
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
                    <h4 class="center">Getting Started With Wiki links</h4>
                    <p class="center">Choose from your docs</p>
                    <form action="" method="POST" id="choose-file">
                        <div class="row">
                            <div class="col s12 m6 l12">
                                <ul class="collection">
                                    <?php

                                    if (is_iterable($row)) {
                                        foreach ($row as $entry) {
                                            echo '<li class="collection-item"><p>
                                                <label>
                                                <input class="with-gap" name="filename" value=' . $entry["name"] . ' type="radio" />
                                                <span>' . $entry['name'] . '</span>
                                                </label></p>
                                                </li>';
                                        }
                                    }
                                    ?>

                                </ul>
                            </div>
                        </div>
                        <!-- </div> -->
                        <div class="card-action center">
                            <input type="submit" class="btn">Submit
                        </div>
                    </form>
                    <?php

                    if (isset($_POST['filename'])) {
                        $file_path = $resultpath . $_POST['filename'];
                        // $file_path = $resultpath . "result";
                        // $text = 'Barclays misled shareholders and the public about one of the biggest investments in the banks history, a BBC Panorama investigation has found.';
                        $text = file_get_contents($file_path . ".txt");

                        $textrazor = new TextRazor();

                        $textrazor->addExtractor('entities');

                        $response = $textrazor->analyze($text);
                        if (isset($response['response']['entities'])) {
                            $natlangq = "UPDATE $dbname.convert set natlang=" . json_encode($response) . " WHERE name=$file_path;";
                            $result = mysqli_query($conn, $natlangq);
                            if ($result) {
                                print("Success stored");
                            } else {
                                print("error");
                            }
                            echo "<table class='highlighted'>
                            <thead>
                            <tr>
                                <th>Entity</th>
                                <th>Wiki Link</th>   
                             </tr>
                            </thead>
                            <tbody>";
                            foreach ($response['response']['entities'] as $entity) {
                                echo "<tr>
                                    <td>".$entity['entityId']."</td>
                                    <td><a href=".$entity['wikiLink']." target='_blank'>".$entity['wikiLink']."</td>
                                </tr>";
                              
                            }
                            echo "</table>";
                        }
                    }
                    ?>
                </div>

            </div>
        </div>
</body>

</html>