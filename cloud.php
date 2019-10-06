<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location:./signup.php");
}
require_once(__DIR__ . '/vendor/autoload.php');
require_once('./config.php');

// Configure API key authorization: Apikey
$config = Swagger\Client\Configuration::getDefaultConfiguration()->setApiKey("Apikey", '41c65395-0741-456f-9c94-384b6bb897d6');

if (isset($_FILES['image'])) {
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];
    $string = explode('.', $_FILES['image']['name']);
    $file_ext = strtolower(end($string));
    $errors = array();
    $extensions = array("jpg", "png", "jpeg");
    $upload_link = "./uploads/" . $file_name;

    if (in_array($file_ext, $extensions) === false) {
        $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
    }

    if ($file_size > 2097152) {
        $errors[] = 'File size must not be more than 2 MB';
    }

    if (empty($errors) == true) {
        move_uploaded_file($file_tmp, $upload_link);
        $userid = $_SESSION['userid'];
        $query1 = "INSERT INTO $dbname.convert(userid, name, piclink) values ($userid, '$file_name', '$upload_link')";
        $result = mysqli_query($conn, $query1);
        if ($result) {
            echo "Database entry done";
        } else {
            echo "duplicate entry";
        }
    } else {
        echo "Failure :(";
    }



    $apiInstance = new Swagger\Client\Api\ImageOcrApi(


        new GuzzleHttp\Client(),
        $config
    );

    $image_file = "./uploads/" . $file_name;
    print_r($image_file);
    // $image_file = 'C:/Users/Netra/Downloads/notes1.jpeg';
    // $image_file = 'D:/BHAGYASHREE/HACK/netra.jpeg'; // \SplFileObject | Image file to perform OCR on.  Common file formats such as PNG, JPEG are supported.
    $language = "ENG"; // string | Optional, language of the input document, default is English (ENG).  Possible values are ENG (English), ARA (Arabic), ZHO (Chinese - Simplified), ZHO-HANT (Chinese - Traditional), ASM (Assamese), AFR (Afrikaans), AMH (Amharic), AZE (Azerbaijani), AZE-CYRL (Azerbaijani - Cyrillic), BEL (Belarusian), BEN (Bengali), BOD (Tibetan), BOS (Bosnian), BUL (Bulgarian), CAT (Catalan; Valencian), CEB (Cebuano), CES (Czech), CHR (Cherokee), CYM (Welsh), DAN (Danish), DEU (German), DZO (Dzongkha), ELL (Greek), ENM (Archaic/Middle English), EPO (Esperanto), EST (Estonian), EUS (Basque), FAS (Persian), FIN (Finnish), FRA (French), FRK (Frankish), FRM (Middle-French), GLE (Irish), GLG (Galician), GRC (Ancient Greek), HAT (Hatian), HEB (Hebrew), HIN (Hindi), HRV (Croatian), HUN (Hungarian), IKU (Inuktitut), IND (Indonesian), ISL (Icelandic), ITA (Italian), ITA-OLD (Old - Italian), JAV (Javanese), JPN (Japanese), KAN (Kannada), KAT (Georgian), KAT-OLD (Old-Georgian), KAZ (Kazakh), KHM (Central Khmer), KIR (Kirghiz), KOR (Korean), KUR (Kurdish), LAO (Lao), LAT (Latin), LAV (Latvian), LIT (Lithuanian), MAL (Malayalam), MAR (Marathi), MKD (Macedonian), MLT (Maltese), MSA (Malay), MYA (Burmese), NEP (Nepali), NLD (Dutch), NOR (Norwegian), ORI (Oriya), PAN (Panjabi), POL (Polish), POR (Portuguese), PUS (Pushto), RON (Romanian), RUS (Russian), SAN (Sanskrit), SIN (Sinhala), SLK (Slovak), SLV (Slovenian), SPA (Spanish), SPA-OLD (Old Spanish), SQI (Albanian), SRP (Serbian), SRP-LAT (Latin Serbian), SWA (Swahili), SWE (Swedish), SYR (Syriac), TAM (Tamil), TEL (Telugu), TGK (Tajik), TGL (Tagalog), THA (Thai), TIR (Tigrinya), TUR (Turkish), UIG (Uighur), UKR (Ukrainian), URD (Urdu), UZB (Uzbek), UZB-CYR (Cyrillic Uzbek), VIE (Vietnamese), YID (Yiddish)
    $preprocessing = "Auto"; // string | Optional, preprocessing mode, default is 'Auto'.  Possible values are None (no preprocessing of the image), and Auto (automatic image enhancement of the image before OCR is applied; this is recommended).


    try {
        $result = $apiInstance->imageOcrPost($image_file, $language, $preprocessing);
        // print_r($result["text_result"]);
        $final_result = explode(".", $result["text_result"]);
        // print_r($final_result);


    } catch (Exception $e) {
        echo 'Exception when calling ImageOcrApi->imageOcrPost: ', $e->getMessage(), PHP_EOL;
    }

    // for ($count = 0; $count < sizeof($final_result); $count++) {
    //     print_r($final_result[$count]);

    //     echo "<br>";
    // }
    $result_file = fopen("./results/" . $file_name . ".txt", "w");
    fwrite($result_file, implode($final_result));
    fclose($result_file);
    print_r("./results/" . $file_name . ".txt");
    $userid = $_SESSION['userid'];
    // $resultpath
        $query2 = "UPDATE $dbname.convert set ogtext='".$resultpath.$file_name.".txt' WHERE name='$file_name'";
        $result = mysqli_query($conn, $query2);
        if ($result) {
            echo "Database entry done 2";
        } else {
            echo "duplicate entry 2";
        }
    // $phpWord = new \PhpOffice\PhpWord\PhpWord();
    // $section = $phpWord->addSection();
    // $section->addText(implode($final_result));
    // $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
    // $objWriter->save('resultword.docx');

}

// if(isset($_POST['saveto'])){

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
                <li><a style="float:right" href="#">Login</a></li>
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
                                    $display_file = fopen("./results/".$file_name.".txt","r");
                                    ?>
                                    <textarea disabled id="textarea-ocr" class="materialize-textarea"><?php echo fread($display_file,1000);?></textarea>
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
                <a class="btn" href="./ocr.php">Try for another file</a>
                <a class="btn" href="./tts.php">Convert to speech</a>
                <a class="btn" href="./natlang.php">Get Wiki links</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>