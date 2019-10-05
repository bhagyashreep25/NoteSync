# cloudmersive_ocr_api_client
The powerful Optical Character Recognition (OCR) APIs let you convert scanned images of pages into recognized text.

[Cloudmersive OCR API](https://www.cloudmersive.com/ocr-api) provides advanced machine learning capabilities for converting scanned documents and photos of documents and receipts to text.

- API version: v1
- Package version: 1.5.9


## Requirements

PHP 5.5 and later

## Installation & Usage
### Composer

To install the bindings via [Composer](http://getcomposer.org/), add the following to `composer.json`:

```
{
  "repositories": [
    {
      "type": "git",
      "url": "https://github.com/cloudmersive/cloudmersive_ocr_api_client.git"
    }
  ],
  "require": {
    "cloudmersive/cloudmersive_ocr_api_client": "*@dev"
  }
}
```

Then run `composer install`

### Manual Installation

Download the files and include `autoload.php`:

```php
    require_once('/path/to/cloudmersive_ocr_api_client/vendor/autoload.php');
```

## Tests

To run the unit tests:

```
composer install
./vendor/bin/phpunit
```

## Getting Started

Please follow the [installation procedure](#installation--usage) and then run the following:

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: Apikey
$config = Swagger\Client\Configuration::getDefaultConfiguration()->setApiKey('Apikey', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = Swagger\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Apikey', 'Bearer');

$apiInstance = new Swagger\Client\Api\ImageOcrApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$image_file = "/path/to/file.txt"; // \SplFileObject | Image file to perform OCR on.  Common file formats such as PNG, JPEG are supported.
$language = "language_example"; // string | Optional, language of the input document, default is English (ENG).  Possible values are ENG (English), ARA (Arabic), ZHO (Chinese - Simplified), ZHO-HANT (Chinese - Traditional), ASM (Assamese), AFR (Afrikaans), AMH (Amharic), AZE (Azerbaijani), AZE-CYRL (Azerbaijani - Cyrillic), BEL (Belarusian), BEN (Bengali), BOD (Tibetan), BOS (Bosnian), BUL (Bulgarian), CAT (Catalan; Valencian), CEB (Cebuano), CES (Czech), CHR (Cherokee), CYM (Welsh), DAN (Danish), DEU (German), DZO (Dzongkha), ELL (Greek), ENM (Archaic/Middle English), EPO (Esperanto), EST (Estonian), EUS (Basque), FAS (Persian), FIN (Finnish), FRA (French), FRK (Frankish), FRM (Middle-French), GLE (Irish), GLG (Galician), GRC (Ancient Greek), HAT (Hatian), HEB (Hebrew), HIN (Hindi), HRV (Croatian), HUN (Hungarian), IKU (Inuktitut), IND (Indonesian), ISL (Icelandic), ITA (Italian), ITA-OLD (Old - Italian), JAV (Javanese), JPN (Japanese), KAN (Kannada), KAT (Georgian), KAT-OLD (Old-Georgian), KAZ (Kazakh), KHM (Central Khmer), KIR (Kirghiz), KOR (Korean), KUR (Kurdish), LAO (Lao), LAT (Latin), LAV (Latvian), LIT (Lithuanian), MAL (Malayalam), MAR (Marathi), MKD (Macedonian), MLT (Maltese), MSA (Malay), MYA (Burmese), NEP (Nepali), NLD (Dutch), NOR (Norwegian), ORI (Oriya), PAN (Panjabi), POL (Polish), POR (Portuguese), PUS (Pushto), RON (Romanian), RUS (Russian), SAN (Sanskrit), SIN (Sinhala), SLK (Slovak), SLV (Slovenian), SPA (Spanish), SPA-OLD (Old Spanish), SQI (Albanian), SRP (Serbian), SRP-LAT (Latin Serbian), SWA (Swahili), SWE (Swedish), SYR (Syriac), TAM (Tamil), TEL (Telugu), TGK (Tajik), TGL (Tagalog), THA (Thai), TIR (Tigrinya), TUR (Turkish), UIG (Uighur), UKR (Ukrainian), URD (Urdu), UZB (Uzbek), UZB-CYR (Cyrillic Uzbek), VIE (Vietnamese), YID (Yiddish)
$preprocessing = "preprocessing_example"; // string | Optional, preprocessing mode, default is 'Auto'.  Possible values are None (no preprocessing of the image), and Auto (automatic image enhancement of the image before OCR is applied; this is recommended).

try {
    $result = $apiInstance->imageOcrImageLinesWithLocation($image_file, $language, $preprocessing);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ImageOcrApi->imageOcrImageLinesWithLocation: ', $e->getMessage(), PHP_EOL;
}

?>
```

## Documentation for API Endpoints

All URIs are relative to *https://api.cloudmersive.com*

Class | Method | HTTP request | Description
------------ | ------------- | ------------- | -------------
*ImageOcrApi* | [**imageOcrImageLinesWithLocation**](docs/Api/ImageOcrApi.md#imageocrimagelineswithlocation) | **POST** /ocr/image/to/lines-with-location | Convert a scanned image into words with location
*ImageOcrApi* | [**imageOcrImageWordsWithLocation**](docs/Api/ImageOcrApi.md#imageocrimagewordswithlocation) | **POST** /ocr/image/to/words-with-location | Convert a scanned image into words with location
*ImageOcrApi* | [**imageOcrPhotoRecognizeBusinessCard**](docs/Api/ImageOcrApi.md#imageocrphotorecognizebusinesscard) | **POST** /ocr/photo/recognize/business-card | Recognize a photo of a business card, extract key business information
*ImageOcrApi* | [**imageOcrPhotoRecognizeForm**](docs/Api/ImageOcrApi.md#imageocrphotorecognizeform) | **POST** /ocr/photo/recognize/form | Recognize a photo of a form, extract key fields and business information
*ImageOcrApi* | [**imageOcrPhotoRecognizeReceipt**](docs/Api/ImageOcrApi.md#imageocrphotorecognizereceipt) | **POST** /ocr/photo/recognize/receipt | Recognize a photo of a receipt, extract key business information
*ImageOcrApi* | [**imageOcrPhotoToText**](docs/Api/ImageOcrApi.md#imageocrphotototext) | **POST** /ocr/photo/toText | Convert a photo of a document into text
*ImageOcrApi* | [**imageOcrPhotoWordsWithLocation**](docs/Api/ImageOcrApi.md#imageocrphotowordswithlocation) | **POST** /ocr/photo/to/words-with-location | Convert a photo of a document or receipt into words with location
*ImageOcrApi* | [**imageOcrPost**](docs/Api/ImageOcrApi.md#imageocrpost) | **POST** /ocr/image/toText | Convert a scanned image into text
*PdfOcrApi* | [**pdfOcrPdfToLinesWithLocation**](docs/Api/PdfOcrApi.md#pdfocrpdftolineswithlocation) | **POST** /ocr/pdf/to/lines-with-location | Convert a PDF into text lines with location
*PdfOcrApi* | [**pdfOcrPdfToWordsWithLocation**](docs/Api/PdfOcrApi.md#pdfocrpdftowordswithlocation) | **POST** /ocr/pdf/to/words-with-location | Convert a PDF into words with location
*PdfOcrApi* | [**pdfOcrPost**](docs/Api/PdfOcrApi.md#pdfocrpost) | **POST** /ocr/pdf/toText | Converts an uploaded PDF file into text via Optical Character Recognition.
*PreprocessingApi* | [**preprocessingBinarize**](docs/Api/PreprocessingApi.md#preprocessingbinarize) | **POST** /ocr/preprocessing/image/binarize | Convert an image of text into a binarized (light and dark) view
*PreprocessingApi* | [**preprocessingBinarizeAdvanced**](docs/Api/PreprocessingApi.md#preprocessingbinarizeadvanced) | **POST** /ocr/preprocessing/image/binarize/advanced | Convert an image of text into a binary (light and dark) view with ML
*PreprocessingApi* | [**preprocessingGetPageAngle**](docs/Api/PreprocessingApi.md#preprocessinggetpageangle) | **POST** /ocr/preprocessing/image/get-page-angle | Get the angle of the page / document / receipt
*PreprocessingApi* | [**preprocessingUnrotate**](docs/Api/PreprocessingApi.md#preprocessingunrotate) | **POST** /ocr/preprocessing/image/unrotate | Detect and unrotate a document image
*PreprocessingApi* | [**preprocessingUnskew**](docs/Api/PreprocessingApi.md#preprocessingunskew) | **POST** /ocr/preprocessing/image/unskew | Detect and unskew a photo of a document
*ReceiptsApi* | [**receiptsPhotoToCSV**](docs/Api/ReceiptsApi.md#receiptsphototocsv) | **POST** /ocr/receipts/photo/to/csv | Convert a photo of a receipt into a CSV file containing structured information from the receipt


## Documentation For Models

 - [BusinessCardRecognitionResult](docs/Model/BusinessCardRecognitionResult.md)
 - [FieldResult](docs/Model/FieldResult.md)
 - [FormDefinitionTemplate](docs/Model/FormDefinitionTemplate.md)
 - [FormFieldDefinition](docs/Model/FormFieldDefinition.md)
 - [FormRecognitionResult](docs/Model/FormRecognitionResult.md)
 - [GetPageAngleResult](docs/Model/GetPageAngleResult.md)
 - [ImageToLinesWithLocationResult](docs/Model/ImageToLinesWithLocationResult.md)
 - [ImageToTextResponse](docs/Model/ImageToTextResponse.md)
 - [ImageToWordsWithLocationResult](docs/Model/ImageToWordsWithLocationResult.md)
 - [OcrLineElement](docs/Model/OcrLineElement.md)
 - [OcrPageResult](docs/Model/OcrPageResult.md)
 - [OcrPageResultWithLinesWithLocation](docs/Model/OcrPageResultWithLinesWithLocation.md)
 - [OcrPageResultWithWordsWithLocation](docs/Model/OcrPageResultWithWordsWithLocation.md)
 - [OcrPhotoTextElement](docs/Model/OcrPhotoTextElement.md)
 - [OcrWordElement](docs/Model/OcrWordElement.md)
 - [PdfToLinesWithLocationResult](docs/Model/PdfToLinesWithLocationResult.md)
 - [PdfToTextResponse](docs/Model/PdfToTextResponse.md)
 - [PdfToWordsWithLocationResult](docs/Model/PdfToWordsWithLocationResult.md)
 - [PhotoToWordsWithLocationResult](docs/Model/PhotoToWordsWithLocationResult.md)
 - [ReceiptLineItem](docs/Model/ReceiptLineItem.md)
 - [ReceiptRecognitionResult](docs/Model/ReceiptRecognitionResult.md)


## Documentation For Authorization


## Apikey

- **Type**: API key
- **API key parameter name**: Apikey
- **Location**: HTTP header


## Author




