<?php
$con = mysqli_connect("localhost","Notes","Noted","Notes");

if (mysqli_connect_errno()) {
    echo json_encode(["error" => mysqli_connect_error()]);
    exit();
}

$id = $_GET['id'];
$sql = "DELETE FROM NoteStorage WHERE id = $id";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["error" => $stmt->error]);
}

mysqli_close($con);