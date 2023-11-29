<?php   
    $conn = mysqli_connect("localhost", "root", "", "manpro2");

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST['namadata'])){
            $namadata = mysqli_real_escape_string($conn, $_POST['namadata']);
            $cekNama = mysqli_query($conn, "SELECT COUNT(*) AS count FROM rawdata WHERE rawDataName = '$namadata'");
            $ambildatanya = mysqli_fetch_column($cekNama);
            echo $ambildatanya;
        }

        if(isset($_POST['namasimul'])){
            $simulname = mysqli_real_escape_string($conn, $_POST['namasimul']);
            $cekNama = mysqli_query($conn, "SELECT COUNT(*) As count FROM simulasi WHERE namaSimul = '" . $simulname . "'");
            $ambildatanya = mysqli_fetch_column($cekNama);
            echo $ambildatanya;
        }
    }else{
        echo "gagal";
    }
?>