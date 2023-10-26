<?php
session_start();
date_default_timezone_set("Asia/Jakarta");
$conn = mysqli_connect("localhost", "root", "", "manpro");

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $namaSimulasi = $_POST["namaSimulasi"];
    $jumlahArea = $_POST["jumlahArea"];
    $jumlahTruck = $_POST["jumlahTruck"];
    $jumlahGudang = $_POST["jumlahGudang"];
    $waktuLoading = $_POST["waktuLoading"];
    $durasiSimul = $_POST["durasiSimul"];
    
    // Insert data into the 'simul' table
    $sql = "INSERT INTO simul (nama, waktuLoading, durasi) VALUES ('$namaSimulasi', $waktuLoading, $durasiSimul)";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        echo "Data inserted into 'simul' successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // You'll need to similarly insert data into other tables like 'gudang', 'truck', and 'jarak' using INSERT statements.

    // Close the database connection
    mysqli_close($conn);
}
?>
