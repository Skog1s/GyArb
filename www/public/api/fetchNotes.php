<?php
header('Content-Type: application/json');

$con = mysqli_connect("localhost","Notes","Noted","Notes");

if (mysqli_connect_errno()) {
    http_response_code(500);
    echo json_encode(["error" => mysqli_connect_error()]);
    exit();
}

$sql = "SELECT * FROM NoteStorage";
$result = $con->query($sql);
$notes = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $notes[] = $row;
    }
}

echo json_encode($notes);
mysqli_close($con);