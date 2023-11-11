<?php
require "ok2.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css"> -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.6/css/dataTables.bootstrap5.min.css"> -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
    <script>
        $(document).ready(function() {

            $("#index-tab").click(function() {
                window.location.href = "index.php";
            });

            $("#data-tab").click(function() {
                window.location.href = "raw_data.php";
            });

            $("#compare-tab").click(function() {
                window.location.href = "compare.php";
            });

            $("#simul-tab").click(function() {
                window.location.href = "simul.php";
            });
        });
    </script>
</head>
<style>
    .nav_left {
        background-color: #d1e7dd;
        border-top-left-radius: 48px;
        border-bottom-left-radius: 48px;
    }

    .nav-tabs .nav-link.active {
        background-color: transparent;
        border-color: transparent;
        border-top: 4px solid green;
        color: green;
        font-weight: bolder;
    }


    .nav-tabs .nav-link {
        border: none;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
        margin: 0 30px 0 40px;
    }

    .nav-tabs {
        border-bottom: none;
    }

    .nav-link {
        padding: 1rem 0.5rem;
        color: #fff;
    }

    .nav-link:focus,
    .nav-link:hover {
        color: gray;
    }

    .search_input {
        width: 100%;
        border-radius: 10px;
        border: none;
        line-height: initial;
        padding-top: 4px;
        padding-bottom: 4px;
        color: #f19159;
    }

    .search_input:focus-visible {
        outline: none;
    }

    input.search_input::placeholder {
        color: #cfd2ec;
        vertical-align: middle;
    }

    .navbar-toggler {
        border: 3px solid #f19159;
    }

    .navbar-toggler-icon {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(35, 76, 203, 0.8)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
    }

    .navbar-toggler:focus {
        box-shadow: none;
    }


    .custom-border {
        border: 1px solid silver;
        border-bottom: 0;
        padding-right: 10px;
    }

    h2 {
        border-bottom: 1px solid grey;
    }
</style>

