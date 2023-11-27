<?php
$hubVerifyToken = 'samhotang_token';
$accessToken = '';

// Verify the webhook
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['hub_challenge']) && isset($_GET['hub_verify_token']) && $_GET['hub_verify_token'] === $hubVerifyToken) {
  echo $_GET['hub_challenge'];
  exit;
}
// ambil, olah dan simpan pesan
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data)) {
  $message = $data['entry'][0]['changes'][0]['value']['messages'][0];

  $number = $message['from'];
  $textMessage = $message['text']['body'];
} else {
  exit;
}

require __DIR__ . '/../vendor/autoload.php';

use Netflie\WhatsAppCloudApi\WhatsAppCloudApi;
use Illuminate\Support\Str;

// important variable
$link_website = 'https://e815-36-71-137-90.ngrok-free.app/';
$from_phone_number_id = '110115935528924';
$access_token = 'EAACSx9bTc1QBO7RShWtVG0HVofvXApx40pQ8e8HJ0ZAB9E3zcFVvWZA8Aw5rULMojuKSjjuUwM3hXMMGoXBLGZC9eEdZCOT91FQdIo2k7N1rM8WmYLc8jQenhhsG3ksZAn8EtKiNn8ZAyYHSVfhYeoduWrroOSZAS5p5WI7FUaOQ5iI0CUPekSZBjcSb7xX4ZAvYHmLtsbVwB88Tt2FiQrQYZD';
$db_host = '127.0.0.1';
$db_database = 'luora_last';
$db_username = 'root';
$db_password = 'root';
// tentukan tipe pesan dan aksi

$whatsapp_cloud_api = new WhatsAppCloudApi([
  'from_phone_number_id' => $from_phone_number_id,
  'access_token' => $access_token,
]);

$keyword = explode(" ", $textMessage);

if ($keyword[0] === "#tanya") {

  $questionText = implode(" ", array_slice($keyword, 1));

  try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_database", $db_username, $db_password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $result = $pdo->query("SELECT id FROM questions ORDER BY id DESC LIMIT 1");
    $newIdQuestion = $result->fetch(PDO::FETCH_ASSOC)['id'] + 1;

    // ambil waktu saat ini
    date_default_timezone_set('Asia/Jakarta');
    $format = 'Y-m-d H:i:s';
    $currentDateTime = date($format);

    // edit judul
    $removeSpace = str_replace(' ', '-', $questionText);
    $removeChar = preg_replace('/[^A-Za-z0-9\-]/', '', $removeSpace);
    $addSpace = str_replace('-', ' ', $removeChar);
    $questionText = ucfirst($addSpace) . '?';

    // buat slug-link
    $slugQuestionText = Str::of($questionText)->slug('-');

    // id user
    $userIdQuery = $pdo->query("SELECT id FROM users WHERE phone_number = '$number' LIMIT 1");
    $userId = $userIdQuery->fetch(PDO::FETCH_ASSOC)['id'];

    $sql = "INSERT INTO questions (`id`, `user_id`, `title`, `title_slug`, `created_at`, `updated_at`) VALUES (:newIdQuestion, :userId, :questionText, :slugQuestionText, :currentDateTime, :currentDateTime)";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':newIdQuestion', $newIdQuestion, PDO::PARAM_INT);
    $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
    $stmt->bindParam(':questionText', $questionText, PDO::PARAM_STR);
    $stmt->bindParam(':slugQuestionText', $slugQuestionText, PDO::PARAM_STR);
    $stmt->bindParam(':currentDateTime', $currentDateTime, PDO::PARAM_STR);

    if ($stmt->execute()) {
    } else {
      echo $stmt->errorInfo()[2];
    }

    $pdo = null;
  } catch (PDOException $e) {
    echo "Koneksi database gagal: " . $e->getMessage();
  }

  $whatsapp_cloud_api->sendTextMessage($number, 'Pertanyaan anda berhasil diposting, berikut link menuju pertanyaan anda.

' . $link_website . $slugQuestionText);
} else {
  $whatsapp_cloud_api->sendTextMessage($number, 'Saya tidak memahami maksud anda, berikut command untuk memposting pertanyaan

*#tanya <pertanyaan anda>*');
  exit;
}
