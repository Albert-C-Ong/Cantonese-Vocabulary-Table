<?php
/* generate_audio.php
 *
 * Written by Albert Ong
 */ 

require_once '../includes/functions.php';
require_once '../vendor/autoload.php';

header('Content-Type: application/json');

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$apiKey = $_ENV['GOOGLE_TTS_API_KEY'] ?? null;
if (!$apiKey) {
    echo json_encode(['success' => false, 'error' => 'API key missing']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);
$text = $input['text'] ?? '';
$lang = $input['lang'] ?? '';

if (empty($text) || !in_array($lang, ['cantonese', 'mandarin'])) {
    echo json_encode(['success' => false, 'error' => 'Invalid parameters']);
    exit;
}

$voiceConfigs = [
    'cantonese' => ['languageCode' => 'yue-HK', 'name' => 'yue-HK-Standard-A'],
    'mandarin'  => ['languageCode' => 'cmn-CN', 'name' => 'cmn-CN-Wavenet-A'],
];

$audioDir = __DIR__ . '/audio';
if (!is_dir($audioDir)) {
    mkdir($audioDir, 0755, true);
}

$fileName = 'audio/' . md5($text) . '_' . $lang . '.mp3';
$filePath = __DIR__ . '/' . $fileName;

if (file_exists($filePath)) {
    echo json_encode(['success' => true, 'audioUrl' => $fileName]);
    exit;
}

$ttsUrl = "https://texttospeech.googleapis.com/v1/text:synthesize?key=$apiKey";
$data = [
    'input' => ['text' => $text],
    'voice' => $voiceConfigs[$lang],
    'audioConfig' => ['audioEncoding' => 'MP3']
];

$ch = curl_init($ttsUrl);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpCode !== 200) {
    echo json_encode(['success' => false, 'error' => 'Google API request failed']);
    exit;
}

$result = json_decode($response, true);
if (!isset($result['audioContent'])) {
    echo json_encode(['success' => false, 'error' => 'No audio returned']);
    exit;
}

file_put_contents($filePath, base64_decode($result['audioContent']));

echo json_encode(['success' => true, 'audioUrl' => $fileName]);
?>