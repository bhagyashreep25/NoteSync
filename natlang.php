<?php
session_start();
// if(!isset($_SESSION['userid'])){
//     header("Location:./signup.php");
// }
require_once('TextRazor.php');
require_once('./config.php');


TextRazorSettings::setApiKey('dd46ca2a821c49c162b64998ae2dea77e310f3f68c87450d814dcdad');


if (isset($_POST['filename'])) {
    $file_path = $resultpath . $_POST['filename'];
    // $file_path = $resultpath . "result";
    // $text = 'Barclays misled shareholders and the public about one of the biggest investments in the banks history, a BBC Panorama investigation has found.';
    $text = file_get_contents($file_path . ".txt");

    $textrazor = new TextRazor();

    $textrazor->addExtractor('entities');

    $response = $textrazor->analyze($text);
    if (isset($response['response']['entities'])) {
        $natlangq = "UPDATE $dbname.convert set natlang=" . $response['response']['entities'] . " WHERE name=$file_path;";
        $result = mysqli_query($conn, $natlangq);
        if ($result) {
            print("Success stored");
        } else {
            print("error");
        }
        foreach ($response['response']['entities'] as $entity) {
            print($entity['wikiLink']);
            print($entity['entityId']);
            print(PHP_EOL);
        }
    }
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
                    <span class="card-title"></span>
                    <h4 class="center">Getting Started With OCR</h4>
                    <div class="row">
                        <form class="col s12">
                            <div class="row">
                                <div class="input-field col s12">
                                    <?php
                                    $display_file = fopen("./results/" . $file_name . ".txt", "r");
                                    ?>
                                    <textarea disabled id="textarea-ocr" class="materialize-textarea"><?php echo fread($display_file, 1000); ?></textarea>
                                    <label for="textarea1"></label>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- <p class="center">Upload your image here</p> -->
                    <!-- <form action="./cloud.php" method="POST" enctype="multipart/form-data"> -->
                    <!-- <div class = "file-field input-field">
                  <div class = "btn">
                     <span>Browse</span>
                     <input required type = "file" name="image" accept="image/png,image/jpeg,image/jpg" id="image"/>
                  </div>
                  
                  <div class = "file-path-wrapper">
                     <input class = "file-path validate" type = "text"
                        placeholder = "Upload file"/>
                  </div>
               </div> -->
                    <!-- </div> -->
                    <!-- <a class="btn" onclick="save()">Save</a> -->
                    </form>
                    <!-- <a class="btn" href="./textdownload.php">Download as text</a>
                <a class="btn" href="./ocr.php">Try for another file</a>
                <a class="btn" href="./tts.php">Convert to speech</a>
                <a class="btn" href="./natlang.php">Get Wiki links</a> -->

                </div>
            </div>
        </div>
    </div>
</body>

</html>