<?php
$conn = new mysqli("localhost", "root", "", "iot_data");
if ($conn->connect_error) {
    http_response_code(500);
    die("DB Error: " . $conn->connect_error);
}

$temp  = isset($_POST["temperature"]) ? floatval($_POST["temperature"]) : null;
$hum   = isset($_POST["humidity"])    ? floatval($_POST["humidity"])    : null;
$gas   = isset($_POST["gas"])         ? intval($_POST["gas"])           : null;
$water = isset($_POST["water"])       ? intval($_POST["water"])         : null;
$light = isset($_POST["light"])       ? intval($_POST["light"])         : null;

if ($temp === null || $hum === null) {
    http_response_code(400);
    die("Missing data");
}

$stmt = $conn->prepare(
    "INSERT INTO datas (temperature, humidity, gas, water, light) VALUES (?, ?, ?, ?, ?)"
);
$stmt->bind_param("ddiii", $temp, $hum, $gas, $water, $light);

if ($stmt->execute()) {
    echo "OK";
} else {
    http_response_code(500);
    echo "Insert failed";
}

$stmt->close();
$conn->close();
?>