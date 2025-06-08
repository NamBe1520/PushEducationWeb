<?php
header("Content-Type: application/json");

// Nhận dữ liệu từ JavaScript
$data = json_decode(file_get_contents("php://input"), true);
$user_message = $data["message"] ?? "";

// Gửi request đến API Python
$api_url = "http://localhost:5050/chat";
$options = [
    "http" => [
        "header"  => "Content-Type: application/json",
        "method"  => "POST",
        "content" => json_encode(["message" => $user_message])
    ]
];

$context = stream_context_create($options);
$response = file_get_contents($api_url, false, $context);
echo $response;
?>
