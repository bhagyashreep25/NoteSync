<?php
if(!isset($_SESSION['userid'])){
    header("Location:./signup.php");
}
require_once('TextRazor.php');
require_once('./config.php');


TextRazorSettings::setApiKey('dd46ca2a821c49c162b64998ae2dea77e310f3f68c87450d814dcdad');


// if (isset($_POST['filename'])) {
    $file_path = $resultpath . $_POST['filename'];
    // $file_path = $resultpath . "result";
    // $text = 'Barclays misled shareholders and the public about one of the biggest investments in the banks history, a BBC Panorama investigation has found.';
    $text = file_get_contents($file_path.".txt");

    $textrazor = new TextRazor();

    $textrazor->addExtractor('entities');

    $response = $textrazor->analyze($text);
    if (isset($response['response']['entities'])) {
        $natlangq = "INSERT INTO $dbname.convert();";
        foreach ($response['response']['entities'] as $entity) {
            print($entity['wikiLink']);
            print($entity['entityId']);
            print(PHP_EOL);
        }
    }
// }
