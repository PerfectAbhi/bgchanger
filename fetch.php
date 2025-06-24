<?php
header('Content-Type: application/json');

// File to store the latest OTP
$storage_file = 'latest_otp.txt';

// POST request with JSON body
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    if (isset($data['code'])) {
        file_put_contents($storage_file, $data['code']);
        echo json_encode(["status" => "success", "otp" => $data['code']]);
        exit;
    } else {
        http_response_code(400);
        echo json_encode(["status" => "error", "message" => "Missing 'code' in POST"]);
        exit;
    }
}

// GET with ?code=123456
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Store new OTP via GET
    if (isset($_GET['code'])) {
        file_put_contents($storage_file, $_GET['code']);
        echo json_encode(["status" => "success", "otp" => $_GET['code']]);
        exit;
    }

    // Fetch latest OTP
    if (isset($_GET['get_otp'])) {
        if (file_exists($storage_file)) {
            $otp = file_get_contents($storage_file);
            echo json_encode(["status" => "success", "otp" => $otp]);
        } else {
            echo json_encode(["status" => "no_otp", "otp" => null]);
        }
        exit;
    }

    echo json_encode(["status" => "error", "message" => "Invalid GET request"]);
    exit;
}
?>
