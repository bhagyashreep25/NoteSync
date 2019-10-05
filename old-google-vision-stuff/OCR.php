<?php

/**
 * Copyright 2016 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
// [START vision_text_detection]
namespace Google\Cloud\Samples\Vision;

require __DIR__ . '/vendor/autoload.php';
// require __DIR__ . '/vendor/autoload.php';

use Google\Cloud\Vision\V1\ImageAnnotatorClient;
// $path = 'path/to/your/image.jpg';
$path = "C:/Users/Netra/Downloads/notes2.jpeg";
// $path = "https://www.google.com/url?sa=i&source=images&cd=&ved=2ahUKEwif0-zpgIXlAhWFPY8KHagBDwAQjRx6BAgBEAQ&url=https%3A%2F%2Fjooinn.com%2Fhandwritten-text.html&psig=AOvVaw3WiHXnyiE5lZmeDItviiyu&ust=1570360979939260";
function detect_text($path)
{
    // $client = new Google_Client();
    putenv('GOOGLE_APPLICATION_CREDENTIALS=./NoteSync-b95ba7f5ab72.json');
    // $client->useApplicationDefaultCredentials();
    // $client->setAuthConfig('./NoteSync-b95ba7f5ab72.json');
    $imageAnnotator = new ImageAnnotatorClient();
    # annotate the image
    $image = file_get_contents($path);
    $response = $imageAnnotator->textDetection($image);
    $texts = $response->getTextAnnotations();
    printf('%d texts found:' . PHP_EOL, count($texts));
    foreach ($texts as $text) {
        print($text->getDescription() . PHP_EOL);
        # get bounds
        $vertices = $text->getBoundingPoly()->getVertices();
        $bounds = [];
        foreach ($vertices as $vertex) {
            $bounds[] = sprintf('(%d,%d)', $vertex->getX(), $vertex->getY());
        }
        print('Bounds: ' . join(', ', $bounds) . PHP_EOL);
    }
    $imageAnnotator->close();
}

detect_text($path);
