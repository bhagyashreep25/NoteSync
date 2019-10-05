<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: Apikey
$config = Swagger\Client\Configuration::getDefaultConfiguration()->setApiKey('Apikey', '41c65395-0741-456f-9c94-384b6bb897d6');



$apiInstance = new Swagger\Client\Api\SpeakApi(
    
    
    new GuzzleHttp\Client(),
    $config
);
$format = "mp3"; // string | File format to generate response in; possible values are \"mp3\" or \"wav\"
$text = "Hello world"; // string | The text you would like to conver to speech.  Be sure to surround with quotes, e.g. \"The quick brown fox jumps over the lazy dog.\"

try {
    $result = $apiInstance->speakPost($format, $text);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling SpeakApi->speakPost: ', $e->getMessage(), PHP_EOL;
}
?>