<?php
session_start();
date_default_timezone_set("Asia/Jakarta");
$conn = mysqli_connect("localhost", "root", "", "manpro2");

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the data sent from JavaScript
    $optionData = $_POST['optionData'];

    // Use $optionData as needed
    $jumarea = mysqli_query($conn, "SELECT * FROM rawdata WHERE id = '$optionData'");
    while ($c = mysqli_fetch_array($jumarea)) {
        echo $c['jumlahArea'];
    }
}
?>