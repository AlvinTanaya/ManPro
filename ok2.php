<?php
session_start();
date_default_timezone_set("Asia/Jakarta");
// membuat connection ke database
$conn = mysqli_connect("localhost", "root", "", "manpro");

if (isset($_POST['addData'])) {
    $namaSimulasi = $_POST['namaSimulasi'];
    $jumlahArea = $_POST['jumlahArea'];
    $jumlahTruck = $_POST['jumlahTruck'];
    $jarakAwal = [];
    $jarakAkhir = [];
    $presentaseTruck = [];

    for ($i = 1; $i <= $jumlahArea; $i++) {
        $jarakAwal[$i] = $_POST['jarakAwal' . $i];
        $jarakAkhir[$i] = $_POST['jarakAkhir' . $i];
        $presentaseTruck[$i] = $_POST['presentaseTruck' . $i];
    }

    $jumlahGudang = $_POST['jumlahGudang'];
    $khusus = [];

    for ($i = 1; $i <= $jumlahGudang; $i++) {
        $khusus[$i] = [];
        for ($j = 1; $j <= $jumlahArea; $j++) {
            $khusus[$i][$j] = isset($_POST[$i . 'khusus' . $j]) ? 1 : 0;
        }
    }

    $waktuLoading = $_POST['waktuLoading'];
    $durasiSimul = $_POST['durasiSimul'];

    $cekNama = mysqli_query($conn, "SELECT COUNT(*) AS count FROM simul WHERE nama = '" . $_POST['namaSimulasi'] . "'");
    $ambildatanya = mysqli_fetch_column($cekNama);


    if ($ambildatanya == 0) {
        $addtotableSimul = mysqli_query($conn, "INSERT INTO simul (nama, waktuLoading, durasi) VALUES ('$namaSimulasi', '$waktuLoading', '$durasiSimul')");

        for ($i = 1; $i <= $jumlahGudang; $i++) {
            for ($j = 1; $j <= $jumlahArea; $j++) {
                $addtotableGudang = mysqli_query($conn, "INSERT INTO gudang (nama, namaSimul, khusus, isi) VALUES ('gudang$i', '$namaSimulasi', '" . $khusus[$i][$j] . "', '$i$j')");
            }
        }

        for ($i = 1; $i <= $jumlahArea; $i++) {
            $addtotableJarak = mysqli_query($conn, "INSERT INTO jarak (namaSimul, jarakAwal, jarakAkhir, isiTruck) VALUES ('$namaSimulasi', '$jarakAwal[$i]', '$jarakAkhir[$i]', '$presentaseTruck[$i]')");
        }

        for ($i = 1; $i <= $jumlahTruck; $i++) {
            $addtotableTruck = mysqli_query($conn, "INSERT INTO truck (nama, namaSimul) VALUES ('truck$i', '$namaSimulasi')");
        }
    }

    // echo $addtotableSimul;
    // echo $addtotableGudang;
    // echo $addtotableJarak;
    // echo $addtotableTruck;

    if ($addtotableSimul && $addtotableGudang && $addtotableJarak && $addtotableTruck) {
        header('location: coba.php');
        echo
        '
            <script>
            alert("berhasil");
            window.location.href="coba.php";
            </script>
            ';
    } else {
        echo
        '
            <script>
            alert("Add barang gagal karena barang sudah ada! Mohon menginput barang yang baru!");
            window.location.href="coba.php";
        </script>
        ';
    }
} else {
    // Handle other cases or provide a response for when 'addData' is not set.
}
