<?php

//create connection
$con=mysqli_connect("localhost","Notes","Noted","Notes");

// Check connection
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// This SQL statement selects ALL from the table 'Locations'
$sql = "SELECT * FROM NoteStorage";

// Executes the SQL statement and puts results into $res
$res = $con->query($sql);

// Checks if there's any rows
if($res->num_rows > 0) {

    // defines $data
    $data = array();

    // grabs all data and adds them to the $data array
    while ($row =  $res->fetch_assoc()) {
        array_push($data, $row);
    }

    // echo & encode datas
    echo json_encode($data);
} else {
    echo "no data found";
}

// Close connections
mysqli_close($con);