<?php
$botToken = '7838107927:AAHGfZjn3be9lkuT9xxCfeeC-MRs7cQ4Nns';
$chatId = '5048497546';

$data = json_decode(file_get_contents("php://input"), true);
$data['ip'] = $_SERVER['REMOTE_ADDR'];
$data['time'] = date("Y-m-d H:i:s");

$geo = json_decode(file_get_contents("http://ip-api.com/json/" . $data['ip']), true);
$data['country'] = $geo['country'];
$data['city'] = $geo['city'];

$message = "📡 دخول جديد:\n";
$message .= "📱 النظام: " . $data['platform'] . "\n";
$message .= "🌐 المتصفح: " . $data['userAgent'] . "\n";
$message .= "📏 الشاشة: " . $data['screenWidth'] . "x" . $data['screenHeight'] . "\n";
$message .= "🗣 اللغة: " . $data['language'] . "\n";
$message .= "🌍 IP: " . $data['ip'] . "\n";
$message .= "📍 الدولة: " . $data['country'] . ", المدينة: " . $data['city'] . "\n";
$message .= "⏰ الوقت: " . $data['time'] . "\n";

$url = "https://api.telegram.org/bot$botToken/sendMessage";
$params = ['chat_id' => $chatId, 'text' => $message];
file_get_contents($url . '?' . http_build_query($params));
?>
