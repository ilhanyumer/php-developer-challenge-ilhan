<?php
use Sensika\Challenge\RSSBuilder;

require 'vendor/autoload.php';

$inputUrls = [
    'https://edition.cnn.com',
    'https://bbc.com'
];
foreach ($inputUrls as $inputUrl) {
    $rssBuilder = new RSSBuilder($inputUrl);
    $json = $rssBuilder->getJSON();
    echo $json, PHP_EOL;
}