<body>
    <nav class="navbar navbar-expand-lg bg-success py-3 ">
        <div class="pe-lg-0 ps-lg-5 container-fluid justify-content-between">
            <a class="navbar-brand" href="index.php" style="color: #d1e7dd; font-weight: bolder;">
                <i class="fas fa-warehouse" style="margin-right: 10px;"></i> Warehouse Simulator
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <div class="nav_left d-lg-flex align-items-center">
                    <nav>
                        <div class="nav d-block d-lg-flex nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link" id="index-tab" data-bs-toggle="tab" data-bs-target="#index" type="button" role="tab" aria-controls="home" aria-selected="false" style="color: black;">Input</button>
                            <button class="nav-link" id="data-tab" data-bs-toggle="tab" data-bs-target="#data" type="button" role="tab" aria-controls="data" aria-selected="false" style="color: black;">Data</button>
                            <button class="nav-link" id="simul-tab" data-bs-toggle="tab" data-bs-target="#simul" type="button" role="tab" aria-controls="data" aria-selected="false" style="color: black;">Simulation</button>
                            <button class="nav-link active" id="compare-tab" data-bs-toggle="tab" data-bs-target="#compare" type="button" role="tab" aria-controls="compare" aria-selected="false" style="color: black;">Compare</button>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </nav>




    <div class="container-fluid pt-3 pe-5 ps-5 pb-1">

        <form method="post">
            <div class="row mt-4">

                <div class="col pb-3">
                    <h1>Compare</h1>
                </div>


                <div class="col-md-5 ps-3 pb-3 pt-2 pe-3">
                    <div style="display: flex; align-items: center;">
                        <select class="form-select" aria-label="Simulation Name" name="nama1">
                            <option value="" disabled selected>Choose Simulation Name</option>
                            <?php
                            $ambilSemuaNama = mysqli_query($conn, "SELECT namaSimul FROM hasil");
                            while ($data = mysqli_fetch_assoc($ambilSemuaNama)) {
                            ?>
                                <option value="<?= $data['namaSimul']; ?>"><?= $data['namaSimul']; ?></option>
                            <?php
                            }
                            ?>
                        </select>

                    </div>

                </div>



                <div class="col-md-5 ps-3 pb-3 pt-2 pe-3">


                    <div style="display: flex; align-items: center;">
                        <select class="form-select" aria-label="Simulation Name" name="nama2">
                            <option value="" disabled selected>Choose Simulation Name</option>
                            <?php
                            $ambilSemuaNama = mysqli_query($conn, "SELECT namaSimul FROM hasil");
                            while ($data = mysqli_fetch_assoc($ambilSemuaNama)) {
                            ?>
                                <option value="<?= $data['namaSimul']; ?>"><?= $data['namaSimul']; ?></option>
                            <?php
                            }
                            ?>
                        </select>

                    </div>


                </div>


                <div class="col mt-2">
                    <input type="submit" name="submit" class="btn btn-success" value="Submit">
                </div>


            </div>
        </form>

        <?php
        if (isset($_POST['submit']) && isset($_POST['nama1']) && isset($_POST['nama2']) && !empty($_POST['nama1']) && !empty($_POST['nama2'])) {
            $selected1 = $_POST['nama1'];
            $selected2 = $_POST['nama2'];

            $cek1 = mysqli_query($conn, "SELECT rawDataName FROM hasil where namaSimul = '$selected1'");
            $cek2 = mysqli_query($conn, "SELECT rawDataName FROM hasil where namaSimul = '$selected2'");


            // Verify that the counts are equal
            if ($cek1 == $cek2) {
        ?>
                <div class="row mt-3 mb-3">
                    <div class="col-md-4 ps-0 pb-0 pt-2 pe-0 custom-border">
                        <?php
                        $ambilData1 = mysqli_query($conn, "SELECT waktuOperasiGudang FROM hasil where namaSimul = '$selected1'");
                        $ambilData2 = mysqli_query($conn, "SELECT waktuOperasiGudang FROM hasil where namaSimul = '$selected2'");
                        $data1 = mysqli_fetch_assoc($ambilData1);
                        $data2 = mysqli_fetch_assoc($ambilData2);
                        $data1 = json_decode($data1['waktuOperasiGudang']);
                        $data2 = json_decode($data2['waktuOperasiGudang']);

                        $count1 = count($data1);
                        $count2 = count($data2);

                        if ($count1 > $count2) {
                            $loop = $count1;
                        } else {
                            $loop = $count2;
                        }




                        ?>

                        <h2 class="m-0 pb-2" style="display: flex; align-items: center; justify-content: center;">Nama Simulasi</h2>


                        <h2 class="m-0 pb-2" style="display: flex; align-items: center; justify-content: center;">
                            <?php
                            for ($i = 1; $i <= $loop; $i++) {
                                echo 'Gudang ' . $i . "<br>";
                            }
                            ?>
                        </h2>


                        <h2 class="m-0 pb-2" style="display: flex; align-items: center; justify-content: center;">
                            <?php
                            for ($i = 1; $i <= $loop; $i++) {
                                echo 'Rata-rata Jumlah Truck Gudang ' . $i . "<br>";
                            }
                            ?>
                        </h2>

                        <h2 class="m-0 pb-2" style="display: flex; align-items: center; justify-content: center;">
                            Minimum jumlah Truck Pada Gudang
                        </h2>

                        <h2 class="m-0 pb-2" style="display: flex; align-items: center; justify-content: center;">
                            Maximum jumlah Truck Pada Gudang
                        </h2>




                        <h2 class="m-0 pb-2" style="display: flex; align-items: center; justify-content: center;">
                            <?php
                            for ($i = 1; $i <= $loop; $i++) {
                                echo 'Waktu Operasi Gudang ' . $i . "<br>";
                            }
                            ?>
                        </h2>

                        <h2 class="m-0 pb-2" style="display: flex; align-items: center; justify-content: center;">
                            Rata-rata Waktu Operasi Gudang
                        </h2>

                        <h2 class="m-0 pb-2" style="display: flex; align-items: center; justify-content: center;">
                            Sum Waktu Operasi Gudang
                        </h2>

                        <h2 class="m-0 pb-2" style="display: flex; align-items: center; justify-content: center;">
                            Minimum Waktu Operasi Gudang
                        </h2>

                        <h2 class="m-0 pb-2" style="display: flex; align-items: center; justify-content: center;">
                            Maximum Waktu Operasi Gudang
                        </h2>

                        <h2 class="m-0 pb-2" style="display: flex; align-items: center; justify-content: center;">
                            Standard Deviasi Waktu Operasi Gudang
                        </h2>

                        <h2 class="m-0 pb-2" style="display: flex; align-items: center; justify-content: center;">
                            <?php
                            $ambilDataTruck = mysqli_query($conn, "SELECT rawData.totalTruk FROM hasil INNER JOIN rawData ON hasil.rawDataName = rawData.rawDataName WHERE hasil.namaSimul = '$selected1'");

                            $dataTruck = mysqli_fetch_assoc($ambilDataTruck);

                            $totalTruk = $dataTruck['totalTruk'];

                            for ($i = 1; $i <= $totalTruk; $i++) {
                                echo 'Waktu Antri Truck ' . $i . "<br>";
                            }


                            ?>
                        </h2>

                        <h2 class="m-0 pb-2" style="display: flex; align-items: center; justify-content: center;">
                            Rata-rata Waktu Antri Truck
                        </h2>

                        <h2 class="m-0 pb-2" style="display: flex; align-items: center; justify-content: center;">
                            Sum Waktu Operasi Gudang
                        </h2>

                        <h2 class="m-0 pb-2" style="display: flex; align-items: center; justify-content: center;">
                            Minimum Waktu Antri Truck
                        </h2>

                        <h2 class="m-0 pb-2" style="display: flex; align-items: center; justify-content: center;">
                            Maximum Waktu Antri Truck
                        </h2>

                        <h2 class="m-0 pb-2" style="display: flex; align-items: center; justify-content: center;">
                            Standard Deviasi Waktu Antri Truck
                        </h2>

                    </div>

                    <div class="col-md-4 ps-0 pb-0 pt-2 pe-0 custom-border">
                        <?php
                        $ambilData1 = mysqli_query($conn, "SELECT * FROM hasil where namaSimul = '$selected1'");
                        while ($data1 = mysqli_fetch_assoc($ambilData1)) {
                        ?>
                            <h2 class="m-0 pb-2" id="namaSimulasi1" style="display: flex; align-items: center; justify-content: center;">
                                <?= $data1['namaSimul']; ?>
                            </h2>

                            <h2 class="m-0 pb-2" id="gudang1" style="display: flex; align-items: center; justify-content: center; text-align: center;">
                                <?php
                                $dataIsiGudang1 = json_decode($data1['isiGudang']);
                                foreach ($dataIsiGudang1 as $subarray) {

                                    $subarrayWithTruck = array_map(function ($item) {
                                        return 'Truck ' . $item;
                                    }, $subarray);

                                    $output = implode(', ', $subarrayWithTruck);

                                    echo $output . "<br>";
                                }
                                ?>
                            </h2>

                            <h2 class="m-0 pb-2" id="rataGudang1" style="display: flex; align-items: center; justify-content: center; text-align: center;">
                                <?php
                                $dataIsiGudang1 = json_decode($data1['isiGudang']);
                                $total = 0;
                                $rataTruck1 = [];

                                foreach ($dataIsiGudang1 as $subarray) {
                                    foreach ($subarray as $value) {
                                        $total++;
                                    }
                                }

                                foreach ($dataIsiGudang1 as $subarray) {
                                    $count = 0;
                                    foreach ($subarray as $value) {
                                        $count++;
                                    }
                                    $average1 = $count / $total;
                                    $rataTruck1[] = $average1;
                                    echo $average1 . "<br>";
                                }
                                ?>

                            </h2>

                            <h2 class="m-0 pb-2" id="minGudang1" style="display: flex; align-items: center; justify-content: center; text-align: center;">
                                <?php
                                $dataIsiGudang1 = json_decode($data1['isiGudang']);
                                $cek = 0;
                                foreach ($dataIsiGudang1 as $subarray) {
                                    $count = 0;
                                    foreach ($subarray as $value) {
                                        $count++;
                                    }

                                    if ($cek == 0 || $cek > $count) {
                                        $cek = $count;
                                    }
                                }
                                echo $cek . "<br>";
                                ?>

                            </h2>

                            <h2 class="m-0 pb-2" id="maxGudang1" style="display: flex; align-items: center; justify-content: center; text-align: center;">
                                <?php
                                $dataIsiGudang1 = json_decode($data1['isiGudang']);
                                $cek = 0;
                                foreach ($dataIsiGudang1 as $subarray) {
                                    $count = 0;
                                    foreach ($subarray as $value) {
                                        $count++;
                                    }

                                    if ($cek == 0 || $cek < $count) {
                                        $cek = $count;
                                    }
                                }
                                echo $cek . "<br>";
                                ?>

                            </h2>


                            <h2 class="m-0 pb-2" id="waktuOperasiGudang1" style="display: flex; align-items: center; justify-content: center; text-align: center;">
                                <?php
                                $dataOperasiGudang1 = json_decode($data1['waktuOperasiGudang']);
                                for ($i = 0; $i < count($dataOperasiGudang1); $i++) {
                                    echo $dataOperasiGudang1[$i] . "<br>";
                                }
                                ?>
                            </h2>


                            <h2 class="m-0 pb-2" id="rataWaktuOperasiGudang1" style="display: flex; align-items: center; justify-content: center; text-align: center;">
                                <?php
                                $dataOperasiGudang1 = json_decode($data1['waktuOperasiGudang']);
                                $rataRata2 = array_sum($dataOperasiGudang1) / count($dataOperasiGudang1);
                                echo $rataRata2 . "<br>";
                                ?>
                            </h2>

                            <h2 class="m-0 pb-2" id="sumWaktuOperasiGudang1" style="display: flex; align-items: center; justify-content: center; text-align: center;">
                                <?php
                                $dataOperasiGudang1 = json_decode($data1['waktuOperasiGudang']);
                                $sum = array_sum($dataOperasiGudang1);
                                echo $sum . "<br>";
                                ?>
                            </h2>

                            <h2 class="m-0 pb-2" id="minWaktuOperasiGudang1" style="display: flex; align-items: center; justify-content: center; text-align: center;">
                                <?php
                                $dataOperasiGudang1 = json_decode($data1['waktuOperasiGudang']);
                                $min = min($dataOperasiGudang1);
                                echo $min . "<br>";
                                ?>
                            </h2>

                            <h2 class="m-0 pb-2" id="maxWaktuOperasiGudang1" style="display: flex; align-items: center; justify-content: center; text-align: center;">
                                <?php
                                $dataOperasiGudang1 = json_decode($data1['waktuOperasiGudang']);
                                $max = max($dataOperasiGudang1);
                                echo $max . "<br>";
                                ?>
                            </h2>

                            <h2 class="m-0 pb-2" id="stdevWaktuOperasiGudang1" style="display: flex; align-items: center; justify-content: center; text-align: center;">
                                <?php
                                $dataOperasiGudang1 = json_decode($data1['waktuOperasiGudang'], true);

                                $rataRata = array_sum($dataOperasiGudang1) / count($dataOperasiGudang1);

                                $selisihKuadrat = array_map(function ($x) use ($rataRata) {
                                    return pow($x - $rataRata, 2);
                                }, $dataOperasiGudang1);

                                $rataSelisihKuadrat = array_sum($selisihKuadrat) / count($dataOperasiGudang1);

                                $standardDeviasi1 = sqrt($rataSelisihKuadrat);

                                echo $standardDeviasi1 . "<br>";
                                ?>

                            </h2>



                            <h2 class="m-0 pb-2" id="waktuAntriTruk1" style="display: flex; align-items: center; justify-content: center;">
                                <?php
                                $dataWaktuAntriTruck1 = json_decode($data1['waktuAntriTruk']);
                                for ($i = 0; $i < count($dataWaktuAntriTruck1); $i++) {
                                    echo  $dataWaktuAntriTruck1[$i] . "<br>";
                                }
                                ?>
                            </h2>

                            <h2 class="m-0 pb-2" id="rataWaktuAntriTruk1" style="display: flex; align-items: center; justify-content: center;">
                                <?php
                                $dataWaktuAntriTruck1 = json_decode($data1['waktuAntriTruk']);
                                $rataRata3 = array_sum($dataWaktuAntriTruck1) / count($dataWaktuAntriTruck1);
                                echo $rataRata3 . "<br>";
                                ?>
                            </h2>



                            <h2 class="m-0 pb-2" id="minWaktuAntriTruk1" style="display: flex; align-items: center; justify-content: center;">
                                <?php
                                $dataWaktuAntriTruck1 = json_decode($data1['waktuAntriTruk']);
                                $minValue = min($dataWaktuAntriTruck1);
                                echo $minValue . "<br>";
                                ?>
                            </h2>


                            <h2 class="m-0 pb-2" id="maxWaktuAntriTruk1" style="display: flex; align-items: center; justify-content: center;">
                                <?php
                                $dataWaktuAntriTruck1 = json_decode($data1['waktuAntriTruk']);
                                $maxValue = max($dataWaktuAntriTruck1);
                                echo $maxValue . "<br>";
                                ?>
                            </h2>


                            <h2 class="m-0 pb-2" id="sumWaktuAntriTruk1" style="display: flex; align-items: center; justify-content: center;">
                                <?php
                                $dataWaktuAntriTruck1 = json_decode($data1['waktuAntriTruk']);
                                $sumValue = array_sum($dataWaktuAntriTruck1);
                                echo $sumValue . "<br>";
                                ?>
                            </h2>

                            <h2 class="m-0 pb-2" id="stdevWaktuAntriTruk1" style="display: flex; align-items: center; justify-content: center;">
                                <?php
                                $dataWaktuAntriTruck1 = json_decode($data1['waktuAntriTruk'], true);

                                $meanValue = array_sum($dataWaktuAntriTruck1) / count($dataWaktuAntriTruck1);

                                $squaredDifferences = array_map(function ($x) use ($meanValue) {
                                    return pow($x - $meanValue, 2);
                                }, $dataWaktuAntriTruck1);

                                $meanSquaredDifferences = array_sum($squaredDifferences) / count($dataWaktuAntriTruck1);

                                $stdevValue2 = sqrt($meanSquaredDifferences);

                                echo $stdevValue2 . "<br>";
                                ?>
                            </h2>


                        <?php
                        }
                        ?>

                    </div>

                    <div class="col-md-4 ps-0 pb-0 pt-2 pe-0 custom-border">
                        <?php
                        $ambilData2 = mysqli_query($conn, "SELECT * FROM hasil where namaSimul = '$selected2'");
                        while ($data2 = mysqli_fetch_assoc($ambilData2)) {
                        ?>
                            <h2 class="m-0 pb-2" id="namaSimulasi2" style="display: flex; align-items: center; justify-content: center; text-align: center;">
                                <?= $data2['namaSimul']; ?>
                            </h2>

                            <h2 class="m-0 pb-2" id="gudang2" style="display: flex; align-items: center; justify-content: center; text-align: center;">


                                <?php
                                $dataIsiGudang2 = json_decode($data2['isiGudang']);
                                foreach ($dataIsiGudang2 as $subarray) {

                                    $subarrayWithTruck = array_map(function ($item) {
                                        return 'Truck ' . $item;
                                    }, $subarray);

                                    $output = implode(', ', $subarrayWithTruck);

                                    echo $output . "<br>";
                                }
                                ?>
                            </h2>

                            <h2 class="m-0 pb-2" id="rataGudang2" style="display: flex; align-items: center; justify-content: center; text-align: center;">
                                <?php
                                $dataIsiGudang2 = json_decode($data2['isiGudang']);
                                $total = 0;
                                $rataTruck2 = [];

                                foreach ($dataIsiGudang2 as $subarray) {
                                    foreach ($subarray as $value) {
                                        $total++;
                                    }
                                }

                                foreach ($dataIsiGudang2 as $subarray) {
                                    $count = 0;
                                    foreach ($subarray as $value) {
                                        $count++;
                                    }
                                    $average2 = $count / $total;
                                    $rataTruck2[] = $average2;
                                    echo $average2 . "<br>";
                                }
                                ?>
                            </h2>

                            <h2 class="m-0 pb-2" id="minGudang2" style="display: flex; align-items: center; justify-content: center; text-align: center;">
                                <?php
                                $dataIsiGudang2 = json_decode($data2['isiGudang']);
                                $cek = 0;
                                foreach ($dataIsiGudang2 as $subarray) {
                                    $count = 0;
                                    foreach ($subarray as $value) {
                                        $count++;
                                    }

                                    if ($cek == 0 || $cek > $count) {
                                        $cek = $count;
                                    }
                                }
                                echo $cek . "<br>";
                                ?>

                            </h2>

                            <h2 class="m-0 pb-2" id="maxGudang2" style="display: flex; align-items: center; justify-content: center; text-align: center;">
                                <?php
                                $dataIsiGudang2 = json_decode($data2['isiGudang']);
                                $cek = 0;
                                foreach ($dataIsiGudang2 as $subarray) {
                                    $count = 0;
                                    foreach ($subarray as $value) {
                                        $count++;
                                    }

                                    if ($cek == 0 || $cek < $count) {
                                        $cek = $count;
                                    }
                                }
                                echo $cek . "<br>";
                                ?>

                            </h2>

                            <h2 class="m-0 pb-2" id="waktuOperasiGudang2" style="display: flex; align-items: center; justify-content: center; text-align: center;">
                                <?php
                                $dataWaktuOperasiGudang2 = json_decode($data2['waktuOperasiGudang']);
                                for ($i = 0; $i < count($dataWaktuOperasiGudang2); $i++) {
                                    echo $dataWaktuOperasiGudang2[$i] . "<br>";
                                }
                                ?>
                            </h2>

                            <h2 class="m-0 pb-2" id="rataWaktuOperasiGudang2" style="display: flex; align-items: center; justify-content: center; text-align: center;">
                                <?php
                                $dataOperasiGudang2 = json_decode($data2['waktuOperasiGudang']);
                                $rataRata5 = array_sum($dataOperasiGudang2) / count($dataOperasiGudang2);
                                echo $rataRata5 . "<br>";
                                ?>
                            </h2>

                            <h2 class="m-0 pb-2" id="sumWaktuOperasiGudang2" style="display: flex; align-items: center; justify-content: center; text-align: center;">
                                <?php
                                $dataOperasiGudang2 = json_decode($data2['waktuOperasiGudang']);
                                $sum = array_sum($dataOperasiGudang2);
                                echo $sum . "<br>";
                                ?>
                            </h2>

                            <h2 class="m-0 pb-2" id="minWaktuOperasiGudang2" style="display: flex; align-items: center; justify-content: center; text-align: center;">
                                <?php
                                $dataOperasiGudang2 = json_decode($data2['waktuOperasiGudang']);
                                $min = min($dataOperasiGudang2);
                                echo $min . "<br>";
                                ?>
                            </h2>

                            <h2 class="m-0 pb-2" id="maxWaktuOperasiGudang2" style="display: flex; align-items: center; justify-content: center; text-align: center;">
                                <?php
                                $dataOperasiGudang2 = json_decode($data2['waktuOperasiGudang']);
                                $max = max($dataOperasiGudang2);
                                echo $max . "<br>";
                                ?>
                            </h2>

                            <h2 class="m-0 pb-2" id="stdevWaktuOperasiGudang2" style="display: flex; align-items: center; justify-content: center; text-align: center;">
                                <?php
                                $dataOperasiGudang2 = json_decode($data2['waktuOperasiGudang'], true);

                                $rataRata = array_sum($dataOperasiGudang2) / count($dataOperasiGudang2);

                                $selisihKuadrat = array_map(function ($x) use ($rataRata) {
                                    return pow($x - $rataRata, 2);
                                }, $dataOperasiGudang2);

                                $rataSelisihKuadrat = array_sum($selisihKuadrat) / count($dataOperasiGudang2);

                                $standardDeviasi3 = sqrt($rataSelisihKuadrat);

                                echo $standardDeviasi3 . "<br>";
                                ?>
                            </h2>


                            <h2 class="m-0 pb-2" id="waktuAntriTruk2" style="display: flex; align-items: center; justify-content: center; text-align: center;">
                                <?php
                                $dataWaktuAntriTruck2 = json_decode($data2['waktuAntriTruk']);
                                for ($i = 0; $i < count($dataWaktuAntriTruck2); $i++) {
                                    echo $dataWaktuAntriTruck2[$i] . "<br>";
                                }
                                ?>
                            </h2>

                            <h2 class="m-0 pb-2" id="rataWaktuAntriTruk2" style="display: flex; align-items: center; justify-content: center;">
                                <?php
                                $dataWaktuAntriTruck2 = json_decode($data2['waktuAntriTruk']);
                                $rataRata6 = array_sum($dataWaktuAntriTruck2) / count($dataWaktuAntriTruck2);
                                echo $rataRata6 . "<br>";
                                ?>
                            </h2>




                            <h2 class="m-0 pb-2" id="minWaktuAntriTruk2" style="display: flex; align-items: center; justify-content: center;">
                                <?php
                                $dataWaktuAntriTruck2 = json_decode($data2['waktuAntriTruk']);
                                $minValue = min($dataWaktuAntriTruck2);
                                echo $minValue . "<br>";
                                ?>
                            </h2>

                            <h2 class="m-0 pb-2" id="maxWaktuAntriTruk2" style="display: flex; align-items: center; justify-content: center;">
                                <?php
                                $dataWaktuAntriTruck2 = json_decode($data2['waktuAntriTruk']);
                                $maxValue = max($dataWaktuAntriTruck2);
                                echo $maxValue . "<br>";
                                ?>
                            </h2>


                            <h2 class="m-0 pb-2" id="sumWaktuAntriTruk2" style="display: flex; align-items: center; justify-content: center;">
                                <?php
                                $dataWaktuAntriTruck2 = json_decode($data2['waktuAntriTruk']);
                                $sumValue = array_sum($dataWaktuAntriTruck2);
                                echo $sumValue . "<br>";
                                ?>
                            </h2>


                            <h2 class="m-0 pb-2" id="stdevWaktuAntriTruk2" style="display: flex; align-items: center; justify-content: center;">
                                <?php
                                $dataWaktuAntriTruck2 = json_decode($data2['waktuAntriTruk'], true);

                                $meanValue = array_sum($dataWaktuAntriTruck2) / count($dataWaktuAntriTruck2);

                                $squaredDifferences = array_map(function ($x) use ($meanValue) {
                                    return pow($x - $meanValue, 2);
                                }, $dataWaktuAntriTruck2);

                                $meanSquaredDifferences = array_sum($squaredDifferences) / count($dataWaktuAntriTruck2);

                                $stdevValue4 = sqrt($meanSquaredDifferences);

                                echo $stdevValue4 . "<br>";
                                ?>
                            </h2>


                        <?php
                        }
                        ?>

                    </div>

                </div>

                <div class="row mb-3 mt-5">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Waktu Operasi Gudang</h5>
                                <canvas id="myChart1" style="width:100%;"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Waktu Antri Truck</h5>
                                <canvas id="myChart2" style="width:100%;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Isi Jumlah Truck Setiap Gudang</h5>
                                <canvas id="myChart3" style="width:100%;"></canvas>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Truck Content</h5>
                                <canvas id="myChart" style="width:100%;"></canvas>
                            </div>
                        </div>
                    </div> -->
                </div>

        <?php
                $selected1 = $_POST['nama1'];
                $selected2 = $_POST['nama2'];

                $fetchData1 = mysqli_query($conn, "SELECT * FROM hasil WHERE namaSimul = '$selected1'");
                $data1 = mysqli_fetch_assoc($fetchData1);

                $fetchData2 = mysqli_query($conn, "SELECT * FROM hasil WHERE namaSimul = '$selected2'");
                $data2 = mysqli_fetch_assoc($fetchData2);

                $dataOperasiGudang1 = json_decode($data1['waktuOperasiGudang']);
                $dataOperasiGudang2 = json_decode($data2['waktuOperasiGudang']);

                $dataWaktuAntriTruck1 = json_decode($data1['waktuAntriTruk']);
                $dataWaktuAntriTruck2 = json_decode($data2['waktuAntriTruk']);

                $dataIsiGudang1 = json_decode($data1['isiGudang']);
                $dataIsiGudang2 = json_decode($data2['isiGudang']);

                $maxGudang = count($dataOperasiGudang1);
                $xValuesGudang1 = array_map(function ($gudang) {
                    return 'Gudang ' . $gudang;
                }, range(1, $maxGudang));

                $maxTruck = count($dataWaktuAntriTruck1);
                $xValuesTruck1 = array_map(function ($truck) {
                    return 'Truck ' . $truck;
                }, range(1, $maxTruck));

                $countedArrayGudang1 = array_map('count', $dataIsiGudang1);
                $countedArrayGudang2 = array_map('count', $dataIsiGudang2);
            } else {
                echo
                '
        <script>
            alert("Jumlah data tidak sama. Mohon input jumlah data yang sama.");
            window.location.href="compare.php";
        </script>
        ';
            }
        }
        ?>




    </div>

    <script>
        // Create the first chart for xValuesGudang1
        const xValuesGudang1 = <?= json_encode($xValuesGudang1) ?>;
        const chartDataGudang1 = <?= json_encode($dataOperasiGudang1) ?>;
        const chartDataGudang2 = <?= json_encode($dataOperasiGudang2) ?>;
        const rataData2Gudang = <?= json_encode($rataRata2) ?>;
        const rataData5Gudang = <?= json_encode($rataRata5) ?>;
        const stdevData1Gudang = <?= json_encode($standardDeviasi1) ?>;
        const stdevData3Gudang = <?= json_encode($standardDeviasi3) ?>;

        const rataData2GudangLine = Array(xValuesGudang1.length).fill(rataData2Gudang);
        const rataData5GudangLine = Array(xValuesGudang1.length).fill(rataData5Gudang);
        const stdevData1GudangLine = Array(xValuesGudang1.length).fill(stdevData1Gudang);
        const stdevData3GudangLine = Array(xValuesGudang1.length).fill(stdevData3Gudang);

        new Chart("myChart1", {
            type: "line",
            data: {
                labels: xValuesGudang1,
                datasets: [{
                    data: chartDataGudang1,
                    borderColor: "red",
                    fill: false,
                    label: 'Simulation 1',
                }, {
                    data: chartDataGudang2,
                    borderColor: "green",
                    fill: false,
                    label: 'Simulation 2',
                }, {
                    data: rataData2GudangLine,
                    borderColor: "blue",
                    fill: false,
                    label: 'rata Data 2 Line',
                }, {
                    data: rataData5GudangLine,
                    borderColor: "yellow",
                    fill: false,
                    label: 'rata Data 5 Line',
                }, {
                    data: stdevData1GudangLine,
                    borderColor: "blue",
                    fill: false,
                    label: 'stdev Data 1 Line',
                }, {
                    data: stdevData3GudangLine,
                    borderColor: "yellow",
                    fill: false,
                    label: 'stdev Data 3 Line',
                }]
            },
            options: {
                legend: {
                    display: true,
                    position: 'top',
                }
            }
        });


        // Create the second chart for Truck
        const xValuesTruck1 = <?= json_encode($xValuesTruck1) ?>;
        const chartDataTruck1 = <?= json_encode($dataWaktuAntriTruck1) ?>;
        const chartDataTruck2 = <?= json_encode($dataWaktuAntriTruck2) ?>;

        const rataData3 = <?= json_encode($rataRata3) ?>;
        const rataData6 = <?= json_encode($rataRata6) ?>;
        const stdevData2 = <?= json_encode($stdevValue2) ?>;
        const stdevData4 = <?= json_encode($stdevValue4) ?>;


        const rataData3Line = Array(xValuesTruck1.length).fill(rataData3);
        const rataData6Line = Array(xValuesTruck1.length).fill(rataData6);

        const stdevData2Line = Array(xValuesTruck1.length).fill(stdevData2);
        const stdevData4Line = Array(xValuesTruck1.length).fill(stdevData4);

        new Chart("myChart2", {
            type: "line",
            data: {
                labels: xValuesTruck1,
                datasets: [{
                    data: chartDataTruck1,
                    borderColor: "red",
                    fill: false,
                    label: 'Simulation 1',
                }, {
                    data: chartDataTruck2,
                    borderColor: "green",
                    fill: false,
                    label: 'Simulation 2',
                }, {
                    data: rataData3Line,
                    borderColor: "blue",
                    fill: false,
                    label: 'rata Data 1 Line',
                }, {
                    data: rataData6Line,
                    borderColor: "yellow",
                    fill: false,
                    label: 'rata Data 2 Line',
                }, {
                    data: stdevData2Line,
                    borderColor: "blue",
                    fill: false,
                    label: 'stdev Data 1 Line',
                }, {
                    data: stdevData4Line,
                    borderColor: "yellow",
                    fill: false,
                    label: 'stdev Data 2 Line',
                }]
            },
            options: {
                legend: {
                    display: true,
                    position: 'top',
                }
            }
        });


        // Create the third chart for counted Gudang data
        const xValuesCountedGudang1 = <?= json_encode($xValuesGudang1) ?>;
        const chartDataCountedGudang1 = <?= json_encode($countedArrayGudang1) ?>;
        const chartDataCountedGudang2 = <?= json_encode($countedArrayGudang2) ?>;
        const chartrataTruck1 = <?= json_encode($rataTruck1) ?>;
        const chartrataTruck2 = <?= json_encode($rataTruck2) ?>;


        new Chart("myChart3", {
            type: "line",
            data: {
                labels: xValuesCountedGudang1,
                datasets: [{
                    data: chartDataCountedGudang1,
                    borderColor: "red",
                    fill: false,
                    label: 'Simulation 1',
                }, {
                    data: chartDataCountedGudang2,
                    borderColor: "green",
                    fill: false,
                    label: 'Simulation 2',
                }, {
                    data: chartrataTruck1,
                    borderColor: "Blue",
                    fill: false,
                    label: 'Rata-rata 1',
                }, {
                    data: chartrataTruck2,
                    borderColor: "yellow",
                    fill: false,
                    label: 'Rata-rata 2',
                }]
            },
            options: {
                legend: {
                    display: true,
                    position: 'top',
                }
            }
        });
    </script>


</body>

</html>