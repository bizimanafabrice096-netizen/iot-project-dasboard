<?php
header('Content-Type: application/json');
$conn = new mysqli("localhost", "root", "", "iot_data");
if ($conn->connect_error) {
    echo json_encode(["error" => $conn->connect_error]);
    exit;
}


$type = $_GET['type'] ?? '';

if ($type === 'recent') {
    $res = $conn->query("SELECT * FROM datas ORDER BY created_at DESC LIMIT 20");
    $labels=[]; $temperature=[]; $humidity=[]; $gas=[]; $water=[]; $light=[];
    while($row=$res->fetch_assoc()){
        $labels[] = $row['created_at'];
        $temperature[] = $row['temperature'];
        $humidity[] = $row['humidity'];
        $gas[] = $row['gas'];
        $water[] = $row['water'];
        $light[] = $row['light'];
    }
    echo json_encode([
        "labels"=>$labels,
        "temperature"=>$temperature,
        "humidity"=>$humidity,
        "gas"=>$gas,
        "water"=>$water,
        "light"=>$light
    ]);
} else {
    echo json_encode(["error"=>"Invalid type"]);
}
?>
