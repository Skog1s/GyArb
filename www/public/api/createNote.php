<?php
header('Content-Type: application/json');

$con = mysqli_connect("localhost","Notes","Noted","Notes");

if (mysqli_connect_errno()) {
    http_response_code(500);
    echo json_encode(["error" => mysqli_connect_error()]);
    exit();
}

$data = json_decode(file_get_contents("php://input"), true);
$title = $data['title'];
$body = $data['body'];

$sql = "INSERT INTO NoteStorage (title, body) VALUES (?, ?)";
$stmt = $con->prepare($sql);
$stmt->bind_param("ss", $title, $body);

if ($stmt->execute()) {
    echo json_encode(["id" => $stmt->insert_id]);
} else {
    http_response_code(500);
    echo json_encode(["error" => $stmt->error]);
}

mysqli_close($con);