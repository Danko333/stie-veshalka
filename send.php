<?php
// Замените 'YOUR_BOT_TOKEN' на реальный токен вашего бота
$botToken = '6480020785:AAEVAa3_D9DEEIqkq3Uvdq3ZTzUzsZ2TbTw';
$chatId = '-4050997707'; // Укажите ID вашего чата в Telegram

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
    $phone = isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : '';

    // Получение IP-адреса
    $ip = $_SERVER['REMOTE_ADDR'];

    // Валидация данных
    if (empty($name) || empty($phone)) {
        die('Заполните все обязательные поля.');
    }

    $message = "Новый заказ!\nИмя: $name\nТелефон: $phone\nIP: $ip";

    $telegramUrl = "https://api.telegram.org/bot$botToken/sendMessage";

    // Используем file_get_contents для отправки POST-запроса в Telegram
    $options = [
        'http' => [
            'method'  => 'POST',
            'header'  => 'Content-type: application/x-www-form-urlencoded',
            'content' => http_build_query([
                'chat_id' => $chatId,
                'text' => $message,
            ]),
        ],
    ];

    $context  = stream_context_create($options);
    file_get_contents($telegramUrl, false, $context);

    // Добавьте ваш код для обработки заказа, например, запись в базу данных
}
?>
