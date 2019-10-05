<?php
require_once(__DIR__ . '/vendor/autoload.php');
require_once('./config.php');

// Configure API key authorization: Apikey
$config = Swagger\Client\Configuration::getDefaultConfiguration()->setApiKey("Apikey", '41c65395-0741-456f-9c94-384b6bb897d6');

if (isset($_FILES['ocrfile'])) {
    $file_name = $_FILES['ocrfile']['name'];
    $file_size = $_FILES['ocrfile']['size'];
    $file_tmp = $_FILES['ocrfile']['tmp_name'];
    $file_type = $_FILES['ocrfile']['type'];
    $string = explode('.', $_FILES['ocrfile']['name']);
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
        $query1 = "INSERT INTO $dbname.convert(userid, name, piclink) values (0, '$file_name', '$upload_link')";
        $result = mysqli_query($conn, $query1);
        if ($result) {
            echo "Database entry done";
        }
        else{
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

    for ($count = 0; $count < sizeof($final_result); $count++) {
        print_r($final_result[$count]);

        echo "<br>";
    }
    $result_file = fopen("./results/result.txt", "w");
    fwrite($result_file, implode($final_result));
    fclose($result_file);
    // $phpWord = new \PhpOffice\PhpWord\PhpWord();
    // $section = $phpWord->addSection();
    // $section->addText(implode($final_result));
    // $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
    // $objWriter->save('resultword.docx');

}
?>
