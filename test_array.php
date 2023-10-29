<?php
session_start();
date_default_timezone_set("Asia/Jakarta");
$conn = mysqli_connect("localhost", "root", "", "manpro");

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT id, namaSimul, jumlahTruk, infoTruk FROM `random`";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        $infoTruk = json_decode($row["infoTruk"]);
        // Now $infoTruk is an array or object that you can access
        echo "ID: " . $row["id"] . "<br>";
        echo "Nama Simul: " . $row["namaSimul"] . "<br>";
        echo "Jumlah Truk: " . $row["jumlahTruk"] . "<br>";

        // Access the elements of the $infoTruk array
        echo "Index Truk: " . $infoTruk[0] . "<br>";
        echo "Waktu: " . $infoTruk[1] . "<br>";
        echo "Index Range: " . $infoTruk[2] . "<br><br>";
    }
} else {
    echo "0 results";
}

    // Close the database connection
    mysqli_close($conn);
?>
