<?php
$conn = new mysqli("localhost", "root", "", "iot_data");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$temp   = $_POST['temperature'];
$hum    = $_POST['humidity'];
$gas    = $_POST['gas'];
$water  = $_POST['water'];
$light  = $_POST['light'];

$sql = "INSERT INTO datas (temperature, humidity, gas, water, light)
        VALUES ('$temp', '$hum', '$gas', '$water', '$light')";

if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully";
} else {
    echo "Error: " . $conn->error;
}
?>
