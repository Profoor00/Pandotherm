<?php
function transformJsonIntoRightFormat($header){
    $header = str_replace(' ', '_', $header);
    $header = str_replace(':', '_', $header);
    $header = str_replace('.', '', $header);
    $header = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $header);
    $header = preg_replace('/[^A-Za-z0-9_]/', '', $header);
    return $header;
}

require_once __DIR__ . '/vendor/autoload.php';

use Shuchkin\SimpleXLSX;

// Step 1: Authenticate with Google using Service Account
$client = new Google_Client();
$client->setAuthConfig(__DIR__ . '/php-drive-access-457915-e8dc6fbbda78.json'); // your JSON key
$client->addScope(Google_Service_Drive::DRIVE_READONLY);

$service = new Google_Service_Drive($client);

// Step 2: Download the private XLSX file from Google Drive
$fileId = '1T0_E9LoE1Py0xNKu634uZ-xsCTBbSxvL'; // your private file ID
$response = $service->files->get($fileId, ['alt' => 'media']);
$content = $response->getBody()->getContents();

// Step 3: Save the XLSX file locally
$savePath = __DIR__ . "/legkondicionalok.xlsx";
file_put_contents($savePath, $content);
echo "✅ File downloaded and saved as: $savePath\n";

// Step 4: Parse the XLSX and convert to JSON
if (!file_exists(__DIR__ . '/SimpleXLSX.php')) {
    echo "❌ SimpleXLSX.php not found.\n";
    exit;
}

$xlsx = SimpleXLSX::parse($savePath);

if ($xlsx !== false) {
    $rows = $xlsx->rows();
    $headers = array_map(function($header) {
        $header = transformJsonIntoRightFormat($header);
        return $header;
    }, array_shift($rows));
    $jsonArray = [];

    foreach ($rows as $row) {
        $jsonArray[] = array_combine($headers, $row);
    }

    $jsonData = json_encode($jsonArray, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    $jsonFilePath = __DIR__ . "/legkondicionalok.json";

    if (file_put_contents($jsonFilePath, $jsonData) !== false) {
        echo "✅ JSON data saved as: $jsonFilePath\n";
    } else {
        echo "❌ Failed to save JSON data to file.\n";
    }
} else {
    echo SimpleXLSX::parseError();
}