<?php
session_start();
date_default_timezone_set("Asia/Jakarta");
$conn = mysqli_connect("localhost", "root", "", "manpro2");

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST["simulationName"])){
    echo 'benar';

    $simulname = $_POST["simulationName"];
    $rawDataName = $_POST["RawDataName"];
    $warehouse = $_POST["warehouseAmount"];
    $specification = [];

    $arraycoba = [[1,2,3],[4,5,6]];

    $ambilArea = mysqli_query($conn, "SELECT jumlahArea FROM rawdata WHERE id = '". $rawDataName ."'");
    $dataArea = mysqli_fetch_assoc($ambilArea);

    echo $dataArea['jumlahArea'];
    for($i = 0; $i < $warehouse; $i++){
        $newData = [];
        for($j = 0; $j < $dataArea['jumlahArea']; $j++){
            $newData[$j] = isset($_POST[$i+1  . "warehouseSpecifity" . $j+1]) ? 1 : 0;
        }
        $specification[$i] = $newData;
    }

    $encodeSpec = json_encode($specification);
    print_r($encodeSpec);

    // print_r($specification[1]);

    $cekNama = mysqli_query($conn, "SELECT COUNT(*) As count FROM simulasi WHERE namaSimul = '" . $simulname . "'");
    $ambildatanya = mysqli_fetch_column($cekNama);

    $getRawDataName = mysqli_query($conn, "SELECT rawDataName FROM rawdata where id = '". $rawDataName . "'");
    $fetch = mysqli_fetch_assoc($getRawDataName);
    $grdn = $fetch['rawDataName'];
    
    if($ambildatanya == 0){
        $sql = mysqli_query($conn, "INSERT INTO simulasi (namaSimul, jumlahGudang, spekGudang, rawDataName) VALUES ('$simulname', '$warehouse','$encodeSpec','$grdn')");
    }

    if ($sql) {
        header('location: index.php');
        echo
        '
            <script>
            alert("berhasil");
            window.location.href="simul.php";
            </script>
            ';
    } else {
        echo
        '
            <script>
            alert("Add barang gagal karena barang sudah ada! Mohon menginput barang yang baru!");
            window.location.href="simul.php";
        </script>
        ';
    }

    // You'll need to similarly insert data into other tables like 'gudang', 'truck', and 'jarak' using INSERT statements.

    // Close the database connection
    mysqli_close($conn);
}else{
    echo  '<script>
        alert("GAGAL, FORM BELUM TERISI SEMUA");
        window.location.href="simul.php";
        </script>
    ';
}