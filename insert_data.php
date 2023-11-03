<?php
session_start();
date_default_timezone_set("Asia/Jakarta");
$conn = mysqli_connect("localhost", "root", "", "manpro2");

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST["addData"])) {
    echo 'benar';
    // Retrieve data from the form
    $namaSimulasi = $_POST["simulationName"];
    $jumlahArea = $_POST["areaAmount"];
    $jumlahTruck = $_POST["totalTruck"];
    $jumlahGudang = $_POST["warehouseAmount"];
    $durasiSimul = $_POST["duration"];
    $jarakAwal = [];
    $jarakAkhir = [];
    $presentaseTruck = [];

    for ($i = 1; $i <= $jumlahArea; $i++) {
        $jarakAwal[$i] = $_POST['jarakAwal' . $i];
        $jarakAkhir[$i] = $_POST['jarakAkhir' . $i];
        $presentaseTruck[$i] = $_POST['truckPercentage' . $i];
    }
    $khusus = [];

    for ($i = 1; $i <= $jumlahGudang; $i++) {
        $khusus[$i] = [];
        for ($j = 1; $j <= $jumlahArea; $j++) {
            $khusus[$i][$j] = isset($_POST[$i . 'warehouseSpecifity' . $j]) ? 1 : 0;
        }
    }

    $durasiSimul = $_POST['duration'];

    $cekNama = mysqli_query($conn, "SELECT COUNT(*) AS count FROM simul WHERE nama = '" . $_POST['simulationName'] . "'");
    $ambildatanya = mysqli_fetch_column($cekNama);
    
    // Insert data into the 'simul' table
    if($ambildatanya == 0){
        $sql = mysqli_query($conn, "INSERT INTO simul (nama, waktuLoading, durasi) VALUES ('$namaSimulasi', 1, $durasiSimul)");

        
        for ($i = 1; $i <= $jumlahGudang; $i++) {
            for ($j = 1; $j <= $jumlahArea; $j++) {
                $addtotableGudang = mysqli_query($conn, "INSERT INTO gudang (namaGudang, namaSimul, khusus, isiGudang) VALUES ('gudang$i', '$namaSimulasi', '" . $khusus[$i][$j] . "', '$i$j')");
            }
        }
        $truckname =1;
        for ($i = 1; $i <= $jumlahArea; $i++) {
            for($j = 1; $j <= $presentaseTruck[$i]; $j++){
                $addtotableJarak = mysqli_query($conn, "INSERT INTO jarak (namaSimul, jarakAwal, jarakAkhir, namaTruck) VALUES ('$namaSimulasi', '$jarakAwal[$i]', '$jarakAkhir[$i]', 'Truck$truckname')");
                $truckname+=1;
            }
        }
    }

    if ($sql && $addtotableGudang && $addtotableJarak) {
        header('location: index.php');
        echo
        '
            <script>
            alert("berhasil");
            window.location.href="index.php";
            </script>
            ';
    } else {
        echo
        '
            <script>
            alert("Add barang gagal karena barang sudah ada! Mohon menginput barang yang baru!");
            window.location.href="index.php";
        </script>
        ';
    }

    // You'll need to similarly insert data into other tables like 'gudang', 'truck', and 'jarak' using INSERT statements.

    // Close the database connection
    mysqli_close($conn);
}else{
    echo  '<script>
        alert("GAGAL, FORM BELUM TERISI SEMUA");
        window.location.href="index.php";
        </script>
    ';
}
?>
